document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('admin-add-an-exam-Btn').addEventListener('click', function () {
        // Show the popup when "Add an exam" is clicked
        document.querySelector('.admin-exam-popup-background').style.display = 'flex';
    });

    // Close popup on cancel
    document.querySelector('.admin-add-exam-cancel-button').addEventListener('click', function () {
        document.querySelector('.admin-exam-popup-background').style.display = 'none';
    });

    // Add exam when "Add" button is clicked
    document.getElementById('submit-exam').addEventListener('click', function (event) {
        event.preventDefault(); // Prevent form from submitting the normal way

    });
});

