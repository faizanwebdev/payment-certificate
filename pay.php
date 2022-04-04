<?php 

	$data = [ 
		'payment_id' => $_POST['payment_id'],
//		'amount' => $_POST['amount']
//		'product_id' => $_POST['product_id'],
	];

//check payment is authrized or not via API call
		
		$razorPayId = $_POST['payment_id'];
		
        $ch = curl_init('https://api.razorpay.com/v1/payments/'.$razorPayId.'');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($ch, CURLOPT_USERPWD, "rzp_test_GmxjuICafMVMnA:wrqlWetUo11cuuaFltcmYR63"); // Input your Razorpay Key Id and Secret Id here
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = json_decode(curl_exec($ch));
		
		$response->status; // authorized

// you can write your database insert code here

// check that payment is authorized by razorpay or not
if($response->status == 'authorized')
{
$respval = array('msg' => 'Payment successful', 'status' => 'success');  

echo json_encode($respval);
}


?>