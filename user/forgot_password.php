<?php
// Include the database connection
require_once '../includes/connection.php';

//PHP Mailer Required Files
require '../includes/phpMailer/PHPMailer.php';
require '../includes/phpMailer/SMTP.php';
require '../includes/phpMailer/Exception.php';

//Define PHP Mailer Name Spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


// Function to sanitize user input
function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input and sanitize it
    $email = sanitize($_POST['email']);

    // Check if the email exists in the database
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Generate a random password
        $new_password = substr(md5(time()), 0, 8);

        $message = "Thanks for requesting a New Password via Forgot Password. Your New Password is ".$new_password;

        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the user's password in the database
        $query = "UPDATE users SET password = '$hashed_password' WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Send the new password to the user's email 
            //PHP Mailer Basic Settings Configurations

           

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'ibrobk@gmail.com';  // SMTP username (your email address)
            $mail->Password = 'kvwuxyzdsaoqyjlh';  // SMTP password
            $mail->SMTPSecure = 'ssl';  // Enable encryption, 'ssl' also accepted
            $mail->Port = 465;  // TCP port to connect to
            $mail->Subject = "Updated Password!";
            //Set sender email
            $mail->setFrom('ibrobk@gmail.com', "Agric. Extension Services");
            //Enable HTML
            $mail->isHTML(true);
            //Attachment
            // $mail->addAttachment('img/attachment.png');
            //Email body
            $mail->Body = $message;
            //Add recipient
            $mail->addAddress($email);
            //Finally send email
            if ( $mail->send() ) {


            $success = "Your password has been reset. Check your email for the new password.";
            }
        } else {
            // Handle database error
            $error = "Error: " . mysqli_error($conn);
        }
    } else {
        // Handle error if email not found
        $error = "Email not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <!-- <link rel="stylesheet" type="text/css" href="styles.css"> -->
    <link rel="stylesheet" type="text/css" href="../css/register.css">

</head>
<body>

    <div class="container">
        <h2>Forgot Password</h2>
        <?php if (isset($error)): ?>
            <div class="error" style="color:red;"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <div class="success" style="color:green;"><?php echo $success; ?></div>
        <?php endif; ?>
        <form action="forgot_password.php" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <button type="submit" class="btn">Reset Password</button>
            <p>Back to <a href="../">Login</a></p>
        </form>
    </div>
</body>
</html>
