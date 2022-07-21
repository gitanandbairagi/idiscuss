<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        require '_dbconnect.php';
        $loginEmail = $_POST['loginEmail']; 
        $loginPassword = $_POST['loginPassword'];
        
        $sql = "SELECT * FROM `users931` WHERE userEmail='$loginEmail'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $num = mysqli_num_rows($result);
        if ($num == 1) {
            $passwordHash = password_hash($loginPassword, PASSWORD_DEFAULT);
            if (password_verify($loginPassword, $row['userPassword'])) {
                session_start();
                $_SESSION['loggedIn'] = true;
                $_SESSION['userName'] = $row['userName'];
                $_SESSION['userEmail'] = $row['userEmail'];
                $_SESSION['userId'] = $row['userId'];
                header("location: ../index.php");
            }
            else {
                $showError = "Password is Incorrect. Please Try Again";
                header("location: ../index.php?showError=$showError");
            }
        }
        else {
            $showError = "Oops, User Already Exits or Incorrect Email. Please Try Again";
            header("location: ../index.php?showError=$showError");
        }
    }
?>