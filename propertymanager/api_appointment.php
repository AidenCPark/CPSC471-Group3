<?php
// Connection for the Book Appointment form:
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Appointment']))
        {
            // Connect to database: return error if can't connect
            $conn= mysqli_connect('localhost', 'root', '', 'propertymanager') or die("Connection Failed:" .mysqli_connect_error());
            

            if(isset($_POST['ClientID']) && isset($_POST['RealtorID']) && isset($_POST['Date']))
            {
                $ClientID = $_POST['ClientID'];
                $RealtorID = $_POST['RealtorID'];
                $Date = $_POST['Date'];

                $sql= "CALL appointment_add('$ClientID','$RealtorID','$Date')";
                $query = mysqli_query($conn,$sql);
                if($query)
                {
                    header("Location: listings.php");
                    exit();
                }
                else
                {
                    echo 'Error sending appointment_add query.';
                }
            }

            echo 'Error with appointment input.';
        }
?>