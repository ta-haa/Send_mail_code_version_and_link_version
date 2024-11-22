<?php
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    
    include("connect.php");

    // Token'ı veritabanında arama
    $stmt = $conn->prepare("SELECT token FROM email WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Token geçerli. Hesabınız doğrulandı.";
    } else {
        echo "Geçersiz token.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Token bulunamadı.";
}
?>
