//admin addd exam pop up functionalities
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('admin-add-an-exam-Btn').addEventListener('click', function () {
        console.log('Add exam button clicked');

        document.getElementById('popup-exam-name').value = "";
        document.getElementById('popup-examiner-name').value = "";
        document.getElementById('popup-exam-deadline').value = "";
        document.getElementById('popup-exam-password').value = "";

        document.querySelector('.admin-exam-popup-background').style.display = 'flex';
    });

    document.querySelector('.admin-add-exam-popup-button').addEventListener('click', function () {
        document.querySelector('.admin-exam-popup-background').style.display = 'none';
    });

    document.querySelector('.admin-exam-content').addEventListener('click', function (e) {
        if (e.target.closest('.admin-exam-delete')) {
            console.log('Delete button clicked');

            const examDiv = e.target.closest('.admin-exam-information');
            if (examDiv) {
                examDiv.remove();
                console.log('Exam deleted');
            }
        }

        //**Reminder: Also need to remove data from SQL database
    });


});

//admin exam infomation bar
function addExam(examName, examinerName, deadline, password) {

    var examName = document.getElementById('popup-exam-name').value;
    var assignedExaminer = document.getElementById('popup-examiner-name').value;
    var examDeadline = document.getElementById('popup-exam-deadline').value;
    var examPassword = document.getElementById('popup-exam-password').value;

    console.log("Exam Name:", examName);
    console.log("Assign To:", assignedExaminer);
    console.log("Exam Deadline:", examDeadline);
    console.log("Exam Password:", examPassword);

    var newExamDiv = document.createElement('div');
    newExamDiv.classList.add('admin-exam-information');
    
    newExamDiv.innerHTML = `
        <div class="admin-add-exam-name">
            <p>Exam_Name</p>
            <span class="admin-get-exam-data">${examName}</span>
        </div>
        <div class="admin-assigned-examiner">
            <p>Assigned_Examiner</p>
            <span class="admin-get-exam-data">${assignedExaminer}</span>
        </div>
        <div class="admin-exam-deadline">
            <p>Exam_Deadline</p>
            <span class="admin-get-exam-data">${examDeadline}</span>
        </div>
        <div class="admin-exam-password">
            <p>Exam_Password</p>
            <span class="admin-get-exam-data">${examPassword}</span>
        </div>
        <span class="admin-exam-emojies">
            <div class="admin-exam-edit">
                <a href="#"><img src="../../../Images/editIcon.png" alt="edit"></a>
            </div>
            <div class="admin-exam-delete">
                <img src="../../../Images/deleteIcon.png" alt="delete">
            </div>
        </span>
    `;

    document.querySelector('.admin-exam-content').appendChild(newExamDiv);
}
