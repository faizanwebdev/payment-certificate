<?php 
function cleanup( $data ) {
//    global $con;
    $data = trim( $data );
    $data = htmlspecialchars( $data );
//    $data = mysqli_real_escape_string($con, $data);
    return $data;
}
if(isset($_REQUEST['generate'])){
    $fname = cleanup($_REQUEST['fname']);
    $lname = cleanup($_REQUEST['lname']);
    $email = cleanup($_REQUEST['email']);
    $amount = cleanup($_REQUEST['amount']);
    $membership = cleanup($_REQUEST['membership']);
}

?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<form>
    <input type="hidden" name="fname" id="fname" value="<?php echo $fname ?>" />
    <input type="hidden" name="lname" id="lname" value="<?php echo $lname ?>" />
    <input type="hidden" name="email" id="email" value="<?php echo $email ?>" />
    <input type="hidden" name="amount" id="amount" value="<?php echo $amount ?>" />
    <input type="hidden" name="membership" id="membership" value="<?php echo $membership ?>" />
<!--    <input type="button" name="btn" id="btn" value="Pay Now" onclick="pay_now()"/>-->
</form>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
<script>
//    function pay_now(){
        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var email = $('#email').val();
        var amount = $('#amount').val();
        var membership = $('#membership').val();
        
//         jQuery.ajax({
//               type:'post',
//               url:'payment_process.php',
//               data:"amt="+amt+"&name="+name,
//               success:function(result){
                   var options = {
                        "key": "rzp_test_GmxjuICafMVMnA", 
                        "amount": amount*100, 
                        "currency": "INR",
                        "name": "AICPDF",
                        "description": membership+" Transaction",
                        "image": "https://5ku.d9e.myftpupload.com/wp-content/uploads/2022/02/AICPDF-Logo-2.png-2.png",
                        "handler": function (response){
                           $.ajax({
                               type:'POST',
                               url:'pay.php',
                               data:{payment_id:response.razorpay_payment_id},
                               success:function(result){
//                                   console.log(result);
                                   var data = JSON.parse(result);
//                                   alert(data.status);
                                   if(data.status == "success"){
                                       window.location.href="cert-gen.php?fname="+fname+"&lname="+lname+"&email="+email+"&membership="+membership+"&generate='generate'";
                                   }
                                   else{
                                       window.location.href="fail.html";
                                   }
                               }
                           });
                        }
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
//               }
//           });
        
        
//    }
</script>
