<?php

        //--- Routing for register requests ---//

        require "../utils/db_operations.php";

        if (register_new_user($_POST['email'], $_POST['pass']) == 1) {
                echo 'registered user';
        }

?>
