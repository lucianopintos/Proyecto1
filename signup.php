<?php
require'database.php';
$message='';
if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['user'])){
    $sql="INSERT INTO users (email,password,users_name) VALUES (:email, :password, :users_name)";
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(':email',$_POST['email']);
    $stmt->bindParam(':users_name',$_POST['user']);
    $password= password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password',$password);

    if ($stmt->execute()) {
        $message = 'Su usuario ha sido creado correctamente';
    }else{
        $message= 'Ha ocurrido un error';

    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
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
    
    <h1> Registrarse </h1>
    <span> o <a href="login.php"> Ingresa</a></span>
    <form action="signup.php" method="post">
    <input type="text" name="user" placeholder="Ingrese su usuario">
    <input type="email" name="email" placeholder="Ingrese su correo" >
    <input type="password" name="password" placeholder="Ingrese su contraseña">
   
    <input type="submit" value="Enviar">
</form>    
    
</body>
</html>