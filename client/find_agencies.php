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
            <div class="row">
                <div class="col">
                    <input required name="bank" placeholder="Entrer le nom du banque" type="text" class="form-control"></input>                
                </div>
                <div class="col">
                    <input required type="submit" value="Trouver des agences" class="btn btn-primary" />
                </div>
            </div>
        </form>

        <?php 
            if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["bank"]) {
                get_agencies_client($_POST["bank"]);  
            }
        ?>  
            
    </div>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>

