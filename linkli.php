<!-- BURDAKİ SADECE LİNKLİ VE DOĞRULAMA VERSİYONU -->
<!-- THİS CODE LİNK AND VERİFİCATİON -->

<?php
// ASILLLLLLLL SONUNCU BUUUUUUUUUU

use PHPMailer\PHPMailer\PHPMailer; //PHP MAİLER DOSYALARI
use PHPMailer\PHPMailer\Exception; //PHP MAİLER DOSYALARI

require 'phpmailer/src/Exception.php'; //PHP MAİLER DOSYALARI
require 'phpmailer/src/PHPMailer.php'; //PHP MAİLER DOSYALARI
require 'phpmailer/src/SMTP.php'; //PHP MAİLER DOSYALARI

if (isset($_POST["gonder"])) { // BUTON TIKLANILDIĞI ZAMAN
    $name = htmlspecialchars(trim($_POST["ad"])); // AD VERİSİNİ AL
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL); // EPOSTA VERİSİNİ AL
    $password = trim($_POST["sifre"]); // ŞİFRE VERİSİNİ AL

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Geçersiz e-posta adresi.'); //EPOSTA KONTROLÜ
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ahmet@gmail.com'; // GÖNDERENİN EPOSTA ADRESİ
        $mail->Password   = 'ansdajksndjasdjqwıeqıwezxczx'; //ŞİFRE
        $mail->SMTPSecure = 'tls'; //TSL GÜVENLİ OLAN
        $mail->Port       = 587; //PORT

        $mail->setFrom('TAHA@info.com', 'TAHA'); //EPOSTADAKİ AÇIKLAMA 
        $mail->addAddress($email, $name); //LİNK GÖNDERİLİCEK EPOSTA

        $mail->isHTML(true); 

        $token = bin2hex(random_bytes(32));
        $teka = '+TAHA.'; //ŞİFRELEME
        $hashed_token = password_hash($token.$teka, PASSWORD_DEFAULT);

        //LİNKE TIKLARSA BURDAKİ VERİFY.PHP DOSYASINA YÖNLENDİR
        $verifyLink = "http://localhost/emailcode/verify.php?token=" . urlencode($hashed_token); 

        $mail->Subject = "Email Verification";
        //GÖNDERİLEN MESAJ
        $mail->Body = "<p>Your verification link is: <a style='font:bold 30px arial;color:red;text-decoration:none' href='".$verifyLink."'>Verify</a></p>"; 

        $mail->send();

        $encrypted_password = password_hash($password, PASSWORD_DEFAULT);

        include("connect.php");
        //GÖNDERİLEN MESAJLARIN VERİSİNİ VERİTABANINA KAYDET
        $stmt = $conn->prepare("INSERT INTO email (ad, email, sifre, token) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $encrypted_password, $hashed_token);

        if (!$stmt->execute()) {
            die("Veri eklenirken bir hata oluştu: " . $stmt->error);
        }

        $stmt->close();
        $conn->close();

        echo "E-posta başarıyla gönderildi.";
    } catch (Exception $e) {
        echo "Mesaj gönderilemedi. Mailer Hatası: {$mail->ErrorInfo}";
    }
} 

?>

<form method="POST">
ad<input type="text" name="ad">
email<input type="text" name="email">
sifre<input type="text" name="sifre">
<input type="submit" name="gonder" value="gonder">
</form>


