<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDiscuss - Coding Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="partials/_custom_css.css">
    <script>
    $(document).ready(function() {
        $("#exampleModalCenter").modal('show');
    });
    </script>
</head>

<body>
    <?php
        require 'partials/_header.php';   
        require 'partials/_dbconnect.php';   
    ?>

    <div class="mega-container">
        <!-- CAROUSEL -->
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/frontCarousel_1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="img/frontCarousel_2.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="img/frontCarousel_3.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- CATEGORY CARD -->
        <div class="container my-3">
            <h3 class="text-center">iDiscuss - Browse Categories</h3>
            <div class="row my-3">
                <!-- PHP: Fetching Categories from idiscuss -->
                <?php
                $sql = "SELECT * FROM `categories`";
                $result = mysqli_query($conn, $sql);
                // PHP: Using while loop to iterate category table 
                while ($row = mysqli_fetch_assoc($result)) {
                    $catid = $row['categoryId'];
                    echo '<div class="col-md-4 my-2">
                            <div class="card mx-auto" style="width: 18rem;">
                                <a class="text-decoration-none" href="threadList.php?catid=' . $catid . '">
                                <img src="img/'. $row['categoryImgName'] .'.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                <h5 class="card-title text-black">'. $row['categoryName']. '</h5>
                                </a>
                                    <p class="card-text">'. substr($row['categoryDescription'], 0, 90) .'...</p>
                                    <a href="threadList.php?catid=' . $catid . '" class="btn btn-primary">View Threads</a>
                                </div>
                            </div>
                        </div>';
                }
            ?>
            </div>
        </div>
    </div>

    <?php
        include 'partials/_footer.html';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>