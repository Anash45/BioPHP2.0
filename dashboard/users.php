<?php
session_start();
include('defines/db_conn.php');
include('defines/classes.php');
$admin =  new admin;
$users =  new users;
$admin->admin_check();
$show = $info = '';

$show = $users->show_users();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - The BioPHP 2.0</title>
    <link rel="stylesheet" href="datatables/dataTables.bootstrap4.css">
    <!-- Bootstrap core CSS -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="../index.php">The BioPHP 2.0</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
        <div class="navbar-nav d-md-inline-block d-none">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="logout.php">Logout</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">
                                <span data-feather="home"></span> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="users.php">
                                <span data-feather="users"></span> Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="tools.php">
                                <span data-feather="tool"></span> Tools
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="u_tools.php">
                                <span data-feather="layers"></span> User Tools
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="messages.php">
                                <span data-feather="inbox"></span> Messages
                            </a>
                        </li>
                        <li class="nav-item d-md-none d-block">
                            <a class="nav-link" href="logout.php">
                                <span></span> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Users</h1>
                </div>
                <div class="py-5 table-responsive">
                    <table class="table table-hover table-striped table-responsive" id="dataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Tools <small>(Submitted | Posted)</small></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $show; ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="dashboard.js"></script>
    <!-- Page level plugins -->
    <script src="datatables/jquery.dataTables.min.js"></script>
    <script src="datatables/dataTables.bootstrap4.min.js"></script>
    <script>
        // Call the dataTables jQuery plugin
        $('#dataTable').DataTable();
    </script>
</body>

</html>