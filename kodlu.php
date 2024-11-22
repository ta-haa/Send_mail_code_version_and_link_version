<!-- BURDAKİ SADECE KOD GÖNDERİYOR LİNKSİZ VERSİYONU -->
<!-- THİS JUST SEND CODE NO LİNK -->

<form method="POST">
    ad<input type="text" name="ad">
    email<input type="text" name="email">
    sifre<input type="text" name="sifre">
    <input type="submit" name="gonder" value="gonder">
</form>



<?php
//////////////////////////////////////////BU ÇALIŞAN 
/////////////////////////////////////////linkli.php de son versiyonu var
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';



if(isset($_POST["gonder"]))
{
    
    $name = $_POST["ad"];
    $email = $_POST["email"];
    $password = $_POST["sifre"];

    $mail = new PHPMailer(true);


    try{
        $mail->isSMTP();                              //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';       //Set the SMTP server to send through
        $mail->SMTPAuth   = true;             //Enable SMTP authentication
        $mail->Username   = 'ali@gmail.com';   //SMTP write your email //email'i gönderecek kişinin email adresi
        $mail->Password   = 'asdasdakjqweqojplsaplknasd';      //SMTP password //gmail'e girip burası için kod almanız gerekiyor
        $mail->SMTPSecure = 'tls';            //Enable implicit SSL encryption // tls daha güvenli ve portu 587 // ssl daha az güvenli portu 465
        $mail->Port       = 587;   


        $mail->setFrom( "ali@gmail.com","taha"); // Sender Email and name // 1. yer email 2. yer ad
        $mail->addAddress($email,$name); 
        $mail->addReplyTo('ali@gmail.com'); // reply to sender email // ZORUNLU DEĞİL

        $mail->isHTML(true);               //Set email format to HTML // html kullanmak için
          
        // Success sent message alert

        $mail->SMTPDebug = 0;

        $verification_code = substr(number_format(time()*rand(),0,"","",),0,6);

        $mail->Subject = "email verification";

        $mail->Body = "<p>Your verification code is: <b style='font:bold 30px arial'>".$verification_code."</b></p>";

        $mail->send();

        $encrypted_password = password_hash($password, PASSWORD_DEFAULT);

        $conn = mysqli_connect("localhost","root","","emailcode");

        $sql = "insert into email(ad,email,sifre,verification_code,verification_at) values ('".$name."','".$email."','".$encrypted_password."','".$verification_code."',NULL)";

        mysqli_query($conn,$sql);

        exit();
    } catch(Exception $e) {
        echo "Message could not : {$mail->ErrorInfo}";
    }
}


?>
