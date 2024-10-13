let modal = document.getElementById("editModal");

function onEditBtnClick() {
  modal.classList.add("show-modal");
}

function onCloseBtnClick() {
  modal.classList.remove("show-modal");
}

document.addEventListener("DOMContentLoaded", function () {
  const logoutButton = document.getElementById("logout-btn");
  const deleteBtn = document.getElementById("delete-btn");

  if (logoutButton) {
    logoutButton.addEventListener("click", function () {
      const confirmation = confirm("Are you sure you want to log out?");
      if (confirmation) {
        window.location.href = "../../../../HomePage.html";
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
