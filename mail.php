<?php

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Required files
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Create an instance; passing `true` enables exceptions
if (isset($_POST["send"])) {

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';           // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                       // Enable SMTP authentication
        $mail->Username   = 'philipab896@gmail.com';    // SMTP username (your email)
        $mail->Password   = 'jkperdfheyudwcwo';         // SMTP password
        $mail->SMTPSecure = 'ssl';                      // Enable implicit SSL encryption
        $mail->Port       = 465;                        // TCP port to connect to

        // Recipients
        $mail->setFrom($_POST["email"], $_POST["name"]); // Sender Email and name
        $recipientEmail = 'philipab896@gmail.com';
        $recipientName = 'Philip Aboagye';              // Assuming you have the receiver's name from the form
        $mail->addAddress($recipientEmail, $recipientName); // Add a recipient email and name
        $mail->addReplyTo($_POST["email"], $_POST["name"]); // Reply to sender email

        // Extract the first name from the recipient's name
        $firstName = explode(' ', $recipientName)[0];

        // Content
        $mail->isHTML(true);                            // Set email format to HTML
        $mail->Subject = $_POST["subject"];             // Email subject headings

        // HTML email body
        $message = "
        <html>
        <head>
            <style>
            img{
                width: 50px;
            }
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                th, td {
                    padding: 10px;
                    text-align: left;
                    border-bottom: 1px solid #ddd;
                }
                ul {
                    list-style-type: disc;
                    padding-left: 20px;
                }
                .first-name {
                    color: #A05284; /* Red color for the first name */
                }
            </style>
        </head>
        <body style='background-color: #E2E2E2'>
            <table >
                <tr>
                    
                    <td width='75%' style='background-color: #474747; color: #cbd6d5; text-transform: uppercase;'><strong>Subject:</strong> {$_POST["subject"]}</td>
                    <td width='25%' style='background-color: #474747;'>
                    <img src='https://avatars.githubusercontent.com/u/169049649?s=200&v=4' alt='pentatech logo'>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <p>Hello! <span class='first-name'>$firstName</span>,</p>
                        <p>You have received a message from <span style='background-color: #B0AC18'>{$_POST["name"]}</span>.</p>
                        <p>Please find below the details of the message:</p>
                        <ul>
                            <li><strong>Full Name:</strong> {$_POST["name"]}</li>
                            <li><strong>Department:</strong> {$_POST["department"]}</li>
                            <li><strong>Email:</strong> {$_POST["email"]}</li>
                            <li><strong>Date:</strong> {$_POST["emaildatetime"]}</li>
                            <li><strong>Message: </strong>{$_POST["message"]}</li>
                        </ul>
                    </td>
                </tr>
            </table>
        </body>
        </html>
        ";

        $mail->Body = $message; // Email message

        // Success sent message alert
        $mail->send();
        echo "<script> 
                alert('Message was sent successfully!');
                document.location.href = 'home.php';
              </script>";
    } catch (Exception $e) {
        echo "<script>
        alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');
        document.location.href = 'home.php';
        </script>";
        
    }
}
?>
