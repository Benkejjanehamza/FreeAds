<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Annonce;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AnnonceController extends Controller
{
    public function postAnnonceDb(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'images.*' => 'required|image|max:10240',
            'prix' => 'required|numeric',
            'critere' => 'required|string',
            'location' => 'required|string'
        ]);

        $annonce = new Annonce([
            'titre' => $request->titre,
            'description' => $request->description,
            'prix' => $request->prix,
            'critere' => $request->critere,
            'location' => $request->location,
            'user_id' => Auth::id(),
        ]);
        $annonce->save();

        if ($request->has('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $annonce->images()->create(['filename' => $path]);
            }
        }

        return view('home');
    }

    public function getAnnonces()
    {
        $user = Auth::user();
        $annonces = Annonce::where('user_id', $user->id)->get();
        return view('annonceShow', ['annonces' => $annonces]);
    }

    public function getAllAnnonce()
    {
        $annonces = Annonce::with('images')->get();
        return view('annoncesListe', ['annonces' => $annonces]);
    }

    public function destroy($id)
    {
        $annonce = Annonce::findOrFail($id);
        foreach ($annonce->images as $image) {
            Storage::delete($image->filename);
            $image->delete();
        }
        $annonce->delete();

        return view('home');
    }
    public function updateAnnonce(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'images.*' => 'nullable|image|max:10240',
            'prix' => 'required|numeric',
            'critere' => 'required|string',
            'location' => 'required|string'
        ]);

        $annonce = Annonce::findOrFail($request->id);

        $annonce->update([
            'titre' => $request->titre,
            'description' => $request->description,
            'prix' => $request->prix,
            'critere' => $request->critere,
            'location' => $request->location,
        ]);



        if ($request->has('images')) {

            foreach ($annonce->images as $image) {
                Storage::delete('public/' . $image->filename);
                $image->delete();
            }
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $annonce->images()->create(['filename' => $path]);
            }
        }

        return view('home');
    }
    public function annonceFilter(Request $request)
    {
        $request->validate([
            'nom' => 'nullable|string',
            'critere' => 'nullable|string',
            'location' => 'nullable|string'
        ]);

        $query = Annonce::query();

        if ($request->filled('nom')) {
            $query->where('titre', 'like', '%' . $request->nom . '%');
        }

        if ($request->filled('critere')) {
            $query->where('critere', $request->critere);
        }

        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        $sortOrder = $request->input('sort', 'desc');

        $annonces = $query->orderBy('created_at', $sortOrder)->get();

        if ($annonces->isEmpty()) {
            return back()->with('no-results', 'Aucune annonce trouvée correspondant à vos critères.');
        }

        return view('annoncesListe', ['annonces' => $annonces]);
    }


}
