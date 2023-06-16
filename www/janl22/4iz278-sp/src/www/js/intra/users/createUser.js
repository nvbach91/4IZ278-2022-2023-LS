let windowWidth = null;
let newUserButton = document.getElementById("newUserButton");

const setUsersIconMode = () => {
    // Check necessary for Android devices
    if (window.innerWidth === windowWidth) {
        return;
    }

    windowWidth = window.innerWidth;

    if (window.innerWidth < 1200) {
        newUserButton.innerHTML = newUserButton.innerHTML.replace(newUserButton.innerHTML, '<button type="button" class="call-btn btn btn-outline-success btn-floating btn-sm float-end"><i class="fas fa-plus"></i></button>')
    } else {
        newUserButton.innerHTML = newUserButton.innerHTML.replace(newUserButton.innerHTML, '<button type="button" class="btn btn-success btn-sm float-end"><i class="fas fa-plus me-2"></i>Přidat uživatele</button>')
    }
};

setUsersIconMode();
window.addEventListener("resize", setUsersIconMode);