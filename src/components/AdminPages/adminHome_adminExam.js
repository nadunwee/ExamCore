document.addEventListener('DOMContentLoaded', function () {

    document.getElementById('admin-add-an-exam-Btn').addEventListener('click', function () {
        // Show the popup when "Add an exam" is clicked
        document.querySelector('.admin-exam-popup-background').style.display = 'flex';
    });

    // Close popup on cancel
    document.querySelector('.admin-add-exam-cancel-button').addEventListener('click', function () {
        document.querySelector('.admin-exam-popup-background').style.display = 'none';
    });

    document.querySelector('.admin-edit-exam-cancel-button').addEventListener('click', function () {
        document.querySelector('.admin-edit-exam-popup-background').style.display = 'none';
    });

    // Add exam when "Add" button is clicked
    document.getElementById('submit-exam').addEventListener('click', function (event) {
        event.preventDefault(); // Prevent form from submitting the normal way

    });

    document.querySelectorAll('.admin-exam-delete form').forEach(function (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the form from submitting in the traditional way

            const examId = this.querySelector('input[name="exam_id"]').value;
            if (confirm("Are you sure you want to delete this exam?")) {
                // Send an AJAX request to delete the exam
                deleteExam(examId, this.closest('.admin-exam-information'));
            }
        });
    });
});

function openEditPopup(examId) {
    // Fetch exam details using examId (you may want to do this via AJAX or from the DOM)
    const examInfo = document.querySelector(`.admin-exam-information[data-exam-id='${examId}']`);
    
    if (examInfo) {
        // Populate the edit form with existing exam data
        document.querySelector('#popup-exam-name').value = examInfo.querySelector('.admin-add-exam-name span').textContent;
        document.querySelector('#popup-examiner-id').value = examInfo.querySelector('.admin-assigned-examiner span').textContent;
        document.querySelector('#popup-exam-deadline').value = examInfo.querySelector('.admin-exam-deadline span').textContent;
        document.querySelector('#popup-exam-password').value = examInfo.querySelector('.admin-exam-password span').textContent;
        
        // Set the hidden input for exam ID
        const examIdInput = document.createElement("input");
        examIdInput.type = "hidden";
        examIdInput.name = "exam_id";
        examIdInput.value = examId;
        document.querySelector('.admin-edit-exam-popup-body form').appendChild(examIdInput);

        // Show the edit popup
        document.querySelector('.admin-edit-exam-popup-background').style.display = 'flex';
    }
}
function deleteExam(examId, examElement) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "adminDeleteExams.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Remove the exam element from the DOM if deletion is successful
            examElement.remove();
            alert('Exam deleted successfully.');
        } else if (xhr.readyState === 4) {
            // Handle failure
            alert('Failed to delete the exam.');
        }
    };

    // Send the request with the exam_id
    xhr.send("exam_id=" + encodeURIComponent(examId));
}
