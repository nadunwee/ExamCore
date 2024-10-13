document.addEventListener('DOMContentLoaded', function () {

    document.getElementById('admin-add-an-exam-Btn').addEventListener('click', function () {
        // Show the popup when "Add an exam" is clicked
        document.querySelector('.admin-exam-popup-background').style.display = 'flex';
    });

    // Close popup on cancel
    document.querySelector('.admin-add-exam-cancel-button').addEventListener('click', function () {
        document.querySelector('.admin-exam-popup-background').style.display = 'none';
    });

    //Cancel button
    document.querySelector('.admin-edit-exam-cancel-button').addEventListener('click', function () {
        document.querySelector('.admin-edit-exam-popup-background').style.display = 'none';
    });

    // Add exam when "Add" button is clicked
    document.getElementById('submit-exam').addEventListener('click', function (event) {
        event.preventDefault();
    });

    document.querySelectorAll('.admin-exam-delete form').forEach(function (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            const examId = this.querySelector('input[name="exam_id"]').value;
            if (confirm("Are you sure you want to delete this exam?")) {

                deleteExam(examId, this.closest('.admin-exam-information'));
            }
        });
    });
});

// Fetch exam details using examId
function openEditPopup(examId) {
    
    const examInfo = document.querySelector(`.admin-exam-information[data-exam-id='${examId}']`);

    if (examInfo) {
        document.querySelector('#popup-exam-name').value = examInfo.querySelector('.admin-add-exam-name span').textContent;
        document.querySelector('#popup-examiner-id').value = examInfo.querySelector('.admin-assigned-examiner span').textContent;
        document.querySelector('#popup-exam-deadline').value = examInfo.querySelector('.admin-exam-deadline span').textContent;
        document.querySelector('#popup-exam-password').value = examInfo.querySelector('.admin-exam-password span').textContent;

        // Setted the hidden input for exam ID
        const examIdInput = document.createElement("input");
        examIdInput.type = "hidden";
        examIdInput.name = "exam_id";
        examIdInput.value = examId;
        document.querySelector('.admin-edit-exam-popup-body form').appendChild(examIdInput);

        // Show the edit popup
        document.querySelector('.admin-edit-exam-popup-background').style.display = 'flex';
    }
}

//Delete Exam
function deleteExam(examId, examElement) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "adminDeleteExams.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            examElement.remove();
            alert('Exam deleted successfully.');
        } else if (xhr.readyState === 4) {

            alert('Failed to delete the exam.');
        }
    };

    xhr.send("exam_id=" + encodeURIComponent(examId));
}
