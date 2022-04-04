<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<body>
    <center>
<?php 
      date_default_timezone_set("Asia/Calcutta");
      if (isset($_REQUEST['generate'])) {
        $fname = htmlspecialchars(trim($_REQUEST['fname']));  
        $fname = strtoupper($fname);
        $ftwo = $fname[0].$fname[1];
        $lname = htmlspecialchars(trim($_REQUEST['lname']));
        $lname = strtoupper($lname);
        $email = htmlspecialchars(trim($_REQUEST['email']));
        $ltwo = $lname[0].$lname[1];
        $fullname = $fname." ".$lname;
//        $name_len = strlen($_POST['name']);
//        $occupation = strtoupper($_POST['occupation']);
        $datetoday = date('jS F Y');
        $enddate = date('jS F Y', strtotime('+1 years'));
//        if ($occupation) {
          $font_size_occupation = 15;
//        }
//        $id = 123;
        $membershipname = htmlspecialchars(trim($_REQUEST['membership']));
        if($membershipname == "Regular_Membership"){
            $membershipname = "Regular Membership";
            $memberslug = "RGM";
            $membershipno = date('Ym').$ftwo.$ltwo.$memberslug.date('d');
            
              echo 
              "<div class='container'><b>Congratulations! $fullname on becoming member of All India Consumer Products Distributors Federation (AICPDF).</b><br></div>";

              //designed certificate picture
              $image = "certificate-regular.jpg";

              $createimage = imagecreatefromjpeg($image);
              $date = date('dmYHis');
              //this is going to be created once the generate button is clicked
              $outputimage = "certificate/".$date."-".$fname.".jpg";
              $outputpdf = "certificate/".$date."-".$fname.".pdf";

              //then we make use of the imagecolorallocate inbuilt php function which i used to set color to the text we are displaying on the image in RGB format
              $white = imagecolorallocate($createimage, 0, 0, 0);
              $black = imagecolorallocate($createimage, 0, 0, 0);

              //Then we make use of the angle since we will also make use of it when calling the imagettftext function below
              $rotation = 0;

              //we then set the x and y axis to fix the position of our text name
              $origin_x = 630;
              $origin_y=680;

              //we then set the x and y axis to fix the position of our text occupation
              $origin1_x = 1320;
              $origin1_y=180;

              $origin3_x = 800;
              $origin3_y = 855; 
              $origin4_x = 850;
              $origin4_y = 900;
              $origin5_x = 830;
              $origin5_y = 945;

              $font_size = 40;

              $certificate_text = $fullname;

              //font directory for name
              $drFont = dirname(__FILE__)."/developer.ttf";

              // font directory for occupation name
              $drFont1 = dirname(__FILE__)."/Gotham-black.otf";

              //function to display name on certificate picture
              $text1 = imagettftext($createimage, $font_size, $rotation, $origin_x, $origin_y, $black,$drFont1, $certificate_text);

              //function to display occupation name on certificate picture
              $text2 = imagettftext($createimage, $font_size_occupation, $rotation, $origin1_x+2, $origin1_y, $black, $drFont1, $enddate);

              $text3 = imagettftext($createimage, $font_size_occupation, $rotation, $origin3_x+2, $origin3_y, $black, $drFont1, $datetoday);

              $text4 = imagettftext($createimage, $font_size_occupation, $rotation, $origin4_x+2, $origin4_y, $black, $drFont1, $membershipname);

              $text5 = imagettftext($createimage, $font_size_occupation, $rotation, $origin5_x+2, $origin5_y, $black, $drFont1, $membershipno);
              imagejpeg($createimage,$outputimage);
              imagedestroy($createimage);

              require_once('fpdf.php');
              $pdf=new FPDF('L','mm',array(155,220));
              $pdf->AddPage();
              $pdf->Image($outputimage,0,0,220,155);
              $pdf->Output($outputpdf,"F");

              require_once 'mailer/PHPMailerAutoload.php';
                    $mail = new PHPMailer; 
                    $mail->isSMTP();           
                    $mail->Host = 'smtp.gmail.com';   
                    $mail->SMTPAuth = true;     
                    $mail->Username = 'enable.onl@gmail.com';        
                    $mail->Password = '';    
                    $mail->SMTPSecure = 'tls';   
                    $mail->Port = 587;
                    $mail->setFrom('membership@aicpdf.com', 'AICPDF');
                    $mail->addAddress($email, 'User');
    //                $mail->addBCC('faizan.kazi@enlyft.in', 'User'); 
                    $mail->addAttachment($outputpdf);
                    $mail->isHTML(true);
                    $mail->Subject = 'AICPDF Membership Certificate';
                    $mail->Body    = "<p style='font-family:Arial, Helvetica, san-serif; font-size:12px;'>Dear <b>$fullname</b>,</p><br>
                    <p style='font-family:Arial, Helvetica, san-serif; font-size:12px;'>Your <b>$membershipname</b> with AICPDF is confirmed.</p>
                    <p style='font-family:Arial, Helvetica, san-serif; font-size:12px;'>Your Membership No. is  <b>$membershipno</b></p><br>
                    <p style='font-family:Arial, Helvetica, san-serif; font-size:12px;'>Included with this e-mail is your official <b>$membershipname</b> Certificate.</p>
                    <p style='font-family:Arial, Helvetica, san-serif; font-size:12px;'>Do not share the certificate with anyone.</p><br>
                    <p style='font-family:Arial, Helvetica, san-serif; font-size:12px;'>Please do not reply to this email. For additional assistance, you may visit our website at <a href='https://aicpdf.com' target='_blank'>https://aicpdf.com</a>.</p><br>";

             echo "<div class='container'><img width='900px' height='600px' src='$outputimage'><br></div>";
             echo "<div class='container'><a href='$outputpdf' onclick='home();' target='_blank' class='btn btn-success download'>Download Certificate</a><br></div>";

                if($mail->send()){
                    echo "<div class='container'><b>Your Membership Certificate has been sent on your email, Please Download the certificate by clicking on Download button as this page will expire in 2 minutes</b><br></div>";
                }
        }
        else{
            if($membershipname == "Life_Membership"){
                $membershipname = "Life Membership";
                $memberslug = "LFM";
            }
            if($membershipname == "Corporate_Membership"){
                $membershipname = "Corporate Membership";
                $memberslug = "CPM";
            }
            if($membershipname == "Patron_Membership"){
                $membershipname = "Patron Membership";
                $memberslug = "PTM";
            }
            $membershipno = date('Ym').$ftwo.$ltwo.$memberslug.date('d');

              echo 
              "<div class='container'><b>Congratulations! $fullname on becoming member of All India Consumer Products Distributors Federation (AICPDF).</b><br></div>";

              //designed certificate picture
              $image = "certificate-aicpdf.jpg";

              $createimage = imagecreatefromjpeg($image);
              $date = date('dmYHis');
              //this is going to be created once the generate button is clicked
              $outputimage = "certificate/".$date."-".$fname.".jpg";
              $outputpdf = "certificate/".$date."-".$fname.".pdf";

              //then we make use of the imagecolorallocate inbuilt php function which i used to set color to the text we are displaying on the image in RGB format
              $white = imagecolorallocate($createimage, 0, 0, 0);
              $black = imagecolorallocate($createimage, 0, 0, 0);

              //Then we make use of the angle since we will also make use of it when calling the imagettftext function below
              $rotation = 0;

              //we then set the x and y axis to fix the position of our text name
              $origin_x = 630;
              $origin_y=680;

              //we then set the x and y axis to fix the position of our text occupation
              $origin1_x = 120;
              $origin1_y=110;

              $origin3_x = 800;
              $origin3_y = 855; 
              $origin4_x = 850;
              $origin4_y = 900;
              $origin5_x = 830;
              $origin5_y = 945;

              $font_size = 40;

              $certificate_text = $fullname;

              //font directory for name
              $drFont = dirname(__FILE__)."/developer.ttf";

              // font directory for occupation name
              $drFont1 = dirname(__FILE__)."/Gotham-black.otf";

              //function to display name on certificate picture
              $text1 = imagettftext($createimage, $font_size, $rotation, $origin_x, $origin_y, $black,$drFont1, $certificate_text);

              //function to display occupation name on certificate picture
    //          $text2 = imagettftext($createimage, $font_size_occupation, $rotation, $origin1_x+2, $origin1_y, $black, $drFont1, $occupation);

              $text3 = imagettftext($createimage, $font_size_occupation, $rotation, $origin3_x+2, $origin3_y, $black, $drFont1, $datetoday);

              $text4 = imagettftext($createimage, $font_size_occupation, $rotation, $origin4_x+2, $origin4_y, $black, $drFont1, $membershipname);

              $text5 = imagettftext($createimage, $font_size_occupation, $rotation, $origin5_x+2, $origin5_y, $black, $drFont1, $membershipno);
              imagejpeg($createimage,$outputimage);
              imagedestroy($createimage);

              require_once('fpdf.php');
              $pdf=new FPDF('L','mm',array(155,220));
              $pdf->AddPage();
              $pdf->Image($outputimage,0,0,220,155);
              $pdf->Output($outputpdf,"F");

              require_once 'mailer/PHPMailerAutoload.php';
                    $mail = new PHPMailer; 
                    $mail->isSMTP();           
                    $mail->Host = 'smtp.gmail.com';   
                    $mail->SMTPAuth = true;     
                    $mail->Username = 'enable.onl@gmail.com';        
                    $mail->Password = '';    
                    $mail->SMTPSecure = 'tls';   
                    $mail->Port = 587;
                    $mail->setFrom('membership@aicpdf.com', 'AICPDF');
                    $mail->addAddress($email, 'User');
    //                $mail->addBCC('faizan.kazi@enlyft.in', 'User'); 
                    $mail->addAttachment($outputpdf);
                    $mail->isHTML(true);
                    $mail->Subject = 'AICPDF Membership Certificate';
                    $mail->Body    = "<p style='font-family:Arial, Helvetica, san-serif; font-size:12px;'>Dear <b>$fullname</b>,</p><br>
                    <p style='font-family:Arial, Helvetica, san-serif; font-size:12px;'>Your <b>$membershipname</b> with AICPDF is confirmed.</p>
                    <p style='font-family:Arial, Helvetica, san-serif; font-size:12px;'>Your Membership No. is  <b>$membershipno</b></p><br>
                    <p style='font-family:Arial, Helvetica, san-serif; font-size:12px;'>Included with this e-mail is your official <b>$membershipname</b> Certificate.</p>
                    <p style='font-family:Arial, Helvetica, san-serif; font-size:12px;'>Do not share the certificate with anyone.</p><br>
                    <p style='font-family:Arial, Helvetica, san-serif; font-size:12px;'>Please do not reply to this email. For additional assistance, you may visit our website at <a href='https://aicpdf.com' target='_blank'>https://aicpdf.com</a>.</p><br>";

             echo "<div class='container'><img width='900px' height='600px' src='$outputimage'><br></div>";
             echo "<div class='container'><a target='_blank' onclick='home();' href='$outputpdf' class='btn btn-success download'>Download Certificate</a><br></div>";

                if($mail->send()){
                    echo "<div class='container'><b>Your Membership Certificate has been sent on your email, Please Download the certificate by clicking on Download button as this page will expire in 2 minutes</b><br></div>";
                }
        }
      }

     ?>
    </center>
    </body>
<script>
function home(){
     setTimeout(function(){
       window.location.href = 'index.php';
    }, 5000);   
}
</script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
