<?php


            
            $id = $_GET["id"];

            if($id)
            {
                $conn= mysqli_connect('localhost', 'root', '', 'propertymanager') or die("Connection Failed:" .mysqli_connect_error());

                $sql = "CALL appointment_remove('$id')";
                $query = mysqli_query($conn,$sql);

                if($query)
                {
                    header("Location: listings.php");
                    exit();
                }
                else
                {
                    echo 'Error removing appointment.';
                }
            }
            else
            {
                echo 'Error getting appointment id.';
            }

?>