<?php
session_start();
if (isset($_SESSION['IS_AUTHENTICATED']) && $_SESSION['IS_AUTHENTICATED'] == 1) {
    header('location:entry.php');
    if($_POST['submit']== 'Physical Reporting 2021')
    {
        /* session_start(); */
        $_SESSION['submit'] = 'PR';
        header("location: registration.php");
    }
    if ($_POST['submit'] == 'Students In-Campus')
    {
        /* session_start(); */
        //$_SESSION['IS_AUTHENTICATED'] = 1;
        $_SESSION['submit'] = 'SIC';
        header("location: incampus_main.php");    
    }
}
else{
    header('location:entry.php');
}
