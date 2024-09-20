
            // Get references to buttons
            const editButton = document.querySelector('.edit');
            const changePWButton = document.querySelector('.changePW');
            const deleteButton = document.querySelector('.delete');

            // Add event listeners for button clicks
            editButton.addEventListener('click', function() {
                window.location.href = 'editExaminerProfile.html'; // Redirect to the edit profile page
            });

            changePWButton.addEventListener('click', function() {
                window.location.href = 'examinerPasswordReset.html'; // Redirect to the password reset page
            });

            deleteButton.addEventListener('click', function() {
                window.location.href = 'deleteExaminerAccount.html'; // Redirect to the delete profile page
            });
       