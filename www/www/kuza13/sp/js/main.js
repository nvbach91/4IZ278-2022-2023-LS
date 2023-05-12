$(function () {
  const links_with_id = $(".buyButton");
  const cart_value = $("#productsAmount");
  $.each(links_with_id, function () {
    $(this).bind("click", function () {
      let current_id = $(this).attr("data-id");
      $.post( "api.php", { "product_id" : current_id }).done(function (data) {
        cart_value.html(data);
        });
    });
  });
  $(function(){
    let cartAmount = $('#cartAmount').text();
    // $('#cartAmountEnd')
    $('#cartAmountEnd').html(cartAmount);
    cart_value.html(cartAmount);
  });
});
