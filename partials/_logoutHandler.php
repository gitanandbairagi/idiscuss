<?php
    session_start();
    session_unset();
    session_destroy();
    echo "Logging You Out.....Please Wait......";
    header("location: ../index.php");
?>