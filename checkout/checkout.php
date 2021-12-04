<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<form name='razorpayform' action="verify.php" method="POST">
    
</form>
<script>
// Checkout details as a json

var options = <?php echo $json_payment?>;

options.handler = function (response){
   
    $.ajax({
    type: "POST",
    url: "api/decryptor.php",
     data: {
         
         "paymentid":  response.razorpay_payment_id,
         "signature": response.razorpay_signature,
         "url": "<?php echo $url?>",
         
     },
     cache: false,
    success: function(data){
	  $("#generatebox").fadeToggle( "fast");
      $("#successcontainer").show();
        editor.render(data);
     console.log(data);
  }
});
    
};

// Boolean whether to show image inside a white frame. (default: true)
options.theme.image_padding = false;

var rzp = new Razorpay(options);

document.getElementById('rzp-button1').onclick = function(e){
    rzp.open();
    e.preventDefault();
}
</script>