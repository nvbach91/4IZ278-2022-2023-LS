window.addEventListener("scroll", () => {
    document.querySelectorAll(".overlay").forEach(overlay => {
        overlay.style.top = window.pageYOffset + "px";
        
    })
})

document.querySelectorAll(".overlay").forEach(overlay => overlay.addEventListener("click", e => {
    if (e.target.className == "overlay") {
        document.querySelector("#login").style.display = "none";
        document.querySelector("#register").style.display = "none";
        document.querySelector("body").style.overflow = "auto";
    }
}));
document.querySelector("#login-btn").addEventListener("click", () => {
    document.querySelector("#login").style.display = "flex";
    document.querySelector("body").style.overflow = "hidden";
});
document.querySelector("#register-btn").addEventListener("click", () => {
    document.querySelector("#register").style.display = "flex";
    document.querySelector("body").style.overflow = "hidden";
});
document.querySelector("#register-link").addEventListener("click", () => {
    document.querySelector("#login").style.display = "none";
    document.querySelector("#register").style.display = "flex";
    document.querySelector("body").style.overflow = "hidden";
});

document.querySelectorAll("span#buy-btn").forEach(btn => {
    btn.addEventListener("click", e => {
        document.querySelector("#login").style.display = "flex";
        document.querySelector("body").style.overflow = "hidden";
    })
});
