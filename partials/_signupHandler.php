<?php 
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        require '_dbconnect.php';
        $showError = "false";
        $showAlert = "false";
        $fullName = $_POST['fullName'];
        $signupEmail = $_POST['signupEmail'];
        $password = $_POST['signupPassword'];
        $cpassword = $_POST['cpassword'];
        
        // CHECKING USER EXISTANCE
        $sql = "SELECT * FROM `users931` WHERE userEmail = '$signupEmail'";
        $result = mysqli_query($conn, $sql);
        $numRows = mysqli_num_rows($result);
        if ($numRows == 1) {
            $showError = "Account Exits. Try Different Email";
            header("location: ../index.php?showError=$showError");
        }
        else {
            if ($password == $cpassword) {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users931` (`userEmail`, `userName`, `userPassword`) VALUES ('$signupEmail', '$fullName', '$passwordHash')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    header("location: /forum/index.php?showAlert=true");
                }
            }
            else {
                $showError = "Passwords do not Match";
                header("location: ../index.php?showError=$showError");
            }
        }

    }
?>