<?php
    // Connection for the Sign Up form:
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))
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
            $sql= "INSERT INTO `person` (`Name`, `Email`, `Phone`, `Username`, `Password`, `Type`) VALUES ('$Name', '$Email', '$Phone', '$Username', '$Password', '$Type')";

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
    else
    {
        echo 'Error: There is something wrong with your submit button';
    }
?>