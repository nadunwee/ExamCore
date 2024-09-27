// ExaminerNotification.js

document.addEventListener('DOMContentLoaded', function() {
    const listNotification = document.getElementById('list-notification');
    const editModal = document.getElementById('edit-modal');
    const closeButton = document.querySelector('.close-button');
    const editForm = document.getElementById('edit-form');

    let currentEditId = null;

    // Function to open the modal
    function openModal() {
        editModal.style.display = 'block';
    }

    // Function to close the modal
    function closeModal() {
        editModal.style.display = 'none';
        editForm.reset();
        currentEditId = null;
    }

    // Close the modal when the user clicks on <span> (x)
    closeButton.addEventListener('click', closeModal);

    // Close the modal when the user clicks anywhere outside of the modal
    window.addEventListener('click', function(event) {
        if (event.target == editModal) {
            closeModal();
        }
    });

    // Handle Edit Button Click
    listNotification.addEventListener('click', function(event) {
        if (event.target.classList.contains('edit-button')) {
            const listItem = event.target.closest('li');
            const notificationId = listItem.getAttribute('data-id');
            const name = listItem.querySelector('.name').innerText;
            const email = listItem.querySelector('.email').innerText;
            const message = listItem.querySelector('.message').innerText;

            // Populate the edit form with existing data
            document.getElementById('edit-notification-id').value = notificationId;
            document.getElementById('edit-name').value = name;
            document.getElementById('edit-email').value = email;
            document.getElementById('edit-message').value = message;

            currentEditId = notificationId;

            // Open the modal
            openModal();
        }

        // Handle Delete Button Click
        if (event.target.classList.contains('delete-button')) {
            const listItem = event.target.closest('li');
            const notificationId = listItem.getAttribute('data-id');

            if (confirm('Are you sure you want to delete this notification?')) {
                // Send AJAX request to delete the notification
                fetch('deleteExaminerNotification.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `notification_id=${encodeURIComponent(notificationId)}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Remove the notification from the DOM
                        listItem.remove();
                        alert(data.message);
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the notification.');
                });
            }
        }
    });

    // Handle Edit Form Submission
    editForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        const notificationId = document.getElementById('edit-notification-id').value;
        const name = document.getElementById('edit-name').value.trim();
        const email = document.getElementById('edit-email').value.trim();
        const message = document.getElementById('edit-message').value.trim();

        if (!name || !email || !message) {
            alert('All fields are required.');
            return;
        }

        // Validate email format
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert('Please enter a valid email address.');
            return;
        }

        // Send AJAX request to update the notification
        fetch('editExaminerNotification.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `notification_id=${encodeURIComponent(notificationId)}&name=${encodeURIComponent(name)}&email=${encodeURIComponent(email)}&message=${encodeURIComponent(message)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Update the notification in the DOM
                const listItem = document.querySelector(`li[data-id="${notificationId}"]`);
                listItem.querySelector('.name').innerText = name;
                listItem.querySelector('.email').innerText = email;
                listItem.querySelector('.message').innerText = message;

                alert(data.message);
                // Close the modal
                closeModal();
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating the notification.');
        });
    });
});

