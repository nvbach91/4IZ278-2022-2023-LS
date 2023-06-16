let windowWidth = null;
let resetPasswordButton = document.getElementById("resetPasswordButton")
let blockUserButton = document.getElementById("blockUserButton")
let blocked = document.getElementById("blocked").value

const setUserDetailIconMode = () => {
    // Check necessary for Android devices
    if (window.innerWidth === windowWidth) {
        return;
    }

    windowWidth = window.innerWidth;

    if (window.innerWidth < 1200) {
        resetPasswordButton.innerHTML = resetPasswordButton.innerHTML.replace(resetPasswordButton.innerHTML, '<button type="button" class="call-btn btn btn-outline-primary btn-floating btn-sm float-end"><i class="fas fa-key"></i></button>')
        blockUserButton.innerHTML = blockUserButton.innerHTML.replace(blockUserButton.innerHTML, blocked ? '<button type="button" class="call-btn btn btn-outline-success btn-floating btn-sm float-end"><i class="fas fa-unlock"></i></button>' : '<button type="button" class="call-btn btn btn-outline-danger btn-floating btn-sm float-end"><i class="fas fa-lock"></i></button>')
    } else {
        resetPasswordButton.innerHTML = resetPasswordButton.innerHTML.replace(resetPasswordButton.innerHTML, '<button type="button" class="btn btn-primary btn-sm float-end"><i class="fas fa-solid fa-key me-2"></i>Resetovat heslo</button>')
        blockUserButton.innerHTML = blockUserButton.innerHTML.replace(blockUserButton.innerHTML, blocked ? '<button type="button" class="btn btn-success btn-sm float-end"><i class="fas fa-solid fa-unlock me-2"></i>Odblokovat uživatele</button>' : '<button type="button" class="btn btn-danger btn-sm float-end"><i class="fas fa-solid fa-lock me-2"></i>Zablokovat uživatele</button>')
    }
};

setUserDetailIconMode();
window.addEventListener("resize", setUserDetailIconMode);