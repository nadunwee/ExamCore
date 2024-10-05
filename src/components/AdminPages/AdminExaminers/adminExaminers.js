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

let modal = document.getElementById("editModal");

function onEditBtnClick() {
  modal.classList.add("show-modal");
}

function onCloseBtnClick() {
  modal.classList.remove("show-modal");
}
