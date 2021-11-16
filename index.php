<?php
require "./config.php";

if (isset($_POST["name"]) && isset($_POST["mail"]) && isset($_POST["msg"])) {
    $name = strip_tags(trim($_POST["name"]));
    $mail = filter_var(strip_tags(trim($_POST["mail"])), FILTER_VALIDATE_EMAIL);
    $mesg = strip_tags(trim($_POST["msg"]));

    if ($name && $mail && $msg) {
        mail($to,$subject,$msg);
        
    } else {
        echo "Error!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form method="post" action="">
        <label for="name">Nom</label></br>
        <input type="text" id="name" placeholder="Votre nom" name="name" required /></br>
        <label for="mail">Mail</label></br>
        <input type="text" id="mail" placeholder="Votre mail" name="mail" required /></br>
        <label for="msg">Message</label></br>
        <textarea id="msg" placeholder="Votre message" name="msg" required></textarea></br>
        <input type="submit" value="send" />
    </form>

</body>

</html>
