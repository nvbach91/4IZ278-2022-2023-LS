window.addEventListener("scroll", () => {
    document.querySelectorAll(".overlay").forEach(overlay => {
        overlay.style.top = window.pageYOffset + "px";
        
    })
})

document.querySelectorAll(".overlay").forEach(overlay => overlay.addEventListener("click", e => {
    if (e.target.className == "overlay") {
        document.querySelector("#addCategory").style.display = "none";
        document.querySelector("#addProduct").style.display = "none";
        document.querySelector("#editProduct").style.display = "none";
        document.querySelector("body").style.overflow = "auto";
    }
}));
document.querySelector("#addCategory-btn").addEventListener("click", () => {
    document.querySelector("#addCategory").style.display = "flex";
    document.querySelector("body").style.overflow = "hidden";
});
document.querySelector("#addProduct-btn").addEventListener("click", () => {
    document.querySelector("#addProduct").style.display = "flex";
    document.querySelector("body").style.overflow = "hidden";
});
document.querySelectorAll(".editProduct-btn").forEach(editProductBtn => {
    editProductBtn.addEventListener("click", e => {
        console.log(editProductBtn.getAttribute("name"));
        
        let xhr = new XMLHttpRequest();
        xhr.open("GET", "editProduct.php?edit=" + editProductBtn.getAttribute("name"), true);
        
        xhr.onload = () => {
            if(xhr.status == 200){
                console.log(xhr.responseText);
                let product = JSON.parse(xhr.responseText);
                document.querySelector("#editProductForm input[name='product_id']").value = product.product_id;
                document.querySelector("#editProductForm input[name='name']").value = product.name;
                document.querySelector("#editProductForm input[name='price']").value = product.price;
                document.querySelector("#editProductForm textarea[name='img']").textContent = product.img;
                document.querySelector("#editProductForm input[name='category']").value = product.category_name;
            }
        }
        
        xhr.send();

        document.querySelector("#editProduct").style.display = "flex";
        document.querySelector("body").style.overflow = "hidden"; 

        

    });
}); 