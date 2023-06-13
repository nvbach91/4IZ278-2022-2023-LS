function logout() {

    ConfirmWarning.fire({
        text: "Opravdu se chceš odhlásit?",
        confirmButtonText: 'Odhlásit se'
    }).then((resultChange) => {
        if (resultChange.isConfirmed) {
            window.location.href = "/auth/sign-out";
        }
    })

}