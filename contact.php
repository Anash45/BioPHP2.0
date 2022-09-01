<?php
session_start();
include('dashboard/defines/db_conn.php');
include('dashboard/defines/classes.php');
$users = new users;

$show = $info = '';
if (isset($_REQUEST['send'])) {
    $info = $users->send_message();
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
                            <a class="nav-link active" aria-current="page" href="contact.php">Contact</a>
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
            <section class="form py-5">
                <h1 class="title mb-4 text-center">Contact Us</h1>
                <p class="description text-center mb-3">We'll love to hear from you.</p>
                <div class="col-md-6 col-sm-8 col-12 mx-auto">
                    <div class="card p-sm-5 py-4 px-3">
                        <form action="" class="needs-validation" novalidate method="post">
                            <?php echo $info; ?>
                            <div class="form-group mb-3">
                                <label for="name">Name:</label>
                                <input type="name" id="name" name="name" class="form-control" required placeholder="Enter you name...">
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" class="form-control" required placeholder="Enter you email...">
                            </div>
                            <div class="form-group mb-3">
                                <label for="subject">Subject:</label>
                                <input type="subject" id="subject" name="subject" class="form-control" required placeholder="Enter you email...">
                            </div>
                            <div class="form-group mb-3">
                                <label for="message">Message:</label>
                                <textarea type="message" id="message" rows="5" name="message" class="form-control" required placeholder="Enter you message..."></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary w-100" name="send">Send</button>
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