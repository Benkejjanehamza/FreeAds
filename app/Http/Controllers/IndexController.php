<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function showIndex()
    {
        return view('inscription');
    }
    public function loginIndex()
    {
        return view('login');
    }
    public function accueilIndex()
    {
        return view('home');
    }
    public function myProfilIndex()
    {
        return view('myProfil');
    }
    public function annonceIndex()
    {
        return view('annonces');
    }
    public function annonceListIndex()
    {
        return view('annoncesListe');
    }
    public function annonceShowIndex()
    {
        return view('annonceShow');
    }
    public function updateAnnonceIndex($id)
    {
        $annonce = Annonce::findOrFail($id);

        return view('updateAnnonce', compact('annonce'));
    }
    public function messageViewIndex()
    {
        return view('sendMessage');
    }
    public function messagePageIndex()
    {
        return view('messagePage');
    }
}
