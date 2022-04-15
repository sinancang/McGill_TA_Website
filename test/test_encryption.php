<?php
require "../utils/encrypt.php";
echo "<html>";
echo "<p>Pass1 should be the same with pass2.</p><br>";
echo "<p>Pass1 is: " . encrypt_password("test1") . "</p><br>";
echo "<p>Pass is: " . encrypt_password("test1") . "</p><br>";
echo "</html>";
?>
