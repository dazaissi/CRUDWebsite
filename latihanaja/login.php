<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../latihanaja/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="../latihanaja/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>

<div class="container" style="margin-top:100px">
  <div class="row justify-content-center">
    <div class="col-md-4">

      <div class="card">
        <div class="card-header bg-success text-white text-center">
          <h4>Login</h4>
        </div>

        <div class="card-body">
          <form method="POST" action="../latihanaja/validasiUser.php">

            <div class="mb-3">
              <label>Id User</label>
              <input type="text" name="id_admin" class="form-control" required>
            </div>

            <div class="mb-3">
              <label>Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success w-100">Login</button>

          </form>
        </div>
      </div>

    </div>
  </div>
</div>

</body>
</html>