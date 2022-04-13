<?php
        // Connection for the Edit Property form:
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['PropUpdate']))
            {
                // Connect to database: return error if can't connect
                $conn= mysqli_connect('localhost', 'root', '', 'propertymanager') or die("Connection Failed:" .mysqli_connect_error());
    
                if(isset($_POST['PropertyID']) && isset($_POST['RealtorID']) && isset($_POST['Address']) && isset($_POST['Status']) && isset($_POST['Price']) && isset($_POST['Style']) && isset($_POST['NumOfFloors']) && isset($_POST['NumOfBedrooms']) && isset($_POST['NumOfBathrooms']))
                {
                    $PropertyID = $_POST['PropertyID'];
                    $RealtorID = $_POST['RealtorID'];
                    $Address = $_POST['Address'];
                    $Status = $_POST['Status'];
                    $Price = $_POST['Price'];
                    $Style = $_POST['Style'];
                    $NumOfFloors = $_POST['NumOfFloors'];
                    $NumOfBedrooms = $_POST['NumOfBedrooms'];
                    $NumOfBathrooms = $_POST['NumOfBathrooms'];
    
                    $sql= "CALL property_update('$PropertyID', '$RealtorID', '$Address', '$Price', '$Style', '$Status', '$NumOfFloors', '$NumOfBedrooms', '$NumOfBathrooms')";
                    $query = mysqli_query($conn,$sql);
                    if($query)
                    {
                        header("Location: product_view.php?id=$PropertyID");
                        exit();
                    }
                    else
                    {
                        echo 'Error Occurred';
                    }
    
                }
                else
                {
                    echo 'Error: Something wrong with the edit property input.';
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