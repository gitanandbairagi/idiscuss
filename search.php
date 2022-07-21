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
        <!-- SEARCH RESULT -->
        <div class="container my-4">
            <h4>Search Result for <em>"<?php echo $_GET['query'] ?>"</h4></em>
            <div class="result">
                <?php
                $noResult = true;
                $query = $_GET['query'];
                $sql = "SELECT * FROM threads WHERE MATCH (threadTitle, threadDescription) AGAINST ('$query')";
                $result = mysqli_query($conn, $sql);
                $i = 1;

                while($row = mysqli_fetch_assoc($result)) { 
                    $noResult = false;
                    $threadTitle = $row['threadTitle'];
                    $threadDescription = $row['threadDescription'];
                    $threadId = $row['threadId'];
                    $url = 'thread.php?threadId=' . $threadId;

                    echo '<div class="container mt-4">
                            <a href="' . $url . '" class="text-dark text-decoration-none">
                            <h5>' . $i . '. ' . $threadTitle . '</h5>
                            <p>' . $threadDescription . '.</p>
                            </a>
                        </div>';
                    $i++;
                }

                if ($noResult) {
                    echo '<div class="jumbotron jumbotron-fluid">
                            <div class="container bg-light py-4 shadow p-3 mb-5 bg-white rounded">
                              <h1 class="display-4">No Results Found</h1>
                              <p class="lead">Suggestions:<br>
                                <ul type="bullet">
                                    <li>Make sure that all words are spelled correctly.</li>
                                    <li>Try different keywords.</li>
                                    <li>Try more general keywords.</li>
                                </p>
                                </ul>
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