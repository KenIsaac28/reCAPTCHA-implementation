<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact</title>
<link rel="stylesheet" href="loginstyle.css">
<script src="https://www.google.com/recaptcha/enterprise.js" async defer></script>
</head>
<body>
<div class= container>
<form action="contact.php" method="POST">
    <label for="name" class="name">Your name:</label>
    <input type="text" name="name" placeholder="Your Name" required>
    <label for="email" class="email">Your Email:</label>
    <input type="text" name="email" placeholder="Your Email" required>
    <link rel="stylesheet" href="loginstyle.css">
    <div class="g-recaptcha" data-sitekey="6Ld7N00qAAAAACq8tLWuZGZwgcsQkwSa5WB4EwJy"></div>
    <input type="submit" value="Submit">
        <div class="condiv">
            <a href="login.php" class= login>Login</a>
        </div>
</form>
</div>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $recaptcha_response = $_POST['g-recaptcha-response'];
    $secret_key = '6Ld7N00qAAAAALXGoBulH2-3yqpjvd59Q34rufjG';
    $verify_response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret_key}&response={$recaptcha_response}");
    $response_data = json_decode($verify_response);

    if ($response_data->success) {

        $name = htmlspecialchars($_POST['name']);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        
        echo "<script>
                Swal.fire({
                    title: 'Success!',
                    text: 'Registered Succesfully.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
              </script>";
    } else {
        
        echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Please complete the reCAPTCHA verification.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
              </script>";
    }
}
?>
