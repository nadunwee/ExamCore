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

        // Collect form data
        var examName = document.getElementById('popup-exam-name').value;
        var examinerID = document.getElementById('popup-examiner-name').value;
        var examDeadline = document.getElementById('popup-exam-deadline').value;
        var examPassword = document.getElementById('popup-exam-password').value;

        // Check if all fields are filled
        if (examName && examinerID && examDeadline && examPassword) {
            // Send data to the PHP backend using Fetch
            fetch('adminExam.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `examName=${examName}&examinerID=${examinerID}&deadline=${examDeadline}&password=${examPassword}`,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Add the new exam data to the UI dynamically
                    appendNewExamToUI(examName, examinerID, examDeadline, examPassword);
                    document.querySelector('.admin-exam-popup-background').style.display = 'none';
                } else {
                    alert('Error adding exam. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        } else {
            alert('Please fill in all fields.');
        }
    });
});

// Function to dynamically add the new exam to the page
// function appendNewExamToUI(examName, examinerID, examDeadline, examPassword) {
//     var newExamDiv = document.createElement('div');
//     newExamDiv.classList.add('admin-exam-information');

//     newExamDiv.innerHTML = `
//         <div class="admin-add-exam-name">
//             <p>Exam Name:</p>
//             <span>${examName}</span>
//         </div>
//         <div class="admin-assigned-examiner">
//             <p>Assigned Examiner ID:</p>
//             <span>${examinerID}</span>
//         </div>
//         <div class="admin-exam-deadline">
//             <p>Exam Deadline:</p>
//             <span>${examDeadline}</span>
//         </div>
//         <div class="admin-exam-password">
//             <p>Exam Password:</p>
//             <span>${examPassword}</span>
//         </div>
//         <span class="admin-exam-emojies">
//             <div class="admin-exam-edit">
//                 <img src="../../../Images/editIcon.png" alt="edit">
//             </div>
//             <div class="admin-exam-delete">
//                 <img src="../../../Images/deleteIcon.png" alt="delete">
//             </div>
//         </span>`;

//     document.querySelector('.admin-exam-content').appendChild(newExamDiv);
// }