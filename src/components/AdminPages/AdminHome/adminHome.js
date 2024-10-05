document.addEventListener("DOMContentLoaded", function () {
  console.log("loaded");

  const logoutButton = document.getElementById("logout-btn");
  const deleteBtn = document.getElementById("delete-btn");

  if (logoutButton) {
    console.log("logbtn");

    logoutButton.addEventListener("click", function () {
      const confirmation = confirm("Are you sure you want to log out?");
      if (confirmation) {
        window.location.href = "../../../../HomePage.html"; // Redirect to home page
      }
    });
  } else {
    console.error("Logout button not found");
  }

  if (deleteBtn) {
    deleteBtn.addEventListener("click", function (event) {
      const confirmation = confirm("Are You Sure");
      if (!confirmation) {
        event.preventDefault();
      }
    });
  }
});
