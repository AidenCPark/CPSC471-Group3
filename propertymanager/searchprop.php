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
        <title>Search Properties</title>
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
        <h2 class="text-center">Search Property Listings</h2>
        <form
            action=""
            method="POST"
            style="
              padding: 5%;
              box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
              width: auto;
            "
        >
        <div class="form-group row">
            <label for="MinPrice" class="col-sm-2 col-form-label">Minimum Price:</label>
            <div class="col-auto my-1">
              <input
                type="number"
                name="MinPrice"
                class="form-control"
                id="MinPrice"
                placeholder=""
                value="0"
                required
              >
            </input>
            </div>
        </div>

        <div class="form-group row">
            <label for="MaxPrice" class="col-sm-2 col-form-label">Maximum Price:</label>
            <div class="col-auto my-1">
              <input
                type="number"
                name="MaxPrice"
                class="form-control"
                id="MaxPrice"
                placeholder=""
                value="1000000"
                required
              >
            </input>
            </div>
        </div>

        <div class="form-group row">
            <label for="NumOfFloors" class="col-sm-2 col-form-label">Number of Floors:</label
            >
            <div class="col-auto my-1">
              <input
                type="number"
                name="NumOfFloors"
                class="form-control"
                id="NumOfFloors"
                placeholder=""
                required
              >
            </input>
            </div>
        </div>

        <div class="form-group row">
            <label for="NumOfBedrooms" class="col-sm-2 col-form-label">Number of Bedrooms:</label
            >
            <div class="col-auto my-1">
              <input
                type="number"
                name="NumOfBedrooms"
                class="form-control"
                id="NumOfBedrooms"
                placeholder=""
                required
              >
            </input>
            </div>
        </div>

        <div class="form-group row">
            <label for="NumOfBathrooms" class="col-sm-2 col-form-label">Number of Bathrooms:</label
            >
            <div class="col-auto my-1">
              <input
                type="number"
                name="NumOfBathrooms"
                class="form-control"
                id="NumOfBathrooms"
                placeholder=""
                required
              >
            </input>
            </div>
        </div>

          <div class="form-group row">
            <div class="col-auto my-1">
              <button type="submit" name="Search" value="Search" id="Search" class="btn btn-primary">Search</button>
            </div>
          </div>
    </form>
    </div>
    
    <!-- Search Results -->
    <div style="text-align:center">


    <?php

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Search']))  
    {
      // Connect to database: return error if can't connect
      $conn= mysqli_connect('localhost', 'root', '', 'propertymanager') or die("Connection Failed:" .mysqli_connect_error());
      
      $MinPrice= $_POST['MinPrice'];
      $MaxPrice= $_POST['MaxPrice'];
      $NumOfFloors= $_POST['NumOfFloors'];
      $NumOfBedrooms= $_POST['NumOfBedrooms'];
      $NumOfBathrooms= $_POST['NumOfBathrooms'];

      $sql= "CALL property_search('$MinPrice', '$MaxPrice', '$NumOfFloors', '$NumOfBedrooms', '$NumOfBathrooms')";
      $query = mysqli_query($conn,$sql);

      if(mysqli_num_rows($query)===0)
      {
        echo '<br />No results found.';
      }
          
      while($row = mysqli_fetch_array($query)):;?>

      <a href="product_view.php?id=<?php echo $row['PropertyID'];?>">
      <?php echo '<br />' .$row['Address'];?>
      <?php echo '<br />$' .$row['Price'];?>
      <?php echo '<br />';?>
      </a>

      <?php endwhile;?>

      <?php } ?>


    

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