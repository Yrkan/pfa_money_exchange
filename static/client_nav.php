<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="./index.php"><?php echo $_SESSION["user"] ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="./offers.php">Offres</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="./transactions.php">Transactions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="./find_agencies.php">Chercher Agence</a>
        </li>
      </ul>
      <a class="nav-link active" href="./logout.php">Deconnexion</a>
    </div>
  </div>
</nav>