<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link rel="stylesheet" href="loginstyle.css">
<script src="https://www.google.com/recaptcha/enterprise.js" async defer></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class= container>
        <form action="login.php" method="POST">
        <label for="username" class="username">Username:</label>
        <input type="text" name="username" placeholder="Username" required>
        <label for="password" class="password">Password:</label>
        <input type="password" name="password" placeholder="Password" required>
    
        <div class="g-recaptcha" data-sitekey="6Ld7N00qAAAAACq8tLWuZGZwgcsQkwSa5WB4EwJy"></div>
        <input type="submit" value="Login">
        <div class="condiv">
        <a href="contact.php" class= contact>Contact</a>
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

        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        echo "<script>
        Swal.fire({
            title: 'Success!',
            text: 'Login successful',
            icon: 'success',
            confirmButtonText: 'OK'});
            </script>";
} else {

        echo "<script>
        Swal.fire({
                title: 'Error!',
                text: 'Please complete the reCAPTCHA verification.',
                icon: 'error',
                confirmButtonText: 'OK'});
            </script>";
}
}
?>
