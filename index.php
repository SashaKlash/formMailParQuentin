<?php
/*On charge les dépendances*/
require "./config.php";
/* On vérifie si les variables $_POST existe aux ids données par les name="" du formulaire*/
if (isset($_POST["name"]) && isset($_POST["mail"]) && isset($_POST["msg"])) {
    /*On protège un minimum les variables*/
    $name = strip_tags(trim($_POST["name"])); //On retire les espaces avec trims, on retire les tags avec strip_tags
    $mail = filter_var(strip_tags(trim($_POST["mail"])), FILTER_VALIDATE_EMAIL); //On retire les espaces avec trims, on retire les tags avec strip_tags et on filtre la variables pour être sur qu'elle correspond à ce qu'un mail est censé ressembler
    $msg = strip_tags(trim($_POST["msg"])); //On retire les espaces avec trims, on retire les tags avec strip_tags

    /*On vérifie si les variables sont "vrai" (donc non vide)*/
    if ($name && $mail && $msg) {
        /*On crée les variables qu'on va passer à la fonction mail pour recevoir le mail de l'utilisateur*/
        $to = MAIL; //A qui est envoyé le mail, ici une constante, celle qui contient mon mail du config.php
        $subject = "Message de la part de $name"; //L'objet du mail
        $message = $msg; //Le message de l'utilisateur
        $header = [
            "From" => $mail,
            "Reply-to" => $mail,
            "X-Mailer" => "PHP/" . phpversion()
        ]; //Un tableau qui contient plusieurs infos, le from => qui à envoyé le mail, le reply-to => à qui on doit répondre et le X-Mailer => quelle version de php le serveur doit utiliser.

        //Utilisation de la fonction mail avec les variables créées au dessus.
        mail($to, $subject, $message, $header);

        //On recommence pour l'accusé de reception
        $to = $mail; //A qui envoyé le mail, cette fois à l'utilisateur
        $subject = "Merci"; //L'objet
        $message = "Je vous réponds soon"; //Notre accusé de réception
        $header = [
            "From" => MAIL,
            "Reply-to" => MAIL,
            "X-Mailer" => "PHP/" . phpversion()
        ];

        mail($to, $subject, $message, $header);
    } else {
        //Si les variables que l'utilisateur à rentré dans le formulaire sont fausse, alors on affiche une erreur.
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
    <!-- Formulaire correcte => Le seul élément vraiment requis est le name="uneValeur"
    dans les inputs pour pouvoir les identifier avec la variable superglobale $_POST -->
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
