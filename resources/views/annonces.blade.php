<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une Annonce</title>
    <link rel="stylesheet" href="{{ asset('css/annonces.css') }}" />
</head>
<body>


<div class="form-container">
    <form action="/postAnnonce" method="POST" enctype="multipart/form-data" class="creation-form">
        @csrf
        <div class="form-group">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" id="titre" name="titre" class="form-input" required>
        </div>

        <div class="form-group">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-textarea" required></textarea>
        </div>

        <div class="form-group">
            <label for="photographie" class="form-label">Photographie</label>
            <input type="file" name="images[]" multiple>
        </div>


        <div class="form-group">
            <label for="critere" class="form-label">Critère</label>
            <select type="text" id="critere" name="critere" class="form-input" required>
                <option value=""></option>
                <option value="animale">animale</option>
                <option value="gaming">gaming</option>
                <option value="meubles">meubles</option>
                <option value="mode">mode</option>
            </select>
        </div>

        <div class="form-group">
            <label for="location" class="form-label">Location</label>
            <select id="location" name="location" class="form-input" required>
                <option value=""></option>
                <option value="lyon">Lyon</option>
                <option value="paris">Paris</option>
                <option value="marseille">Marseille</option>
                <option value="bordeaux">Bordeaux</option>
            </select>
        </div>
        <div class="form-group">
            <label for="prix" class="form-label">Prix</label>
            <input type="number" id="prix" name="prix" class="form-input" step="0.01" required>
        </div>


        <button type="submit" class="form-button">Créer Annonce</button>
    </form>
</div>
</body>
</html>
