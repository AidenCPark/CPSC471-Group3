<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Log In</title>
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
<body class="text-center">
    <nav class="navbar navbar-light bg-light sticky-top navbar-expand-lg">
        <a class="navbar-brand" href="index.php">
            <img src="imgs/PMLOGO.PNG" width="30" height="30" class="d-inline-block align-top" alt="">
            Property Manager
          </a>
    </nav>        
    <div
      class="d-flex align-items-center justify-content-center"
      style="width: 100%; height: 100vh"
    >
      <form
        style="
          padding: 5%;
          border-radius: 25px;
          font-family: 'Signika', sans-serif;
          box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
        "
        action="login.php" method="post"
      >
        <img src="imgs/PMLOGO.PNG" width="60%" alt="" />
        <br />
        <br />

        <?php if(isset($_GET['error'])) { ?>
          <p class="error"> <?php echo $_GET['error']; ?></p>
        <?php } ?>

        <div class="form-group">
          <label for="Username">Enter Username:</label>
          <br />
          <input
            type="text"
            name="Username"
            id="Username"
            placeholder="Username"
            class="form-control" required
          />
        </div>
        <div class="form-group">
          <label for="Password">Enter Password:</label>
          <br />
          <input
            type="password"
            name="Password"
            id="Password"
            placeholder="Password"
            class="form-control" required
          />
        </div>
        <input type="submit" value="Log In" class="btn btn-primary" />
        <br />
        <br />
        <a class="dropdown-item" href="signup.php">New user? Sign Up</a>
      </form>
    </div>
  </body>
</html>