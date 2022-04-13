<!-- Check if logged in, and get user info if so -->
<?php
session_start();

if(isset($_SESSION['UserID']) && isset($_SESSION['Username']) && ($_SESSION['Type'] == 'Realtor'))
{
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>List Property</title>
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
    <body>
        <h2 class="text-center">Create Property Listing</h2>
        <div class="container" style="font-family: 'Signika', sans-serif">
          <form
            action="api_listproperty.php"
            method="POST"
            style="
              padding: 5%;
              box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
              width: auto;
            "
          >
            <img src="imgs/PMLOGO.PNG" width="10%" alt="" class="rounded mx-auto d-block" />

            <div class="form-group row">
                <label for="Address">Address</label>
                <input type="text" name="Address" id="Address" class="form-control" required>
            </div>
            <div class="form-group row">
                <label for="Price">Price ($)</label>
                <input type="number" name="Price" id="Price" class="form-control" required>
            </div>
            <div class="form-group row">
                <label for="Style">Style</label>
                <input type="text" name="Style" id="Style" class="form-control" required>
            </div>
            <div class="form-group row">
                <label for="Status">Status</label>
                <input type="text" name="Status" id="Status" class="form-control" required>
            </div>
            <div class="form-group row">
                <label for="NumOfFloors">Number of Floors</label>
                <input type="number" name="NumOfFloors" id="NumOfFloors" class="form-control" required>
            </div>
            <div class="form-group row">
                <label for="NumOfBedrooms">Number of Bedrooms</label>
                <input type="number" name="NumOfBedrooms" id="NumOfBedrooms" class="form-control" required>
            </div>
            <div class="form-group row">
                <label for="NumOfBathrooms">Number of Bathrooms</label>
                <input type="number" name="NumOfBathrooms" id="NumOfBathrooms" class="form-control" required>
            </div>
                </br>
                <div class="col text-center">
                    <button type='submit' name='ListProp' id='ListProp' class="btn btn-primary btn-rounded">List Property</button>
                </div>
            </div>
          </form>
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