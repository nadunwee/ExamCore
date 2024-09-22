//admin add exam pop up functionalities
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

    //admin edit exam popup opening after clicking "edit" icon in the information bar
    //edit exam popup functionalities
    document.querySelector('.admin-exam-content').addEventListener('click', function (e) {
        if (e.target.closest('.admin-exam-edit')) {
            console.log('edit icon clicked');

            const examEdit = e.target.closest('.admin-exam-information');

            if(examEdit){
                var examName = examEdit.querySelector('.admin-add-exam-name .admin-get-exam-data').textContent;
                var assignedExaminer = examEdit.querySelector('.admin-assigned-examiner .admin-get-exam-data').textContent;
                var examDeadline = examEdit.querySelector('.admin-exam-deadline .admin-get-exam-data').textContent;
                var examPassword = examEdit.querySelector('.admin-exam-password .admin-get-exam-data').textContent;
            }   
            console.log(examName); 
            //this have to access DB, get data to these variables and update       

            document.querySelector('.admin-edit-exam-popup-background').style.display = 'flex';

            document.getElementById('popup-exam-name').value = examName;
            document.getElementById('popup-examiner-name').value = assignedExaminer;
            document.getElementById('popup-exam-deadline').value = examDeadline;
            document.getElementById('popup-exam-password').value = examPassword;

            document.querySelector('.admin-edit-exam-button').addEventListener('click', function (e) {
                console.log("Edit Exam button clicked");
                console.log("Exam Name:", examName);
                console.log("Assign To:", assignedExaminer);
                console.log("Exam Deadline:", examDeadline);
                console.log("Exam Password:", examPassword);

                examEdit.querySelector('.admin-add-exam-name .admin-get-exam-data').textContent = document.getElementById('popup-exam-name').value;
                examEdit.querySelector('.admin-assigned-examiner .admin-get-exam-data').textContent = document.getElementById('popup-examiner-name').value;
                examEdit.querySelector('.admin-exam-deadline .admin-get-exam-data').textContent = document.getElementById('popup-exam-deadline').value;
                examEdit.querySelector('.admin-exam-password .admin-get-exam-data').textContent = document.getElementById('popup-exam-password').value;
            })

            document.querySelector('.admin-edit-exam-popup-button').addEventListener('click', function () {
                document.querySelector('.admin-edit-exam-popup-background').style.display = 'none';
            });

            //Delete exam button on the information bar
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

        }
    });
});


//admin exam infomation bar after clicking "Add" button in the popup
function addExam(examName, examinerName, deadline, password) {

    var examName = document.getElementById('popup-exam-name').value;
    var assignedExaminer = document.getElementById('popup-examiner-name').value;
    var examDeadline = document.getElementById('popup-exam-deadline').value;
    var examPassword = document.getElementById('popup-exam-password').value;

    console.log("Exam Name:", examName);
    console.log("Assign To:", assignedExaminer);
    console.log("Exam Deadline:", examDeadline);
    console.log("Exam Password:", examPassword);

    // const examInfoArray = [10];
    // examInfoArray[0] = examName;
    // examInfoArray[1] = assignedExaminer;
    // examInfoArray[2] = examDeadline;
    // examInfoArray[3] = examPassword;

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
                <img src="../../../Images/editIcon.png" alt="edit">
            </div>
            <div class="admin-exam-delete">
                <img src="../../../Images/deleteIcon.png" alt="delete">
            </div>
        </span>
    `;

    document.querySelector('.admin-exam-content').appendChild(newExamDiv);
}
function editExam(){

}
