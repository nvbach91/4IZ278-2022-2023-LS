import {diplayErrors} from "./funcs.js";

let overlays = document.querySelectorAll(".overlay");
let loginOverlayDisplayStyle = document.querySelector("#login").style;
let registerOverlayDisplayStyle = document.querySelector("#register").style;
let bodyOverflowStyle = document.querySelector("body").style;

window.addEventListener("scroll", () => {
    overlays.forEach(overlay => {
        overlay.style.top = window.pageYOffset + "px";
        
    })
})

overlays.forEach(overlay => overlay.addEventListener("click", e => {
    if (e.target.className == "overlay") {
        loginOverlayDisplayStyle.display = "none";
        registerOverlayDisplayStyle.display = "none";
        bodyOverflowStyle.overflow = "auto";
    }
}));
document.querySelector("#login-btn").addEventListener("click", () => {
    loginOverlayDisplayStyle.display = "flex";
    bodyOverflowStyle.overflow = "hidden";
});
document.querySelector("#register-btn").addEventListener("click", () => {
    registerOverlayDisplayStyle.display = "flex";
    bodyOverflowStyle.overflow = "hidden";
});
document.querySelector("#register-link").addEventListener("click", () => {
    loginOverlayDisplayStyle.display = "none";
    registerOverlayDisplayStyle.display = "flex";
    bodyOverflowStyle.overflow = "hidden";
});

document.querySelectorAll("span#buy-btn").forEach(btn => {
    btn.addEventListener("click", e => {
        loginOverlayDisplayStyle.display = "flex";
        bodyOverflowStyle.overflow = "hidden";
    })
});
let xhr = new XMLHttpRequest();

document.querySelector("#loginForm").addEventListener("submit", e => {
    e.preventDefault();
    xhr.open("POST", "/www/mikd08/sp/login.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("username=" + document.querySelector("#loginForm input[name='username']").value
        + "&password=" + document.querySelector("#loginForm input[name='password']").value
    );
    
    xhr.onload = () => {
        if(xhr.status == 200){
            location.replace("/www/mikd08/sp/index.php");
        } else if (xhr.status == 400) {
            diplayErrors("#loginForm p", "#loginForm", xhr.response);
        }
    }
    
    // let data = {
    //     username: document.querySelector("#login input[name='username']").value,
    //     password: document.querySelector("#login input[name='password']").value
    // }
    // fetch("login.php", {
    //     method: "POST",
    //     body: JSON.stringify(data),
    //     header: {
    //       "Content-type": "application/json; charset=UTF-8"
    //     }
    // }).then(res => res.json())
    //   .then(data => console.log(data))
    //   .catch(err => err)
})

document.querySelector("#registerForm").addEventListener("submit", e => {
    e.preventDefault();
    xhr.open("POST", "/www/mikd08/sp/register.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("username=" + document.querySelector("#registerForm input[name='username']").value
        + "&password=" + document.querySelector("#registerForm input[name='password']").value
        + "&name=" + document.querySelector("#registerForm input[name='name']").value
        + "&email=" + document.querySelector("#registerForm input[name='email']").value
        + "&address=" + document.querySelector("#registerForm input[name='address']").value
        + "&phone=" + document.querySelector("#registerForm input[name='phone']").value
    );
    
    xhr.onload = () => {
        if(xhr.status == 200){
            location.replace("/www/mikd08/sp/index.php");
        } else if (xhr.status == 400) {
            let errors = JSON.parse(xhr.response);
            diplayErrors("#registerForm p", "#registerForm", errors)
        }
    }
    
})

