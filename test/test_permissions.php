<?php
echo "Class to test write permissions with php.<br>";
echo "Check the test directory to see if the program created a file called test.txt.<br>";
echo "If you don't see the file, you might want to run chmod -R 777 on your root directory...";
$file = fopen("test.txt", "w") or die ("Unable to open file!");
fwrite($file, "Testing...1...2...3\n`");

?>
