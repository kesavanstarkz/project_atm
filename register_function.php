<?php
require 'db_connector.php';
require 'vendor/autoload.php';

session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$mail = new PHPMailer(true);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = htmlspecialchars($_POST['uname']);
    $user_email = htmlspecialchars($_POST['email']);
    $user_mobile_number = htmlspecialchars($_POST['mob-no']);
    $user_password = htmlspecialchars($_POST['pass-1']);
    $user_password_confirm = htmlspecialchars($_POST['pass-2']);
    $account_number = str_pad(mt_rand(100000000, 999999999), 9, '0', STR_PAD_LEFT);    
    $account_pin = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
    $_SESSION["account_number"]=$account_number;
    $_SESSION["account_pin"]=$account_pin;
    if ($user_password === $user_password_confirm) {
        $password_hash = password_hash($user_password, PASSWORD_DEFAULT);
        $data = [
            'user_name' => $user_name,
            'user_email' => $user_email,
            'user_mobile_number' => $user_mobile_number,
            'user_password' => $password_hash,
            'user_acc_number'=>$account_number,
            'user_acc_pin'=> $account_pin
        ];

        $sql = "INSERT INTO register_form (user_name, user_email, phone_no, password,account_number,account_pin) VALUES (:user_name, :user_email, :user_mobile_number, :user_password,:user_acc_number,:user_acc_pin)";
        $statement = $conn->prepare($sql);
        $statement->execute($data);

        $sanitized_table_name = preg_replace('/[^a-zA-Z0-9_]/', '', $user_name);

        if (!empty($sanitized_table_name)) {
            $acc = "CREATE TABLE IF NOT EXISTS `$sanitized_table_name` (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        account VARCHAR(255),
                        type TEXT
                    )";
            $conn->exec($acc);
            try {
                $mail->isSMTP();                                      
                $mail->Host       = 'smtp.gmail.com';               
                $mail->SMTPAuth   = true;                             
                $mail->Username   = 'kesav5186@gmail.com';                         
                $mail->Password   = 'rfzyzitelpjllvym'; 
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   
                $mail->Port       = 587;                              
                $mail->addAddress($user_email, 'Recipient Name');    
                $mail->isHTML(true);                                  
                $mail->Subject = 'Message from Rupee';
                $mail->Body    = "Your account number: $account_number,Your account pin:$account_pin";
                $mail->AltBody = 'Content araises..';
            
                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
        $_SESSION["user_name"]=$user_name;
        header("Location: login.php");
    } else {
        header("Location: register.html");
    }
} else {
    echo "Error";
}


