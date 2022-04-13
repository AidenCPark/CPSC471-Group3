<!-- Check if logged in, and get user info if so -->
<?php
session_start();

if(isset($_SESSION['UserID']) && isset($_SESSION['Username']))
{
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Main Page</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous"
    />
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="navbar navbar-light bg-light sticky-top navbar-expand-lg">
            <a class="navbar-brand" href="listings.php">
                <img src="imgs/PMLOGO.PNG" width="30" height="30" class="d-inline-block align-top" alt="">
                Property Manager
              </a>
            <button
              class="navbar-toggler"
              type="button"
              data-toggle="collapse"
              data-target="#mynav"
            >
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynav">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                  <a href="searchprop.php" class="nav-link">Search Properties</a>
                </li>

                <?php if ($_SESSION['Type'] == 'Realtor'): ?>
                <li class="nav-item">
                <a href="listprop.php" class="nav-link">List New Property</a>
                </li>
                <?php endif ?>

                <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
              </ul>
            </div>
        </nav>   
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-12" id="collection-heading">
                        <h1  style= "text-align: center;" >Hello <?php echo $_SESSION['Name']; ?>!</h1>
                        <br>
                    </div>
                </div>

                <!-- Display Appointments (realtor) -->

                <?php if ($_SESSION['Type'] == 'Realtor'): ?>

                <?php
                $conn= mysqli_connect('localhost', 'root', '', 'propertymanager') or die("Connection Failed:" .mysqli_connect_error());

                $UserID = $_SESSION['UserID'];
                $sql= "CALL appointment_realtor('$UserID')";

                $query = mysqli_query($conn,$sql);

                if(mysqli_num_rows($query)===0)
                {
                    echo 'You do not have any scheduled appointments.';
                }
                else
                {
                    echo 'Your scheduled appointments (click to dismiss):';
                }

                ?>


                <div class="row">
                <?php while($row = mysqli_fetch_array($query)):;?>

                <?php 
                $ClientID = $row[1];

                $conn1= mysqli_connect('localhost', 'root', '', 'propertymanager') or die("Connection Failed:" .mysqli_connect_error());
                $sql1= "CALL user_id('$ClientID')";
                $query1 = mysqli_query($conn1,$sql1);
                $Client = mysqli_fetch_row($query1);
                ?>

                <div class="col-md-4">

                <a href="api_removeappointment.php?id=<?php echo $row[0];?>">

                <br><br>
                <?php echo $row[3];?> with <?php echo $Client[1];?>
                <br>
                Email: <?php echo $Client[2];?>
                <br>
                Phone: <?php echo $Client[3];?>

                </a>

                </div>

                <?php endwhile;?>
                </div>

                <br><br><br>
                <?php endif ?>


                <!-- Display Appointments (client) -->

                <?php if ($_SESSION['Type'] == 'Client'): ?>

                <?php
                $conn= mysqli_connect('localhost', 'root', '', 'propertymanager') or die("Connection Failed:" .mysqli_connect_error());

                $UserID = $_SESSION['UserID'];
                $sql= "CALL appointment_client('$UserID')";

                $query = mysqli_query($conn,$sql);

                if(mysqli_num_rows($query)===0)
                {
                    echo 'You do not have any scheduled appointments.';
                }
                else
                {
                    echo 'Your scheduled appointments (click to cancel):';
                }

                ?>


                <div class="row">
                <?php while($row = mysqli_fetch_array($query)):;?>

                <?php 
                $RealtorID = $row[2];

                $conn2= mysqli_connect('localhost', 'root', '', 'propertymanager') or die("Connection Failed:" .mysqli_connect_error());
                $sql2= "CALL user_id('$RealtorID')";
                $query2 = mysqli_query($conn2,$sql2);
                $Realtor = mysqli_fetch_row($query2);
                ?>

                <div class="col-md-4">

                <a href="api_removeappointment.php?id=<?php echo $row[0];?>">

                <br><br>
                <?php echo $row[3];?> with <?php echo $Realtor[1];?>
                <br>
                Email: <?php echo $Realtor[2];?>
                <br>
                Phone: <?php echo $Realtor[3];?>

                </a>

                </div>

                <?php endwhile;?>
                </div>

                <br><br><br>
                <?php endif ?>

                <!-- Display Properties -->

                <?php

                $conn= mysqli_connect('localhost', 'root', '', 'propertymanager') or die("Connection Failed:" .mysqli_connect_error());

                $sql= "CALL property()";
                $query = mysqli_query($conn,$sql);

                if(mysqli_num_rows($query)===0)
                {
                    echo '<br />No properties found.';
                }

                ?>

                <div class="row">   

                <?php while($row = mysqli_fetch_array($query)):;?>

                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <div class="card-body">
                                <h4 class = "card-title">$<?php echo $row[3];?></h4> 
                                <p style="margin-bottom:0;"class="card-text"><?php echo $row[2];?></p>
                                <p style="margin-bottom:0;"class="card-text">Bedrooms: <?php echo $row[7];?></p>
                                <p class="card-text">Bathrooms: <?php echo $row[8];?></p>
                                <?php if ($row[1] == $UserID): ?>
                                <p class="card-text"><font color=green>You listed this property.</font></p>
                                <?php endif ?>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" onclick="window.location='product_view.php?id=<?php echo $row[0];?>'" class="btn btn-sm btn-outline-secondary">View</button>
                                    </div>
                                    <small class="text-muted"><?php echo $row[5];?></small>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endwhile;?>

                </div>
            </div>
        </div>
    </body>
</html>

<!-- If not logged in, return to the index page -->
<?php
}
else
{
    header("Location: index.php");
    exit();
}
?>