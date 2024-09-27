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
            const examEdit = e.target.closest('.admin-exam-information');
            if (examEdit) {
                var examID = examEdit.dataset.id; // Assuming you store the exam ID in a data attribute
                fetchExamData(examID); // Fetch data from the database
            }
        }
    });
});


//admin exam infomation bar after clicking "Add" button in the popup
function addExam() {
    var examName = document.getElementById('popup-exam-name').value;
    var assignedExaminer = document.getElementById('popup-examiner-name').value;
    var examDeadline = document.getElementById('popup-exam-deadline').value;
    var examPassword = document.getElementById('popup-exam-password').value;

    console.log("Exam Name:", examName);
    console.log("Assign To:", assignedExaminer);
    console.log("Exam Deadline:", examDeadline);
    console.log("Exam Password:", examPassword);

    // Send data to PHP script using Fetch API
    fetch('http://localhost/IWT_FINAL_PROJECT_ClONE/ExamCore/src/components/AdminPages/AdminExams/adminExam.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            exam_name: examName,
            assigned_examiner: assignedExaminer,
            exam_deadline: examDeadline,
            exam_password: examPassword
        }),
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            // If the insertion was successful, append to the UI
            renderExamData(examName, assignedExaminer, examDeadline, examPassword);
        }
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}

function renderExamData(examName, assignedExaminer, examDeadline, examPassword) {
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
function fetchExamData(examID) {
    fetch(`fetch_exam.php?id=${examID}`) // Create this PHP file to fetch exam data by ID
        .then(response => response.json())
        .then(data => {
            if (data) {
                document.getElementById('popup-exam-name').value = data.exam_name;
                document.getElementById('popup-examiner-name').value = data.examiner_id;
                document.getElementById('popup-exam-deadline').value = data.exam_deadline;
                document.getElementById('popup-exam-password').value = data.exam_password;

                document.querySelector('.admin-edit-exam-popup-background').style.display = 'flex';
            }
        })
        .catch(error => console.error('Error fetching exam data:', error));
}