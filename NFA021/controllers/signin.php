<?php
require_once(__DIR__ . "/../includes/page.inc.php");

@$nom = $_POST["nom"];
@$prenom = $_POST["prenom"];
@$mail = $_POST["mail"];
@$password = $_POST["password"];
@$envoyer = $_POST["btnEnvoyer"];

$userRepo = new UtilisateurRepo();
$newuser = new Utilisateur(0, $nom, $prenom, $mail, $password, 0, 0 , uniqid());

if (isset($envoyer)) {

    if (!isset($mail) || !isset($password)  || !isset($nom)  || !isset($prenom)) {
        header("location: ../views/message.php?titre=Erreur&erreurInscription");
    } else {
        // On a toutes les informations pour créer le nouvel utilisateur
        if(!$userRepo->insert($newuser)) {
            header("location: ../views/message.php?titre=Erreur&erreurInscription");
        } else {
            // L'utilisateur est crée on peut préparer le message
            $message = "Bonjour " . $newuser->getPrenom() . ",<br><br>" . 
             "Merci de valider votre mail en cliquant sur le lien suivant : "  . 
            "<a href='http://localhost/controllers/validation.php?jeton=" . $newuser->getJetonValidation() . "'" . ">Lien de validation</a>";

            $phpmailer = new Mailer( $newuser->getMail(),"Validation de votre compte DerDieDas",$message);

            if (!$phpmailer->Send()) {
                error_log($phpmailer->ErrorInfo);
                header("location: ../views/message.php?Echec=&mailValidationNOK");
            } else {
                // Le message est bien parti
                header("location: ../views/message.php?titre=Succès&inscriptionOK");
            }
        }  
    }
}