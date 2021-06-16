<?php
require("./layout/header.php");
$name = $_GET['name'];
$email = $_GET['email'];
$subject = $_GET['subject'];
$message = $_GET['message'];

if(
    isset($name) && 
    isset($email) && 
    isset($subject) && 
    isset($message)
    ) {
        // nous allon envoyer un mail 
        $to = 'mus.ahmadi994@gmail.com';
        $headers = "From: ".$email;
        $isMailSended =  mail($to,$subject,$message, $headers);
        if($isMailSended) {
            echo '<div class="contactContainer">' .
            '<h3>Merci pour votre message </h3>'. 
            '<p>votre message a bien reçu</p>'.
            '<i class="far fa-envelope"></i>'.
            '</div>';

            //redirect after then second
            header('Refresh: 10; index.php');
        }else {

            echo '<div class="contactContainer">' .
            '<h3>Viellez esseyer plutard</h3>'. 
            '<p>une erreur s\'est produite</p>'.
            '<i class="far fa-envelope error"></i>'.
            '</div>';


            //redirect after then second
            header('Refresh: 10; index.php');
        }
    }else {
        //redirect after then second
        header('Refresh: 10; index.php');
    }



?>



<?php  require("./layout/footer.php");?>
