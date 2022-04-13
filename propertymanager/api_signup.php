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

            
            // Make sure this username isn't taken:
            $sql= "CALL user_get('$Username')";
            $query = mysqli_query($conn,$sql);

            if(mysqli_num_rows($query)>=1)
            {
                header("Location: signup.php?error=Username already taken!");
                exit();
            }

            // If username not taken, continue as normal:

            // Put this information in an SQL query (using the api endpoint 'call user_add' I made rather than a long query):
            $sql= "CALL user_add('$Name', '$Email', '$Phone', '$Username', '$Password', '$Type')";

            // Have to set this every time you want to execute a query apparently:
            $conn= mysqli_connect('localhost', 'root', '', 'propertymanager') or die("Connection Failed:" .mysqli_connect_error());
            
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
                echo 'Error: Something wrong with connect.php signup form SQL query';
            }
 
        }
        else
        {
            echo 'Error: Something wrong with connect.php signup form input';
        }
    }
?>