<?php
session_start();
include('dashboard/defines/db_conn.php');
include('dashboard/defines/classes.php');
$users = new users;
$show = $info = '';
if (isset($_REQUEST['error']) && $_REQUEST['error'] == 1) {
    $info = '<div class="alert alert-warning">Kindly login first!</div>';
}
if (isset($_REQUEST['login'])) {
    $info = $users->user_login();
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="assets/img/icon.png" type="image/x-icon">
    <title>The BioPHP 2.0</title>

    
    <!-- Bootstrap core CSS -->
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="dashboard/datatables/dataTables.bootstrap4.css">

    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="index.php"><img src="assets/img/logo.png" alt="Logo" height="70"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="tools.php">Tools</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a href="login.php" class="btn btn-warning">Login / Signup</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <section class="form py-5">
                <h1 class="title mb-4 text-center">User Login</h1>
                <div class="col-md-6 col-sm-8 col-12 mx-auto">
                    <div class="card p-sm-5 py-4 px-3">
                        <form action="" class="needs-validation" novalidate method="post">
                            <?php echo $info; ?>
                            <div class="form-group mb-3">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" class="form-control" required placeholder="Enter you email...">
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" class="form-control" required placeholder="Enter you password...">
                            </div>
                            <div class="form-group mb-3">
                                <p class="m-0"><a href="ad_login.php" class="text-primary">Admin Login</a></p>
                            </div>
                            <div class="form-group mb-3">
                                <p class="m-0">Doesn't have an account? <a href="singup.php" class="text-primary">Signup here</a></p>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary w-100" name="login">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <footer class="pt-5 my-5 text-muted border-top text-center">
        The BioPHP 2.0 &copy; All Rights Reserved
        <script>
            var dt = new Date();
            document.write(dt.getFullYear());
        </script>
    </footer>


    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/main.js"></script>


</body>

</html>