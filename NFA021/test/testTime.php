<?php
ini_set('date.timezone', 'Europe/Brussels');
echo "Test strtotime<br>";
echo "now : " . strtotime("now") . "<br>";
echo "10 September 2000 : " . strtotime("10 September 2000"), "<br>";
echo "+1 day : " . strtotime("+1 day") . "<br>";
echo "+1 week : " . strtotime("+1 week") . "<br>";
echo "+1 week 2 days 4 hours 2 seconds : " . strtotime("+1 week 2 days 4 hours 2 seconds") . "<br>";
echo "next Thursday : " . strtotime("next Thursday") . "<br>";
echo "last Monday : " . strtotime("last Monday") . "<br>";
echo "<br><br><br>";
echo "Test phptime<br>";
echo "phptime : " . date ('Y-m-d H:i:s', $phptime);
echo "<br><br><br>";
echo "Test datetime<br>";
$date1 = new DateTime('now');
echo "datetime : " . $date1->format('Y-m-d H:i:s');

?>