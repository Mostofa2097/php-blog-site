<?php
$page = basename($_SERVER['PHP_SELF'], ".php");
include "Config.php";
$select = "SELECT * FROM category ";
$run = mysqli_query($config,$select);
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <title>Hello, world!</title>
</head>

<body>


  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Blog</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item ">
            <a class="nav-link , <?= ($page == "index") ? 'active' : '' ?>" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Categories
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php
               while ($cats= mysqli_fetch_assoc($run)) {
             ?>
              <a class="dropdown-item" href="#"><?= $cats['cat_name']?></a>

              <?php }?>
              

          </li>
          <li class="nav-item ">
            <a class="nav-link , <?= ($page == "login") ? 'active' : '' ?>" href="login.php">Login </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link , <?= ($page == "Registration") ? 'active' : '' ?>" href="registration.php">Registration </a>
          </li>

        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </div>

  </nav>