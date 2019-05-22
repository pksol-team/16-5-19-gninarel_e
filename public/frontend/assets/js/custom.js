jQuery(document).ready(function($) {

    $('.selectpicker').selectpicker();

   var quantitiy = 0;

   var price = $('.book_price_main').val();

   $('button.qty-change.plus').click(function (e) {
     e.preventDefault();

     var quantity = parseInt($('input.qty-input.form-group').val());

     $('input.qty-input.form-group').val(quantity + 1);

     var quantity_exact = $('input.qty-input.form-group').val();

     var myResult = quantity_exact * price;


     $('.total_price span').text(myResult);
     $('.total_price_hidden').val(myResult);
  });

   $('button.qty-change.minus').click(function (e) {
     e.preventDefault();

     var quantity = parseInt($('input.qty-input.form-group').val());

     if (quantity > 1) {
       $('input.qty-input.form-group').val(quantity - 1);
     }

     var quantity_exact = $('input.qty-input.form-group').val();

     var myResult = quantity_exact * price;


     $('.total_price span').text(myResult);
     $('.total_price_hidden').val(myResult);
   });


   
  
});