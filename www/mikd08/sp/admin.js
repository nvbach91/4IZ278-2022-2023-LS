let xhr = new XMLHttpRequest();


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

        xhr.open("GET", "editProduct.php?edit=" + editProductBtn.getAttribute("name"), true);
        xhr.send();
        
        xhr.onload = () => {
            if(xhr.status == 200){
                let product = JSON.parse(xhr.responseText);
                document.querySelector("#editProductForm input[name='product_id']").value = product.product_id;
                document.querySelector("#editProductForm input[name='name']").value = product.name;
                document.querySelector("#editProductForm input[name='price']").value = product.price;
                document.querySelector("#editProductForm textarea[name='img']").textContent = product.img;
                document.querySelector("#editProductForm input[name='category']").value = product.category_name;
            }
        }
        

        document.querySelector("#editProduct").style.display = "flex";
        document.querySelector("body").style.overflow = "hidden"; 

        

    });
}); 

// document.querySelector("#addCategoryForm").addEventListener("submit" , e => {
//     e.preventDefault();
//     xhr.open("POST", "addCategory.php", true);
//     xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

//     xhr.onload = () => {
//         if(xhr.status == 200){
//             console.log(xhr.responseText);
           
//         }
//     }

//     xhr.send("category_name=" + document.querySelector("#addCategoryForm input[name='category_name']").value);

// })

// if (document.querySelector("#addCategoryForm input[name='category_name']").value == "") {
//     document.querySelector("#addCategoryForm input[name='category_name']").insertAdjacentHTML("afterend", "<p style='color:red;'>Error: Category name cannot be empty!</p>");
// }