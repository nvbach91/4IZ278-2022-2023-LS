function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

ConfirmWarning.fire({
    title: 'Vyloučení odpovědnosti',
    html: 'Tato webová aplikace vznikla jako semestrální práce pro předmět 4IZ278 Webové Aplikace na Fakultě informatiky a statistiky VŠE v Praze.<br><br><b>Webová aplikace slouží pouze ke vzdělávacím účelům!</b><br><br><br>' +
        '<b>Disclaimer:</b><br>This web application was developed as a part of term work for the course 4IZ278 Web Applications at the Faculty of Informatics and Statistics at the Prague University of Economics and Business.<br><br><b>This web application is for educational purposes only!</b>',
    icon: 'warning',
    cancelButtonText: 'Odejít',
}).then((resultChange) => {
    if (resultChange.isConfirmed) {
        setCookie('Disclaimer', 'confirmed', 7)
        window.location.href = "/";
    } else {
        location.href = "https://fis.vse.cz/"
    }
})