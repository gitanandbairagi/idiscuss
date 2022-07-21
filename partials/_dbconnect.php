<?php
    // Connecting Database idiscuss
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "idiscuss";

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        echo "Database is not Connected. ERROR---> ". mysqli_connect_error($conn);
    }
    // else {
    //     echo "Database is Succesfully Connected";
    // }
?>