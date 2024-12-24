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

        const newImage = document.createElement('img');
        newImage.width = 150;
        newImage.src = '/storage/' + e.message.image_path;

        if (e.message.image_path) {
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


window.Echo.channel('message-count')
    .listen('CountingMessages', (e) => {
        // console.log(e.count); // Log the count to verify it's received
        document.getElementById('message-count-display').textContent = e.messages;
    });

window.Echo.channel('switch-status')
    .listen('SwitchTheStatus', (e) => {
        let dropdownMenu = document.querySelector('.dropdown-menu');

        // Clear existing content
        dropdownMenu.innerHTML = '';

        // Dynamically add messages
        e.messages.forEach(message => {
            let messageHTML = `
                <a href="/switchMessageStatus/${message.id}" class="dropdown-item">
                  <!-- Message Start -->
                  <div class="media">
                    <img src="${message.image_path}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                    <div class="media-body">
                      <h3 class="dropdown-item-title">
                        ${message.title}
                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                      </h3>
                      <p class="text-sm">${message.message}</p>
                      <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> ${message.created_at}</p>
                    </div>
                  </div>
                  <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
            `;
            dropdownMenu.innerHTML += messageHTML;
        });

        // Add "See All Messages" at the end
        dropdownMenu.innerHTML += `
            <a href="/" class="dropdown-item dropdown-footer">See All Messages</a>
        `;
    });


window.Echo.channel('all-messages')
    .listen('GetMessagesEvent', (e) => {
        console.log(e.messages);
    })