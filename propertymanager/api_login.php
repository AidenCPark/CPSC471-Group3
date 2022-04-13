<?php
    // Connection for getting user info (checking if logged in):

        // Used for non-signup-form db connection:
        $sname = "localhost";
        $uname = "root";
        $password = "";
        $db_name = "propertymanager";

        $conn = mysqli_connect($sname, $uname, $password, $db_name);

        if(!$conn)
        {
            echo "Connection failed";
        }

?>