<?php

        //--- Routing for register requests ---//

        require "../utils/db_operations.php";

        register_new_user($_POST['email'], $_POST['pass']);

?>