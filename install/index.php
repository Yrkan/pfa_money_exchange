<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Installation</title>
  </head>
  <body>
    <div class="container mt-5">
    <form class="row" action="install.php" method="POST">
      <div class="input-group input-group-sm mb-3">
        <span class="input-group-text" id="inputGroup-sizing-sm-1">Server name / IP</span>
        <input name="servername" required type="text" class="form-control" aria-label="server name / ip" aria-describedby="inputGroup-sizing-sm-1">
      </div>
      <div class="input-group input-group-sm mb-3">
        <span class="input-group-text" id="inputGroup-sizing-sm-2">Database Username</span>
        <input name="dbuser" type="text" class="form-control" aria-label="db username" aria-describedby="inputGroup-sizing-sm-2">
      </div>
      <div class="input-group input-group-sm mb-3">
        <span class="input-group-text" id="inputGroup-sizing-sm-3">Database Password</span>
        <input name="dbpass" type="text" class="form-control" aria-label="db password" aria-describedby="inputGroup-sizing-sm-3">
      </div>
      <div class="input-group input-group-sm mb-3">
        <span class="input-group-text" id="inputGroup-sizing-sm-4">Admin username</span>
        <input name="adminuser" required type="text" class="form-control" aria-label="admin username" aria-describedby="inputGroup-sizing-sm-4">
      </div>
      <div class="input-group input-group-sm mb-3">
        <span class="input-group-text" id="inputGroup-sizing-sm-5">Admin Password</span>
        <input name="adminpass" required type="text" class="form-control" aria-label="adminpassword" aria-describedby="inputGroup-sizing-sm-5">
      </div>
      <input class="btn btn-primary" value="Install" type="submit"/>
      </form>
    </div>    

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
