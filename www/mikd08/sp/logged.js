let xhr = new XMLHttpRequest();


document.querySelectorAll(".addToCart-link").forEach(addToCartLink => {
    addToCartLink.addEventListener("click", e => {
        e.preventDefault();
        xhr.open("GET", addToCartLink.href , true);
        xhr.send();
        
    });
}); 

//orderdetails ajax
window.addEventListener("scroll", () => {
    document.querySelectorAll(".overlay").forEach(overlay => {
        overlay.style.top = window.pageYOffset + "px";
    })
})

document.querySelectorAll(".overlay").forEach(overlay => overlay.addEventListener("click", e => {
    if (e.target.className == "overlay") {
        document.querySelector("#orderDetails").style.display = "none";
        document.querySelector("body").style.overflow = "auto";
    }
}));

document.querySelectorAll(".orderDetails-btn").forEach(orderDetailsBtn => {
    orderDetailsBtn.addEventListener("click", e => {
        e.preventDefault();
        
        xhr.open("GET", orderDetailsBtn.href , true);
        xhr.send();
        xhr.onload = () => {
            if (xhr.status == 200) {
                let orderDetails = JSON.parse(xhr.responseText);
                console.log(orderDetails);
                document.querySelector("#orderDetails tbody").innerHTML = ""
                document.querySelector("#orderDetails h1").textContent = "order ID: " + orderDetails[0].order_id;
                document.querySelector("#orderDetails h3").textContent = "order date: "+orderDetails[0].date;
                orderDetails.forEach(productDetails => {
                    document.querySelector("#orderDetails tbody").insertAdjacentHTML("beforeend", `
                    <tr>
                        <td>${productDetails.name}</td>
                        <td>${productDetails.product_price + "Kč"}</td>
                        <td>${productDetails.amount + "ks"}</td>
                        <td>${productDetails.order_product_price + "Kč"}</td>
                    </tr>
                    `)
                });
                document.querySelector("#orderDetails #total").textContent = "Total: "+orderDetails[0].order_price + "Kč";
                document.querySelector("#orderDetails").style.display = "flex";
                document.querySelector("body").style.overflow = "hidden"; 
            }
            if (xhr.status == 400) {
                console.log("error");
                window.location.href = "profile.php"
            }

        }
        
    });
}); 