<?php
session_start();
require_once "../utils/auth.php";
require_once "../utils/db.php";

// Auth admin
if (! is_auth_bank()) {
    header("Location: ./login.php");
}

// POST
$message = "";
if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["name"] && $_POST["latitude"] && $_POST["longitude"] && $_SESSION["bank_id"]) {
    $name = $_POST["name"];
    $lat = $_POST["latitude"];
    $lon = $_POST["longitude"];
    $bank_id = $_SESSION["bank_id"];

    if (add_agency($name, $bank_id, $lat, $lon)) {
        $message = '<div class="alert alert-success" role="alert">Agence  créé avec succès</div>';

    } else {
        $message = '<div class="alert alert-danger" role="alert">une erreur s\'est produite lors de la creation de l\'agnce</div>';
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

    <title><?php echo $_SESSION['bank'] ?> | Ajouer agence</title>
  </head>
  <body>
    <?php require_once "../static/bank_nav.php" ?>
    <div class="container mt-5">
    <?php echo $message ?>
    <form method="POST">
    <div class="mb-3">
        <label class="form-label">Nom</label>
            <input required name="name" type="text" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Latitude</label>
            <input required name="latitude" type="number" step="0.00000001" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Logitude</label>
            <input required name="longitude" type="number" step="0.00000001" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
    </div>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>