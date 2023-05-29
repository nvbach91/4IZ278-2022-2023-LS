let xhr = new XMLHttpRequest();

let body = document.querySelector("body");

document.querySelectorAll(".addToCart-link").forEach(addToCartLink => {
    addToCartLink.addEventListener("click", e => {
        e.preventDefault();

        xhr.open("GET", addToCartLink.href , true);
        xhr.send();
        body.insertAdjacentHTML("afterbegin", `<div id="blink" style="background-color: white; width: 100vw; height: 100vh; position: absolute; z-index: 1000000;"></div>`);
        setTimeout(() => {document.querySelector("#blink").remove()}, 100);
    });
}); 
 
window.addEventListener("scroll", () => {
    document.querySelectorAll(".overlay").forEach(overlay => {
        overlay.style.top = window.pageYOffset + "px";
    })
})

document.querySelectorAll(".overlay").forEach(overlay => overlay.addEventListener("click", e => {
    if (e.target.className == "overlay") {
        document.querySelector("#orderDetails").style.display = "none";
        body.style.overflow = "auto";
    }
}));
let tableBody = document.querySelector("#orderDetails tbody");
document.querySelectorAll(".orderDetails-btn").forEach(orderDetailsBtn => {
    orderDetailsBtn.addEventListener("click", e => {
        e.preventDefault();
        
        xhr.open("GET", orderDetailsBtn.href , true);
        xhr.send();
        xhr.onload = () => {
            if (xhr.status == 200) {
                let orderDetails = JSON.parse(xhr.responseText);
                tableBody.innerHTML = ""
                document.querySelector("#orderDetails h1").textContent = "order ID: " + orderDetails[0].order_id;
                document.querySelector("#orderDetails h3").textContent = "order date: "+orderDetails[0].date;
                orderDetails.forEach(productDetails => {
                    tableBody.insertAdjacentHTML("beforeend", `
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
                body.style.overflow = "hidden"; 
            }
            if (xhr.status == 400) {
                window.location.href = "/www/mikd08/sp/profile.php"
            }

        }
        
    });
}); 