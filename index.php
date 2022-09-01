<?php
session_start();
include('dashboard/defines/db_conn.php');
include('dashboard/defines/classes.php');
$users = new users;

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
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="tools.php">Tools</a>
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
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/img/slider1.jpg" class="d-block w-100" alt="Courtesy Google Images">
                </div>
                <div class="carousel-item">
                    <img src="assets/img/slider2.png" class="d-block w-100" alt="Courtesy Google Images">
                </div>
                <div class="carousel-item">
                    <img src="assets/img/slider3.jpg" class="d-block w-100" alt="Courtesy Google Images">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="container">
            <section class="about py-5">
                <h1 class="title mb-4 text-center">About the project <span class="special">"The BioPHP 2.0"</span></h1>
                <p class="description">
                    As the name says this project is a sequeal of an already present project <a target="_blank" class="text-primary" href="biophp.org">BioPHP.org</a>. This project was started in May 2022 by Syed Anas Bukhari and Kamran Majeed, students
                    in the Department of Computer Science, University of Agriculture Faisalabad, Pakistan.
                    <br><br> We used the developed PHP scripts from <a target="_blank" class="text-primary" href="biophp.org">BioPHP.org</a> for simulation of molecular biology techniques, and a website has been developped with those scripts at insilico.ehu.es.
                    The aim of this project is to present those scripts using modern web technology. The code present in the <a target="_blank" class="text-primary" href="biophp.org">BioPHP.org</a> was coded in 2005 and from then there are many changes
                    made in the web technology including PHP. So there were many bugs present in the scripts which are get rid of and then presented through out website. <br><br>We are also allowing the students to submit there projects and then those
                    projects will be added to the site after testing. Below is the method of submitting the project.
                </p>
            </section>
            <section class="submit py-5">
                <h1 class="title mb-4 text-center">How to submit your tool</h1>
                <p class="description">
                    There is a method to submit your tool to list on this website which is described below:
                </p>
                <ul class="description">
                    <li>First of all check that your tool is related to <b>Bio PHP</b>.</li>
                    <li>If yes then zip your files.</li>
                    <li>Click on the Login / Signup button.</li>
                    <li>From there go to the Signup page and fill all your details to register on this website.</li>
                    <li>After that you'll see a tab "Your tools" in the top menu. Go to that page and then you'll see a button "Submit a tool".</li>
                    <li>Click on it and fill all the related details and upload your zip file there.</li>
                    <li>Once you submit the tool it will go to our admins, they'll check and test, if everything works good your tool will list on this website.</li>
                    <li>You can check the status of your all tools in the "Your tools" page.</li>
                </ul>
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