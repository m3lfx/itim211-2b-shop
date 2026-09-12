<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="./includes/style/style.css" rel="stylesheet" type="text/css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
  </script>
  <title>shop </title>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">My Shop</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu">
              <?php if ($_SESSION['role'] === 'admin') {
                echo '<li><a class="dropdown-item" href="../item/index.php">item</a></li>';
                echo '<li><a class="dropdown-item" href="../admin/orders.php">Orders</a></li>';
              }

              ?>

              <li><a class="dropdown-item" href="user/myorders.php">My Orders</a></li>
              <li>
              <li><a class="dropdown-item" href="user/profile.php">My Profile</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>

            </ul>
          </li>

        </ul>
        <form action="search.php" method="GET" class="d-flex">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
            name="search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <?php
        if (!isset($_SESSION['user_id'])) {
          echo "<div class='navbar-nav ms-auto'>
                        <a href='http://{$_SERVER['SERVER_NAME']}/itim211-2b-shop/user/login.php'  class='nav-item nav-link'>Login</a></div>";
        } else {
          echo "<li class='nav-item'>
           <p>{$_SESSION['email']}</p>
          </li>";
          echo "<div class='navbar-nav ms-auto'>
                        <a href='http://{$_SERVER['SERVER_NAME']}/itim211-2b-shop/user/logout.php'  class='nav-item nav-link'>Logout</a></div>";
        }
        ?>
      </div>
    </div>
  </nav>
</body>