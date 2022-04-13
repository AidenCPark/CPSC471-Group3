<?php
session_start();
include "api_login.php";

if(isset($_POST['Username']) && isset($_POST['Password']))
{
    // Makes sure user and password don't have any bad characters:
    $Username = trim($_POST['Username']);
    $Password = trim($_POST['Password']);
    $Username = stripslashes($Username);
    $Password = stripslashes($Password);
    $Username = htmlspecialchars($Username);
    $Password = htmlspecialchars($Password);
}

if(empty($Username))
{
    header ("Location: index.php?error=Username is required!");
    exit();
}
else if(empty($Password))
{
    header ("Location: index.php?error=Password is required!");
    exit();
}

$sql = "CALL user_select('$Username','$Password')";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) === 1)
{
    $row = mysqli_fetch_assoc($result);
    if($row['Username'] === $Username && $row['Password'] === $Password)
    {
        echo "Logged In!";
        $_SESSION['Username'] = $row['Username'];
        $_SESSION['Name'] = $row['Name'];
        $_SESSION['UserID'] = $row['UserID'];
        $_SESSION['Type'] = $row['Type'];
        $_SESSION['Email'] = $row['Email'];
        $_SESSION['Phone'] = $row['Phone'];
        header("Location: listings.php");
        exit();
    }
    else
    {
        header("Location: index.php?error=Incorrect Username or Password");
        exit();
    }
}
else
{
    header("Location: index.php?error=Incorrect Username or Password");
    exit();
}


?>