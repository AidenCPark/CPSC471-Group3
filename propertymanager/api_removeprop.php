<?php
// Connection for the Book Appointment form:
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Remove']))
        {
            // Connect to database: return error if can't connect
            $conn= mysqli_connect('localhost', 'root', '', 'propertymanager') or die("Connection Failed:" .mysqli_connect_error());
            

            if(isset($_POST['PropertyID']))
            {
                $PropertyID = $_POST['PropertyID'];

                $sql= "CALL property_remove('$PropertyID')";
                $query = mysqli_query($conn,$sql);
                if($query)
                {
                    header("Location: listings.php");
                    exit();
                }
                else
                {
                    echo 'Error sending property_remove query.';
                }
            }

            echo 'Error with property id input.';
        }
?>