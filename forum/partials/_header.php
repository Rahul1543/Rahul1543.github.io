<?php
session_start();
echo '<nav class="navbar navbar-expand-lg bg-dark body-tertiary navbar-dark ">
<div class="container-fluid">
  <a class="navbar-brand" href="/forum">Co-discuss</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/forum">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Top Categories
        </a>
        <ul class="dropdown-menu">';
        include '_dbconnect.php';
        $sql="SELECT cname,cid FROM `categories` LIMIT 3";
        $res=$conn->query($sql);
        while($row=mysqli_fetch_assoc($res)){
          echo '<li><a class="dropdown-item" href="threads.php?catid='.$row['cid'].'">'.$row['cname'].'</a></li>';
        }

       echo '   
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php" tabindex="-1">Contact</a>
      </li>
    </ul>';
    
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
      echo '<form class="d-flex" role="search" method="get" action="search.php">
              <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <div class="mx-2">
            <span class="navbar-text text-light mx-2 my-0">Welcome ' . htmlspecialchars($_SESSION['useremail']) . '</span>
              <a href="partials/_logout.php" class="btn btn-success ml-2">Logout</a>
            </div>';
  } else {
      echo '<form class="d-flex" role="search" method="get" action="search.php">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <div class="mx-2">
              <button class="btn btn-success ml-2" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
              <button class="btn btn-success ml-2" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>
            </div>';
  }
  
  echo '</div>
  </div>
  </nav>';
include '_loginmodal.php';
include '_signupmodal.php';

if (isset($_GET['signupstatus']) && $_GET['signupstatus'] == "true") {
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
          <strong>Success!</strong> You have signed up. Please log in.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
} elseif (isset($_GET['error']) && $_GET['error'] != "false") {
  echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
          <strong>Sorry! </strong> ' . htmlspecialchars($_GET['error']) . '
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
} elseif (isset($_GET['loginstatus']) && $_GET['loginstatus'] == "true") {
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
          <strong>Success!</strong> You have successfully logged in.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
?>
