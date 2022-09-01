<?php
session_start();
include('dashboard/defines/db_conn.php');
include('dashboard/defines/classes.php');
$users = new users;
$tools = new tools;
$show = $info = '';

$show = $tools->tool_details();
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
                            <a class="nav-link active" aria-current="page" href="tools.php">Tools</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                        <?php
                        if ($users->user_check()) {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="u_tools.php">Your Tools</a>
                            </li>
                            <li class="nav-item">
                                <a href="logout.php" class="btn btn-warning">Logout</a>
                            </li>

                            <?php 
                            }
                            else {
                            ?>
                            <li class="nav-item">
                                <a href="login.php" class="btn btn-warning">Login / Signup</a>
                            </li>
                            <?php 
                            } 
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <section class="tools py-5">
                <h1 class="title mb-4 text-center">Tool</h1>
                <div class="tool">
                    <?php 
                    if (!empty($show)) {
                        echo '<iframe src="dashboard/'.$show.'" frameborder="0"></iframe>';
                    }
                    ?>
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