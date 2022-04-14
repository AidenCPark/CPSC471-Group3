<!-- Check if logged in, and get user info if so – Also get property info -->
<?php
session_start();

if(isset($_SESSION['UserID']) && isset($_SESSION['Username']))
{

  $id = $_GET["id"];
  $conn = mysqli_connect('localhost', 'root', '', 'propertymanager') or die("Connection Failed:" .mysqli_connect_error());
  $sql= "CALL property_get('$id')";
  $result = mysqli_query($conn,$sql);
  $property = mysqli_fetch_row($result);
  $PropertyID = $property[0];
  $RealtorID = $property[1];
  $Address = $property[2];
  $Price = $property[3];
  $Style = $property[4];
  $Status = $property[5];
  $NumOfFloors = $property[6];
  $NumOfBedrooms = $property[7];
  $NumOfBathrooms = $property[8];
  $ClientID = $_SESSION['UserID'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Product</title>
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
    <div class="container" style="padding-bottom: 2.5%; padding-top: 2.5%">
        <div class="card" style="border-radius: 25px">
          <div class="card-body">
            <div class="row">
              <div class="col text-center">
                <h2 class="mt-5" style="display: inline-block">
                    <?php echo $Address ?>
                </h2>

                <br>
                <br>

                <!-- Booking appointments – only for clients -->

                <?php if ($_SESSION['Type'] == 'Client'): ?>

                  <form
                  action="api_addappointment.php"
                  method="POST"
                  style=""
                >

                <input
                name="ClientID"
                type="hidden"
                id="ClientID"
                value="<?php echo $ClientID ?>" >
                </input>
                <input
                name="RealtorID"
                type="hidden"
                id="RealtorID"
                value="<?php echo $RealtorID ?>" >
                </input>

                <h3 class="box-title mt-5" style="text-align:left;">Book Appointment</h3>
                <br>
            <div class="form-group row">
            <label for="Date" class="col-sm-2 col-form-label">Appointment Date:</label>
            <div class="col-auto my-1">
              <input
                type="date"
                name="Date"
                class="form-control"
                id="Date"
                placeholder=""
                required
              >
            </input>
            

            </div>
            </div>

                <div class="row" style="padding-left:2.2%;">
                    <button name="Appointment" id="Appointment" type="submit" class="btn btn-primary btn-rounded">Submit</button>
                </div>


               </form>

              <?php endif ?>

              <!-- Remove Button -->

              <?php if ($_SESSION['Type'] == 'Admin' || ($_SESSION['Type'] == 'Realtor' && $RealtorID == $_SESSION['UserID'])): ?>   

                <form action="api_removeprop.php" method="POST" style="">

                <input type="hidden" name="PropertyID" id="PropertyID" value="<?php echo $PropertyID ?>"></input>

                <div class="col text-center" style="">
                    <button name="Remove" id="Remove" type="submit" class="btn btn-rounded" style="background-color:red">Remove</button>
                </div>

                </form>
                
              <?php endif ?>

              <!-- Property Info -->

            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
              <h3 class="box-title mt-5">Property Details</h3>
              <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr>
                      <td width="290">Status</td>
                      <td>
                        <?php echo $Status ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Price</td>
                      <td>
                        $<?php echo $Price ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Style</td>
                      <td>
                        <?php echo $Style ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Number of Floors</td>
                      <td>
                        <?php echo $NumOfFloors ?>-storey
                      </td>
                    </tr>
                    <tr>
                      <td>Number of Bedrooms</td>
                      <td>
                        <?php echo $NumOfBedrooms ?> bedroom(s)
                      </td>
                    </tr>
                    <tr>
                      <td>Number of Bathrooms</td>
                      <td>
                        <?php echo $NumOfBathrooms ?> bathroom(s)
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php if ($_SESSION['Type'] == 'Admin' || ($_SESSION['Type'] == 'Realtor' && $RealtorID == $_SESSION['UserID'])): ?>            

        <h3 class="box-title mt-5" style="text-align:left;">Edit Property</h3>
        <br>

        <form action="api_editproperty.php" method="POST" style="">

        <input name="PropertyID" type="hidden" id="PropertyID" value="<?php echo $PropertyID ?>" ></input>
        <input name="RealtorID" type="hidden" id="RealtorID" value="<?php echo $RealtorID ?>" ></input>
        Address: <input required name="Address" type="text" id="Address" value="<?php echo $Address ?>" ></input>
        <br>
        Status: <input required name="Status" type="text" id="Status" value="<?php echo $Status ?>" ></input>
        <br>
        Price: <input required name="Price" type="number" id="Price" value="<?php echo $Price ?>" ></input>
        <br>
        Style: <input required name="Style" type="text" id="Style" value="<?php echo $Style ?>" ></input>
        <br>
        Number of Floors: <input required name="NumOfFloors" type="number" id="NumOfFloors" value="<?php echo $NumOfFloors ?>" ></input>
        <br>
        Number of Bedrooms: <input required name="NumOfBedrooms" type="number" id="NumOfBedrooms" value="<?php echo $NumOfBedrooms ?>" ></input>
        <br>
        Number of Bathrooms: <input required name="NumOfBathrooms" type="number" id="NumOfBathrooms" value="<?php echo $NumOfBathrooms ?>" ></input>

        <br><br>
        <button name="PropUpdate" id="PropUpdate" type="submit" class="btn btn-primary btn-rounded">Submit</button>

        </form>

      <?php endif ?>
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