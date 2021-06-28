<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once "../utils/reuse.php";
require_once "../utils/auth.php";
require_once "../utils/db.php";

// Auth bank
if (! is_auth_user()) {
    header("Location: ./login.php");
}

// POST
$message = "";
if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["devise"] && $_POST["type"] && $_POST["bank"] && $_POST["amount"] && $_POST["price"]) {
    if (add_transaction($_POST["type"], $_POST["devise"], $_SESSION["user_id"], $_POST["bank"], $_POST["price"], $_POST["amount"])) {
        $message = '<div class="alert alert-success" role="alert">Transaction effectué</div>';
    } else {
        $message = '<div class="alert alert-danger" role="alert">une erreur s\'est produite lors du traitement de la transaction</div>';
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

    <title>Offres</title>
  </head>
  <body>
    <?php require_once "../static/client_nav.php" ?>
    <div class="container mt-5">
            <?php echo $message ?>
            <?php echo get_transactions_client($_SESSION["user_id"]) ?>;
    </div>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>

