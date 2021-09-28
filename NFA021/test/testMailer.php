<?php
require_once(__DIR__ . "/../includes/page.inc.php");

$message = "Merci de valider votre mail en cliquant sur le lien suivant : "  . 
"<a href='http://localhost/controllers/validation.php?jeton=" . "60c72f4b84028'" . ">Lien de validation</a>";

$phpmailer = new Mailer('ericbertrand7575@gmail.com',"Validation de votre compte DerDieDas",$message);

if (!$phpmailer->Send()) {
    error_log($phpmailer->ErrorInfo);
    header("location: ../views/message.php?Echec=&mailValidationNOK");
} else {
    // Le message est bien parti
    header("location: ../views/message.php?titre=Succès&inscriptionOK");
}
