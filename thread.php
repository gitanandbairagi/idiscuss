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
        <!-- SHOW ALERT ON : COMMENT ADDED SUCCESSFULLY -->
        <?php
            if (isset($_GET['result']) && $_GET['result'] == true) {
                echo "<div class='alert alert-success alert-dismissible fade show my-0' role='alert'>
                        <strong>Success!</strong> You Comment has been Added Successfully.
                        <button type='button' class='btn-close'data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }
        ?>

        <!--JUMBOTRON: QUESTION AND DESCRIPTION-->
        <?php
            $threadId = $_GET['threadId'];
            $sql = "SELECT * FROM `threads` WHERE threadId = $threadId";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $threadtitle = $row['threadTitle'];
            $threaddescription = $row['threadDescription'];
            $threadUser = $row['threadUser'];

            $sql_2 = "SELECT userName FROM `users931` WHERE userId = $threadUser";
            $result_2 = mysqli_query($conn, $sql_2);
            $row_2 = mysqli_fetch_assoc($result_2);
            $userName = $row_2['userName'];

            echo '<div class="container my-3 py-3 shadow p-3 mb-5 bg-white rounded">
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-6">' . $threadtitle . '</h1>
                            <p class="lead">' . $threaddescription . '</p>
                            <p>Asked By : ' . $userName . '<p>
                        </div>
                    </div>
                </div>';
         ?>

        <!-- COMMENT FORM -->
        <?php 
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
            $userName = $_SESSION['userEmail'];
            $sql = "SELECT userId FROM `users931` WHERE userEmail='$userName'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $userId = $row['userId'];

            echo '<div class="container">
                <h3 class="my-3">Post a Comment</h3>
                <form action="threadInsert.php" method="post">
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Solve the Problem</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="comment" rows="3"></textarea>
                        <input type="hidden" class="form-control" id="exampleFormControlInput" value="'.$userId.'" name="userId">
                        <input type="hidden" class="form-control" id="exampleThreadId" value="'.$_GET['threadId'].'" name="threadId">
                    </div>
                    <button type="submit" class="btn btn-success">Post</button>
                </form>
            </div>';
        } else {
            echo '<div class="container">
            <h3 class="my-3">Post a Comment</h3>
            <p class="lead">Please Login to Post Comment</p>
            </div>';
        }
        
    ?>

        <div class="container">
            <h4 class="my-3">Comments</h4>
            <!-- MEDIA OBJECT -->
            <?php
            $noResult = true;
            $threadId = $_GET['threadId'];
            $sql = "SELECT * FROM `comments` WHERE threadId = $threadId";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $noResult = false;
                $commentContent = $row['commentContent'];
                $commentContent = $row['commentContent'];
                $commentTime = $row['commentTime'];
                $threadUserId = $row['threadUserId'];

                $sql_2 = "SELECT userName FROM `users931` WHERE userId=$threadUserId";
                $result_2 = mysqli_query($conn, $sql_2);
                $row_2 = mysqli_fetch_assoc($result_2);
                $userName = $row_2['userName'];

                echo '<div class="d-flex pt-1">
                <div class="flex-shrink-0">
                <img src="img/icons_male_user.png" width="35px" alt="icon">
                </div>
                <div style="max-width:80%;" class="flex-grow-1 ms-3">
                <p>'.$commentContent.'</p>
                </div>
                <h6>Replied By : '.$userName.'</h6>
                </div>
                <hr>';
            }

            if ($noResult == true) {
                echo '<div class="jumbotron jumbotron-fluid">
                <div class="container bg-light py-4 shadow p-3 mb-5 bg-white rounded">
                  <h1 class="display-4">No Comments Found</h1>
                  <p class="lead">Be the First Person to Comment</p>
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