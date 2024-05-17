<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/annonceShow.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
    <title>Mes Annonces</title>
</head>
<body>
<h1>Mes Annonces</h1>
<form action="/search" method="GET" class="search-form">
    @csrf
    <div class="form-group">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" class="form-input">
    </div>
    <select name="critere" class="form-input">
        <option value="">Catégorie</option>
        <option value="animale">Animale</option>
        <option value="gaming">Gaming</option>
        <option value="meubles">Meubles</option>
        <option value="mode">Mode</option>
    </select>

    <select name="location" class="form-input">
        <option value="">Ville</option>
        <option value="lyon">Lyon</option>
        <option value="paris">Paris</option>
        <option value="marseille">Marseille</option>
        <option value="bordeaux">Bordeaux</option>
    </select>

    <select name="sort" class="form-input">
        <option value="desc">Most Recent First</option>
        <option value="asc">Oldest First</option>
    </select>

    <button type="submit" class="search-button">Search</button>
</form>
<div class="annonces-container">

    @forelse($annonces as $annonce)

        <div class="annonce">
            <div class="bton-container">
            <form action="{{ route('annonce.destroy', $annonce->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="original-button">Delete annonce</button>
            </form>

                <form action="{{ route('annonce.update.form', $annonce->id) }}" method="GET">
                    @csrf
                    <button type="submit" class="original-button tata">Edit annonce</button>
            </form>
            </div>

            <h2>{{ $annonce->titre }}</h2>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach($annonce->images as $image)
                        <div class="swiper-slide">
                            <img src="{{ asset('storage/' . $image->filename) }}" alt="Image de l'annonce">
                        </div>
                    @endforeach

                </div>
                <div class="swiper-pagination"></div>

            </div>
            <p>{{ $annonce->description }}</p>
            <div class="container-critere">
                <h5>{{ $annonce->location }}</h5>
                <h5>{{ $annonce->critere }}</h5>
            </div>

            <p>Prix: {{ $annonce->prix }}€</p>
        </div>
    @empty
        <p>Aucune annonce trouvée.</p>
    @endforelse
</div>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper('.swiper-container', {
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
</script>
</body>

</html>
