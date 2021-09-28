<?php
ini_set('display_errors', 1);
echo 'test de connection';
$mycnx = mysqli_connect('localhost', 'root', 'Vreneli690827@Rueil') or die('Could not connect the database : Username or password incorrect');
mysqli_select_db($mycnx,'world') or die ('No database found');
echo 'Database Connected successfully';
?>