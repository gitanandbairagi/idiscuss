<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDiscuss - Coding Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="partials/_custom_css.css">
</head>

<body>

    <?php
        require 'partials/_header.php';   
        require 'partials/_dbconnect.php';    
    ?>

    <div class="mega-container">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // INSERTING THREAD INTO THE DATABASE
            $title = $_POST['title'];
            $description = $_POST['description'];
            $userId = $_POST['hiddenUserId'];

            $title = str_replace("<", "&lt", $title);
            $title = str_replace(">", "&gt", $title);

            $description = str_replace("<", "&lt", $description);
            $description = str_replace(">", "&gt", $description);

            $catid = $_GET['catid'];
            $sql = "INSERT INTO `threads` (`threadTitle`, `threadDescription`, `threadUser`, `threadCategoryId`, `tstamp`) VALUES ('$title', '$description', $userId, $catid, current_timestamp());";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your Thread has been Added. Someone will Reply Shortly.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
        }
    ?>

        <!--JUMBOTRON: PAGE HEADING AND DESCRIPTION-->
        <?php
    $catid = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE categoryId = $catid";
    $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
        $catname = $row['categoryName'];
        $catdescription = $row['categoryDescription'];
        }
    ?>
        <div class="container my-3 py-3 shadow p-3 mb-5 bg-white rounded">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-6 text-center">iDiscuss - Welcome to <?php echo $catname ?> Forum</h1>
                    <p class="lead text-center"><?php echo $catdescription ?></p>
                </div>
            </div>
        </div>

        <!-- QUESTION FORM -->
        <?php
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
            $userId = $_SESSION['userId'];

            echo '<div class="container">
                    <h3 class="my-3">Start a Discussion</h3>
                    <form action="'. $_SERVER['REQUEST_URI']. '" method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Problem Tittle</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="title" aria-describedby="emailHelp">
                        <input type="hidden" class="form-control" id="hiddenUserId" value="'.$userId.'" name="hiddenUserId" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">Keep Your Tittle as Short and Crisp as Possible.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Elaborate Your Concern</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                    </div>';
        } else {
            echo '<div class="container">
                    <h3 class="my-3">Start a Discussion</h3>
                    <p class="lead">Please Log in to Start a Discussion</P>
                </div>';
        }   

    ?>

        <div class="container">
            <h4 class="my-3">Browse Questions</h4>
            <!-- MEDIA OBJECT -->
            <?php
            $noResult = true;
            $catid = $_GET['catid'];
            $sql = "SELECT * FROM `threads` WHERE threadCategoryId = $catid";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $noResult = false;
                $threadTitle = $row['threadTitle'];
                $threadDescription = $row['threadDescription'];
                $threadId = $row['threadId'];
                $threadUser = $row['threadUser'];

                $sql_2 = "SELECT userName FROM `users931` WHERE userId = $threadUser";
                $result_2 = mysqli_query($conn, $sql_2);
                $row_2 = mysqli_fetch_assoc($result_2);
                $userName = $row_2['userName'];

                echo '<div class="d-flex pt-1">
                <div class="flex-shrink-0">
                <img src="img/icons_male_user.png" width="35px" alt="icon">
                </div>
                <div style="max-width:80%;" class="flex-grow-1 ms-3">
                <a href="thread.php?threadId=' . $threadId . '" class="text-dark text-decoration-none">
                <h5>'.$threadTitle.'</h5>
                <p>'.$threadDescription.'</p>
                </a>
                </div>
                <h6>Asked by : ' . $userName . '</h6>
                </div>
                <hr>';
            }

            if ($noResult == true) {
                echo '<div class="jumbotron jumbotron-fluid">
                <div class="container bg-light py-4 shadow p-3 mb-5 bg-white rounded">
                  <h1 class="display-4">No Threads Found</h1>
                  <p class="lead">Be the First Person to Start a Discussion</p>
                </div>
              </div>';
            }
        ?>
        </div>
            
        <?php
            include 'partials/_footer.html';
        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
        </script>
</body>

</html>