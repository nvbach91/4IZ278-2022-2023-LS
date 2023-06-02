export function diplayErrors(formPara, form, errors) {
    if (document.querySelector(formPara) == null) {
        document.querySelector(form).insertAdjacentHTML("beforeend", "<p style='color:red;'></p>");
    }
    let errorMsg = "";
    if (Array.isArray(errors)) {
        errors.forEach(error => {
            errorMsg += error+"<br>";
        }); 
    } else {
        errorMsg = errors;
    }

    document.querySelector(formPara).innerHTML = errorMsg;
}

export function noTokenErr(response) {
    if (response == "noToken") {window.location.href = "/www/mikd08/sp/index.php"}
}

