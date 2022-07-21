<?php
    require 'partials/_dbConnect.php';
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // INSERTING COMMENT INTO THE DATABASE
        $comment = $_POST['comment'];
        $comment = str_replace("<", "&lt", $comment);
        $comment = str_replace(">", "&gt", $comment);
        $threadId = $_POST['threadId'];
        $threadUserId = $_POST['userId'];
        $sql = "INSERT INTO `comments` (`commentContent`, `threadId`, `commentTime`, `threadUserId`) VALUES('$comment', $threadId, current_timestamp(), $threadUserId);";
        // $result = mysqli_query($conn, $sql);
        $result = mysqli_query($conn, $sql);
        header("location: thread.php?result=$result&threadId=$threadId");
        exit;
    }
?>