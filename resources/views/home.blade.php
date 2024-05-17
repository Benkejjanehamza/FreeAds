
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Inscription</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&family=Inter:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>

<div class="container">


    <div class="toto">
<h1>Bienvenue</h1>

        <div class="btn">


                <button class="original-button" type="submit" onclick="loadAndMarkMessages()">
                    New message : <span id="unreadMessagesCount"></span>
                </button>
            <form action="/messageView" method="GET">
                @csrf
                <button class="original-button" type="submit">Send Message</button>
            </form>

            <form action="/allAnnonce" method="GET">
                @csrf
                <button class="original-button" type="submit">Show All annonces</button>
            </form>
                <form action="/getAnnonce" method="GET">
                    @csrf
                    <button class="original-button" type="submit">Show my annonces</button>
                </form>

            <form action="/createAnnonce" method="GET">
                @csrf
                <button class="original-button" type="submit">Create annonce</button>
            </form>

            </div>
            <form action="/logout" method="POST">
                @csrf
                <button class="original-button" type="submit">Déconnexion</button>
            </form>
            <form action="/read">
                <button class="original-button read2">Voir mes informations</button>
            </form>

            <form action="/delete">
                 <button class="original-button read" onclick="confirmDelete()">supprimer mon compte</button>
            </form>
        </div>
<script>
    function confirmDelete() {
        if(confirm('Voulez-vous vraiment supprimer votre compte ? Cette action est irréversible.')) {
            event.target.form.submit();
        }
    }
</script>

    </div>

<form action="/update" method="POST">
<div class="form">
    @csrf
    @method("PUT")
    <div class="title">Welcome</div>
    <div class="input-container ic2">
        <input id="email" name="email" class="input" type="text" placeholder=" " />
        <div class="cut cut-short"></div>
        <label for="email" class="placeholder">Change my Email</label>
    </div>
    <div class="input-container ic1">
        <input id="firstname" name="name" class="input" type="text" placeholder=" " />
        <div class="cut"></div>
        <label for="firstname" class="placeholder">Change my name</label>
    </div>

    <div class="input-container ic2">
        <input id="lastname" name="password" class="input" type="text" placeholder=" " />
        <div class="cut"></div>
        <label for="lastname" class="placeholder">Change my password</label>
    </div>
    <button type="text" class="submit">Update</button>
    <div class="success">{{ $success ?? '' }}</div>
</div>
</form>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const unreadSpan = document.getElementById('unreadMessagesCount');

        function fetchUnreadCount() {
            fetch('/unreadMessage')
                .then(response => response.json())
                .then(data => {
                    unreadSpan.textContent = `(${data.unreadCount})`;
                })
                .catch(error => console.error('Erreur:', error));
        }

        fetchUnreadCount();
        setInterval(fetchUnreadCount, 30000);
    });

    function loadAndMarkMessages() {
        fetch('/readMessage', {
            method: 'POST',30000
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => {
                console.log(response)
                if (response.ok) {
                    window.location.href = '/goToMessage';
                } else {
                    alert('Failed to mark messages as read');
                }
            })
            .catch(error => console.error('Error:', error));
    }

</script>

</body>
</html>
