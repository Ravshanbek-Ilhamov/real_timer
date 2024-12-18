import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

window.Echo.channel('message')
    .listen('MessageEvent', (e) => {
        const messageList = document.getElementById('messages');

        const messageItem = document.createElement('div');

        const newMessage = document.createElement('li');
        newMessage.innerText = e.message.message;
        messageItem.appendChild(newMessage);

        if (e.message.image_path) {
            const newImage = document.createElement('img');
            newImage.src = `/storage/${e.message.image_path}`;
            newImage.width = 150;
            messageItem.appendChild(newImage);
        }

        messageList.prepend(messageItem);
    });


window.Echo.channel('workers')
    .listen('WorkerEvent', (event) => {
        const worker = event.worker;

        const tbody = document.querySelector('tbody');
        const newRow = document.createElement('tr');

        newRow.innerHTML = `
            <td>${worker.id}</td>
            <td>
                <img class="img-fluid" width="100px" src="/storage/${worker.image_path}" alt="">
            </td>
            <td>${worker.name}</td>
            <td>${worker.email}</td>
            <td>${worker.date_of_birth}</td>
        `;

        tbody.prepend(newRow);
    });
