let windowWidth = null;
let resetPasswordButton = document.getElementById("resetPasswordButton")

const setUserDetailIconMode = () => {
    // Check necessary for Android devices
    if (window.innerWidth === windowWidth) {
        return;
    }

    windowWidth = window.innerWidth;

    if (window.innerWidth < 1200) {
        resetPasswordButton.innerHTML = resetPasswordButton.innerHTML.replace(resetPasswordButton.innerHTML, '<button type="button" class="call-btn btn btn-outline-primary btn-floating btn-sm float-end"><i class="fas fa-pencil"></i></button>')
    } else {
        resetPasswordButton.innerHTML = resetPasswordButton.innerHTML.replace(resetPasswordButton.innerHTML, '<button type="button" class="btn btn-primary btn-sm float-end"><i class="fas fa-solid fa-pencil me-2"></i>Změnit heslo</button>')
    }
};

setUserDetailIconMode();
window.addEventListener("resize", setUserDetailIconMode);