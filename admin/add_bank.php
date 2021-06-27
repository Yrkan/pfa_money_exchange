<?php
session_start();
require_once "../utils/auth.php";
require_once "../utils/db.php";

// Auth admin
if (! is_auth_admin()) {
    header("Location: ./login.php");
}

// POST
$message = "";
if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["username"] && $_POST["password"] && $_POST["name"]) {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $name = $_POST["name"];

    if (add_bank($username, $password, $name)) {
        $message = '<div class="alert alert-success" role="alert">Le compte banque a été  créé avec succès</div>';

    } else {
        $message = '<div class="alert alert-danger" role="alert">une erreur s\'est produite lors de la creation du compte</div>';
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

    <title>Admin | Ajouter une banque</title>
  </head>
  <body>
    <?php require_once "../static/admin_nav.php" ?>
    <div class="container mt-5">
    <?php echo $message ?>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input required name="name" type="text" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Nom d'utilisateur</label>
            <input required name="username" type="text" class="form-control" >
        </div>
        <div class="mb-3">
            <label class="form-label">Mot de passe</label>
            <input required name="password" type="password" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
    </div>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>