<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once "../utils/auth.php";

// Don't show if already logged
if (is_auth_admin()) {
    header("Location: ./index.php");
}

// POST
$error = "";
if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["username"] && $_POST["password"]) {
    if (auth_admin($_POST["username"], $_POST["password"])) {
        $_SESSION["is_admin"] = true;
        header("Location: ./index.php");
    } else {
        $error = '<div class="alert alert-danger" role="alert">Invalid credentials</div>';
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Login Admin</title>
  </head>
  <body>
    <div class="container mt-5">
        <form method="POST">
            <div class="row">
                <div class="col">
                    <input required name="username" type="text" class="form-control" placeholder="username" aria-label="username">
                </div>
                <div class="col">
                    <input required name="password" type="password" class="form-control" placeholder="password" aria-label="password">
                </div>
                <div class="col">
                    <input type="submit" value="Login" class="btn btn-primary" />
                </div>
            </div>
        </form>
        <?php echo $error ?>
       
    </div>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>

