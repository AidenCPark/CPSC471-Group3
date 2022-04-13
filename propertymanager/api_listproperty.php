<?php

// Connection for the List Property form:
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ListProp']))
    {
        
        session_start();

        if(isset($_SESSION['UserID']) && isset($_SESSION['Username']))
        {
            // Connect to database: return error if can't connect
            $conn= mysqli_connect('localhost', 'root', '', 'propertymanager') or die("Connection Failed:" .mysqli_connect_error());
            // Make sure none of the inputs are NULL:
            if(isset($_POST['Address']) && isset($_POST['Price']) && isset($_POST['Style']) && isset($_POST['Status']) && isset($_POST['NumOfFloors']) && isset($_POST['NumOfBedrooms']) && isset($_POST['NumOfBathrooms']))
            {
                // Get all the inputs:
                $RealtorID = $_SESSION['UserID'];
                $Address= $_POST['Address'];
                $Price= $_POST['Price'];
                $Style= $_POST['Style'];
                $Status= $_POST['Status'];
                $NumOfFloors= $_POST['NumOfFloors'];
                $NumOfBedrooms= $_POST['NumOfBedrooms'];
                $NumOfBathrooms= $_POST['NumOfBathrooms'];

                // Put this information in an SQL query (using the api endpoint 'call user_add' I made rather than a long query):
                $sql= "CALL property_add('$RealtorID', '$Address', '$Price', '$Style', '$Status', '$NumOfFloors', '$NumOfBedrooms', '$NumOfBathrooms')";

                // Send this query to the database, return a message for if it was successful or not
                $query = mysqli_query($conn,$sql);
                if($query)
                {
                    // Redirect to the listings page
                    header("Location: listings.php");
                    exit();
                }
                else
                {
                    echo 'Error Occurred';
                }
            }
            else
            {
                echo 'Error: There is something wrong with your input';
            }

        }
        else
        {
            header("Location: index.php");
            exit();
        }
    }

     // Connection for getting user info (checking if logged in):
        else
        {
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
        }

?>