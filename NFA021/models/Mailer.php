<?php
// Je crée une de la classe PHP Mailer accessible à l'autoload au sein du dossier modèle
//  extension
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../includes/PHPMailer/src/PHPMailer.php';
require '../includes/PHPMailer/src/SMTP.php';
require '../includes/PHPMailer/src/Exception.php';

Class Mailer extends PHPMailer {

    public function __construct($destinataire,$sujet, $contenu)
    {
        parent::__construct();
        $this->IsSMTP();
        $this->isHTML(true);
        $this->Host = 'smtp.mailtrap.io';
        $this->Port = 2525;
        $this->Username = "6a0d3324858da6";
        $this->Password = "6023b85052f6ed";
        $this->SMTPDebug = 2;
        $this->SMTPAuth = true;
        $this->SMTPSecure = 'tls';
        $this->setFrom('info@mailtrap.io', 'Mailtrap');
        
        $this->Subject = $sujet;
        $this->Body = $contenu;
        $this->AddAddress($destinataire);
    }

}
