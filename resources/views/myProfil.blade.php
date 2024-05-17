
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="{{ asset('css/inscription.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&family=Inter:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>

<form action = "{{ url('/home') }}">
<button type="submit" class="original-button">back</button>

</form>

<div class="login-box hello">

    <h2>My profil</h2>
        @csrf
        <div class="user-box2">
            <h2>Username :</h2>
            <label>{{ $user->name }}</label>
        </div>
        <div class="user-box2 tt">
            <h2>Email :</h2>
            <label>{{ $user->email }}</label>
        </div>


</div>
</body>
</html>