 // Get references to buttons
 const editButton = document.querySelector('.edit');
 const changePWButton = document.querySelector('.changePW');
 const deleteButton = document.querySelector('.delete');

 // Add event listeners for button clicks
 editButton.addEventListener('click', function() {
     window.location.href = 'editStudentProfile.html'; // Redirect to the edit profile page
 });

 changePWButton.addEventListener('click', function() {
     window.location.href = 'studentPasswordReset.html'; // Redirect to the password reset page
 });

 deleteButton.addEventListener('click', function() {
     window.location.href = 'deleteStudentAccount.html'; // Redirect to the delete profile page
 });
