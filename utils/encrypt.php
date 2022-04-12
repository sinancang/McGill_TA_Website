<?php
    $unencrypted_password = $_POST['pass'];
    echo $unencrypted_password;
    $encrypted_password = password_hash($unencrypted_password, PASSWORD_DEFAULT);
    echo $encrypted_password;
?>
