document.getElementById('loadMessagesButton').addEventListener('click', function() {
    fetch('/messagePage')
        .then(response => response.json())
        .then(data => {
            console.log(data.messages);
        })
        .catch(error => console.error('Error:', error));
});
