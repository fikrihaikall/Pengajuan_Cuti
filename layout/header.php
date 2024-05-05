
<?php session_start(); ?>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Ourdash</title>

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.dataTables.css" />
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">


   <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
   <script src="https://cdn.datatables.net/2.0.6/js/dataTables.js"></script>

</head>

<body class="bg-body-tertiary">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <nav class="navbar navbar-expand-sm navbar-light bg-light">
               <div class="container-fluid">
                  <a href="#" class="navbar-brand">FIKRI</a>
                  <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                     <span class="navbar-toggler-icon"></span>
                  </button>
                  <div id="navbarCollapse" class="collapse navbar-collapse">
                     <ul class="nav navbar-nav">
                        <li class="nav-item">
                           <a href="index.php" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/ourdash/index.php' ? 'active' : '') ?>">Home</a>
                        </li>
                        <li class="nav-item">
                           <a href="approvalcuti.php" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/ourdash/cuti.php' ? 'active' : '') ?>">Approval Cuti</a>
                        </li>
                        <li class="nav-item">
                           <a href="cuti.php" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/ourdash/cuti.php' ? 'active' : '') ?>">Pengajuan Cuti</a>
                        </li>
                        <!-- <li class="nav-item dropdown">
                           <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Messages</a>
                           <div class="dropdown-menu">
                              <a href="#" class="dropdown-item">Inbox</a>
                              <a href="#" class="dropdown-item">Drafts</a>
                              <a href="#" class="dropdown-item">Sent Items</a>
                              <div class="dropdown-divider"></div>
                              <a href="#"class="dropdown-item">Trash</a>
                           </div>
                        </li> -->
                     </ul>
                     <ul class="nav navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                           <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><?= $_SESSION["username"]; ?></a>
                           <div class="dropdown-menu dropdown-menu-end">
                              <a href="#" class="dropdown-item">Profile</a>
                              <a href="#" class="dropdown-item">Settings</a>
                              <div class="dropdown-divider"></div>
                              <a href="../views/auth/logout.php" class="dropdown-item">Logout</a>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
            </nav> 