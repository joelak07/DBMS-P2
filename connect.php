<?php
    define('HOST','localhost');
    define('USERNAME','root');
    define('PASSWORD','');
    define('DB_NAME','np');

    $conn = mysqli_connect(HOST, USERNAME, PASSWORD) or die(mysqli_error());
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
?>