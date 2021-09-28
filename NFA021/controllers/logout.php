<?php
session_start();
session_destroy();
header("location: ../views/message.php?titre=Deconnection&message=Vous n'êtes plus connecté");
