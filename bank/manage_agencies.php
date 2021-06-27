<?php
session_start();
require_once "../utils/reuse.php";
require_once "../utils/auth.php";
require_once "../utils/db.php";

// Auth bank
if (! is_auth_bank()) {
    header("Location: ./login.php");
}

// Add offre
$message = "";
if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["form_role"] == "delete" && $_POST['id'] ) {
        if (delete_agency($_POST['id'], $_SESSION['bank_id'])) {
            $message = '<div class="alert alert-success" role="alert">Agence supprimé</div>';
        } else {
            $message = '<div class="alert alert-danger" role="alert">une erreur s\'est produite.</div>';
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
    <?php require_once "../static/bank_nav.php" ?>
    <div class="container mt-5">
        <?php get_agencies_bank($_SESSION["bank_id"]); ?>    
    </div>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>

