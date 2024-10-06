document.addEventListener("DOMContentLoaded", function () {
    const addExaminerBtn = document.getElementById("addExaminerAdmin");
    const addExaminerModal = document.getElementById("addExaminerModal");
    const addCloseModalBtn = document.getElementById("addClose");

    // Function to open the modal
    addExaminerBtn.addEventListener("click", function () {
        addExaminerModal.style.display = "block"; // Show the modal
    });

    // Function to close the modal
    addCloseModalBtn.addEventListener("click", function () {
        addExaminerModal.style.display = "none"; // Hide the modal
        clearForm(); // Optional: Clear the form inputs
    });

    // Close modal when clicking outside of it
    window.addEventListener("click", function (event) {
        if (event.target === addExaminerModal) {
            addExaminerModal.style.display = "none"; // Hide the modal
            clearForm(); // Optional: Clear the form inputs
        }
    });

    // Function to clear the form (optional)
    function clearForm() {
        const form = addExaminerModal.querySelector("form");
        if (form) form.reset(); // Reset the form fields
    }
});

let modal = document.getElementById("editAdminModal");
let modalNameInput = document.querySelector('input[name="name"]');
let modalSubjectInput = document.querySelector('input[name="subject"]');
let modalEmailInput = document.querySelector('input[name="email"]');
let modalPasswordInput = document.querySelector('input[name="password"]');

function onEditBtnClick(name, subject, email, password) {
    // Set the input values with the examiner's data
    modalNameInput.value = name;
    modalSubjectInput.value = subject;
    modalEmailInput.value = email;
    modalPasswordInput.value = password;

    // Show the modal
    modal.style.display = "block";
}

function onCloseBtnClick() {
    // Hide the modal
    modal.style.display = "none";
}