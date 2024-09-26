const notificationForm = document.getElementById('examiner-notification-form');
const notificationInput = document.getElementById('notification-input');
const notificationList = document.getElementById('list-notifications');

let notifications = []; // Array to store notifications

const renderNotifications = () => {
    notificationList.innerHTML = '';
    notifications.forEach((notification, index) => {
        const listItem = document.createElement('li');
        const notificationText = document.createElement('span');
        notificationText.textContent = notification;
        listItem.appendChild(notificationText);

        const editInput = document.createElement('input');
        editInput.type = 'text';
        editInput.value = notification;
        editInput.style.display = 'none';
        listItem.appendChild(editInput);

        const editButton = document.createElement('button');
        editButton.textContent = 'Edit';
        editButton.addEventListener('click', () => {
            if (editInput.style.display === 'none') {
                editInput.style.display = 'inline';
                notificationText.style.display = 'none';
                editButton.textContent = 'Save';
            } else {
                updateNotification(index, editInput.value);
                editInput.style.display = 'none';
                notificationText.style.display = 'inline';
                editButton.textContent = 'Edit';
            }
        });
        listItem.appendChild(editButton);

        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Delete';
        deleteButton.addEventListener('click', () => {
            deleteNotification(index);
        });
        listItem.appendChild(deleteButton);

        notificationList.appendChild(listItem);
    });
};

const addNotification = (notification) => {
    notifications.push(notification);
    renderNotifications();
};

const updateNotification = (index, newNotification) => {
    notifications[index] = newNotification;
    renderNotifications();
};

const deleteNotification = (index) => {
    notifications.splice(index, 1);
    renderNotifications();
};

// Handle form submission
notificationForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const newNotification = notificationInput.value;
    addNotification(newNotification);
    notificationInput.value = ''; // Clear the input after submission
});
