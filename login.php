<?php
session_start();
require'database.php';

if(!empty ($_POST['email']) && !empty ($_POST['password'])) {
$records=$conn->prepare('SELECT id, email, password FROM users WHERE email=:email');
$records->bindParam(':email', $_POST['email']);
$records->execute();
$results= $records-> fetch(PDO::FETCH_ASSOC);
$message='';
if (count($results) > 0  && password_verify($_POST['password'], $results['password'])) {
    $_SESSION['user_id']=$results['id'];
    header('location: http://localhost/login/home.php/');

}else {
    $message='El correo o la contraseña son incorrectas';
}

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
    <header>
    <a href="/login"> <img src="FOO!.png" class="logo"></a>
    </header>
    <?php if(!empty($message)): ?>
    <p><?= $message ?></p>
    <?php endif; ?>
    <h1>Ingresar</h1>
    <span> o <a href="signup.php"> Registrate </a></span>
<form action="login.php" method="post">
    <input type="email" name="email" placeholder="Ingrese su correo" >
    <input type="password" name="password" placeholder="Ingrese su contraseña">
    <input type="submit" value="Enviar">
</form>    

</body>
</html>