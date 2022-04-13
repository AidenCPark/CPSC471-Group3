<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Sign Up</title>
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
        <a class="navbar-brand" href="index.php">
            <img src="imgs/PMLOGO.PNG" width="30" height="30" class="d-inline-block align-top" alt="">
            Property Manager
          </a>

    </nav>
    <body>
        <h2 class="text-center">Sign Up</h2>
        <div class="container" style="font-family: 'Signika', sans-serif">
          <form
            action='api_signup.php'
            method="POST"
            style="
              padding: 5%;
              box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
              width: auto;
            "
          >
            <img src="imgs/PMLOGO.PNG" width="10%" alt="" class="rounded mx-auto d-block" />
            <div class="form-group row">
                <label for="PERSON">Name</label>
                <input type="text" name="Name" id="Name" class="form-control" required>
            </div>
            <div class="form-group row">
                <label for="PERSON">Email</label>
                <input type="email" name="Email" id="Email" class="form-control" required>
            </div>
            <div class="form-group row">
                <label for="PERSON">Phone Number</label>
                <input type="text" name="Phone" id="Phone" class="form-control" required>
            </div>
            <div class="form-group row">
                <label for="PERSON">Username</label>
                <input type="text" name="Username" id="Username" class="form-control" required>
            </div>
            <div class="form-group row">
                <label for="PERSON">Password</label>
                <input type="password" name="Password" id="Password" class="form-control" required>
            </div>
            <div class="form-group row">
                <label for="PERSON">Account Type</label>
            </div>
                <select name="Type">
                  <option value="Client">Client</option>
                  <option value="Realtor">Realtor</option>
                  <option value="Admin">Admin</option>
                </select>

            <div>
                </br>
                <div class="col text-center">
                    <button type='submit' name='SignUp' id="SignUp" class="btn btn-primary btn-rounded">Sign Up</button>

                    <br>
                    <br>

                    <!-- This is where the error message goes -->
                    <?php if(isset($_GET['error'])) { ?>
                    <span style="color:#ff0000" ><p class="error"> <?php echo $_GET['error']; ?></p></span>
                    <?php } ?>
                </div>
            </div>

          </form>
    </body>
</html>    