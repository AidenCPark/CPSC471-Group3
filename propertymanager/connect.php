<?php
    // Connection for the Sign Up form:
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['SignUp']))
    {
        // Connect to database: return error if can't connect
        $conn= mysqli_connect('localhost', 'root', '', 'propertymanager') or die("Connection Failed:" .mysqli_connect_error());
        // Make sure none of the inputs are NULL:
        if(isset($_POST['Name']) && isset($_POST['Email']) && isset($_POST['Phone']) && isset($_POST['Username']) && isset($_POST['Password']) && isset($_POST['Type']))
        {
            // Get all the inputs:
            $Name= $_POST['Name'];
            $Email= $_POST['Email'];
            $Phone= $_POST['Phone'];
            $Username= $_POST['Username'];
            $Password= $_POST['Password'];
            $Type= $_POST['Type'];

            // Put this information in an SQL query (using the api endpoint 'call user_add' I made rather than a long query):
            $sql= "CALL user_add('$Name', '$Email', '$Phone', '$Username', '$Password', '$Type')";

            // Send this query to the database, return a message for if it was successful or not
            $query = mysqli_query($conn,$sql);
            if($query)
            {
                // Redirect to the login page
                header("Location: index.php");
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
                // Redirect to the login page
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
        // Could probably use the code above for this but i'm still a php noob
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