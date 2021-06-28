<?php
session_start();
require_once "../utils/reuse.php";
require_once "../utils/auth.php";
require_once "../utils/db.php";

// Auth bank
if (! is_auth_user()) {
    header("Location: ./login.php");
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
        <form method="POST" class="mb-5">
            <input type="hidden" name="form_role" value="insert">
            <div class="row">
                <div class="col">
                    <?php devise_select() ?>
                </div>
                <div class="col">
                    <select class="form-select" name="type">
                        <option value="buy" selected>Achat</option>
                        <option value="sell">Vendre</option>
                    </select>
                </div>
                <div class="col">
                <input required name="amount" placeholder="Montant a acheter/vendre" type="number" min=0 step="1" class="form-control"></input>
                </div>
                <div class="col">
                    <input required type="submit" value="Trouver des offres" class="btn btn-primary" />
                </div>
            </div>
        </form>

        <?php 
            if ($_POST["devise"] && $_POST["type"] && $_POST["amount"]) {
                get_offers($_POST["devise"], $_POST["type"], $_POST["amount"]);  
            }
        ?>  
            
    </div>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>

