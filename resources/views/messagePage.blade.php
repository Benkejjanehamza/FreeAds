<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link rel="stylesheet" href="{{ asset('css/sendMessage.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&family=Inter:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">
    <form action="/home" method="GET">
        @csrf
        <button class="original-button" type="submit">Home</button>
    </form>
    <h1>Messages</h1>
    <button id="loadMessagesButton">Charger les Messages</button>
    <div id="messagesContainer" class="messages-container"></div>
</div>

<script>
    document.getElementById('loadMessagesButton').addEventListener('click', function() {
        fetch('/messagePage')
            .then(response => response.json())
            .then(data => {
                const messagesContainer = document.getElementById('messagesContainer');
                messagesContainer.innerHTML = ''; // Clear previous messages
                const userId = data.userId; // ID de l'utilisateur connecté

                let lastSenderId = null;
                let messageGroup = null;

                data.messages.forEach(message => {
                    // Filtrer les messages envoyés par l'utilisateur connecté
                    if (message.sender.id === userId) {
                        return; // Ne pas afficher les messages envoyés par moi-même
                    }

                    if (message.sender.id !== lastSenderId) {
                        if (messageGroup) {
                            messagesContainer.appendChild(messageGroup);
                        }
                        messageGroup = document.createElement('div');
                        messageGroup.className = 'message-group';
                        const senderName = document.createElement('h3');
                        senderName.textContent = `De: ${message.sender.name}`;
                        messageGroup.appendChild(senderName);
                        lastSenderId = message.sender.id;
                    }

                    const messageContent = document.createElement('div');
                    messageContent.className = 'message-content';
                    messageContent.textContent = message.content;
                    messageGroup.appendChild(messageContent);
                });

                if (messageGroup) {
                    messagesContainer.appendChild(messageGroup);
                }
            })
            .catch(error => console.error('Erreur:', error));
    });

</script>
</body>
</html>
