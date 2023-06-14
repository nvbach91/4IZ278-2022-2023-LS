const totalPrice = $("input[name='totalPrice']");
const quantity = $( "input[name='quantity[]']" );
const prices = $( "input[name='priceEach[]']" );
function calculatePrice(){
    let total = 0;
    for(let i = 0; i <quantity.length; i++){
        total += (parseFloat(quantity[i].value)*parseFloat(prices[i].value));
    }
    totalPrice.val(total.toFixed(2));
}
for(let i = 0; i <quantity.length; i++){
    $(quantity[i]).on('change',function(){
        calculatePrice();
    })
};