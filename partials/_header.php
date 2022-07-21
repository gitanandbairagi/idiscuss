<?php
session_start();

require '_dbConnect.php';

echo '<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
<div class="container-fluid">
    <a class="navbar-brand" href="index.php">iDiscuss</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Top Categories
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';

                $sql = "SELECT categoryName, categoryId FROM `categories` LIMIT 5";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $catid = $row['categoryId'];
                    $catname = $row['categoryName'];
                    echo '<li>';
                    echo '<a class="dropdown-item" href="threadList.php?catid=' . $catid . '">' . $catname . '</a>';
                    echo '</li>';
                }
                
                echo '</ul>
            </li>';

            if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
                $arr = explode(" ", $_SESSION['userName']);
                $firstName = $arr[0];
                echo '<li class="nav-item">
                        <a class="nav-link text-light" href="#">Hello '.$firstName.'</a>
                    </li>';
            }

        echo '</ul>';
        
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
            echo '<div class="mx-2">
            <form class="d-flex" role="search" action="search.php" method="GET">
                <input class="form-control me-2" type="search" placeholder="Search" name="query" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
                <a href="partials/_logoutHandler.php" class="btn btn-outline-success mx-2">Logout</a>
            </form>
            </div>';
        }
        else {
            echo '<div class="mx-2">
                <form class="d-flex" role="search" action="search.php" method="GET">
                    <input class="form-control me-2" type="search" placeholder="Search" name="query" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                    <button type="button" class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#signupModal">SignUp</button>
                </form>
            </div>';
        }
    
    echo '</div>
</div>
</nav>';

include 'partials/_loginModal.php';
include 'partials/_signupModal.php';

if (isset($_GET['showAlert']) && $_GET['showAlert'] == "true") {
    echo "<div class='alert alert-success alert-dismissible fade show my-0' role='alert'>
        <strong>Success!</strong> You Can Login Now.
        <button type='button' class='btn-close'data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
}
elseif (isset($_GET['showError']) && $_GET['showError'] == true) {
    $showError = $_GET['showError'];
    echo "<div class='alert alert-warning alert-dismissible fade show my-0' role='alert'>
    <strong>$showError</strong> 
    <button type='button' class='btn-close'data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
}
?>