
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Shopping | Starter</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Start Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

      <?php
        $link = $_SERVER['PHP_SELF'];
        $link_array = explode('/',$link);
        $page = end($link_array);
      ?>

      <!-- Navbar Search -->
      <?php if($page != 'order.php' && $page != 'weekly_report.php' && $page != 'monthly_report.php' && $page != 'royal_customer.php' && $page != 'bestseller_item.php'  ){ ?>
        <form class="form-inline ml-3" method="post"
            <?php if ($page == 'product') { ?> 
              action="index.php" 
            <?php } elseif ($page == 'category') { ?>
              action="category.php" 
            <?php } elseif ($page == 'user') { ?>
              action="user.php" 
            <?php } ?>
          > 
          <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" name="search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>  
          </form>
        <?php } ?>
  </nav>
  <!-- End Navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <span class="brand-text font-weight-light">Shopping Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="images/myprofile.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['username'];?></a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/admin/index.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Product
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/admin/category.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Category
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/admin/user.php" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Users
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/admin/order.php" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Orders
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview menu">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Reports
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
          
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="weekly_report.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Weekly reports
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="monthly_report.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Monthly reports
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="royal_customer.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Royal Customers
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="bestseller_item.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Best Seller Items
                    </p>
                  </a>
                </li>
              </ul> 
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    