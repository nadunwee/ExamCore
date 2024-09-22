 // Function to edit profile
 function editProfile() {
    const form = document.getElementById('studentForm');
    const formData = new FormData(form);
    const profileData = {};
    formData.forEach((value, key) => {
        profileData[key] = value;
    });
    console.log('Profile data to be updated:', profileData);
    // Logic to send data to the server or update local storage
    alert('Profile updated successfully!');
}

// Function to change password
function changePassword() {
    window.location.href = 'studentPasswordReset.html';
    
}

// Function to delete profile
function deleteProfile() {
    const confirmation = confirm('Are you sure you want to delete your profile?');
    if (confirmation) {
        console.log('Profile deleted');
        // Logic to delete profile from the server or local storage
        alert('Profile deleted successfully!');
    }
}