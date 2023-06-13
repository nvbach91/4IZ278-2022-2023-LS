let windowWidth2 = null;
let newPermissionButton = document.getElementById("newPermissionButton")

const setUserDetailNewPermissionIconMode = () => {
    // Check necessary for Android devices
    if (window.innerWidth === windowWidth2) {
        return;
    }

    windowWidth2 = window.innerWidth;

    if (window.innerWidth < 1200) {
        newPermissionButton.innerHTML = newPermissionButton.innerHTML.replace(newPermissionButton.innerHTML, '<button type="button" class="call-btn btn btn-outline-success btn-floating btn-sm float-end"><i class="fas fa-plus"></i></button>')
    } else {
        newPermissionButton.innerHTML = newPermissionButton.innerHTML.replace(newPermissionButton.innerHTML, '<button type="button" class="btn btn-success btn-sm float-end"><i class="fas fa-plus me-2"></i>Přidat nové oprávnění</button>')
    }
};

setUserDetailNewPermissionIconMode();
window.addEventListener("resize", setUserDetailNewPermissionIconMode);