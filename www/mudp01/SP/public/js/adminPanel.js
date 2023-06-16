const previousOrder = $('#previousOrder');
const nextOrder = $('#nextOrder');

function getOrdersParameter() {
    const urlParams = new URLSearchParams(window.location.search);
    return  urlParams.get('orders');
}

nextOrder.on('click', () => {
    var url_params = new URLSearchParams(window.location.search);
    if (url_params.get('orders') == null) {
        window.location.replace('./adminPanel/?orders=2');
    }else{
        currentOrderPage = getOrdersParameter();
        window.location.replace(`./adminPanel/?orders=${parseInt(currentOrderPage) + 1}`);
    }
});

previousOrder.on('click', () => {
    var url_params = new URLSearchParams(window.location.search);
    if (url_params.get('orders') == null) {
        window.location.replace('./adminPanel/?orders=1');
    }else{
        currentOrderPage = getOrdersParameter();
        if(parseInt(currentOrderPage)<=1){
            window.location.replace('./adminPanel/?orders=1');
        }else{
            window.location.replace(`./adminPanel/?orders=${parseInt(currentOrderPage) - 1}`);
        }
    }
});