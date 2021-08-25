<?php
include('home.html');
session_start();
if (!isset($_SESSION['IS_AUTHENTICATED']) || $_SESSION['IS_AUTHENTICATED'] != 1) {
    header('location:entry.php');
}
if (@$_SESSION['select_view'] == 1) {
    echo '<script> alert(" Please Select A Option")</script>';
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="log3.css">
    <style>
        img {
            border-radius: 15%;
        }
    </style>
    <title> Physical Reporting 2021</title>
</head>

<body style="background-color:powderblue; font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-size:110%;">

    <table align="center">
        <tr>
            <td>
                <img src="image.jpg" height="100px" width="100px">
            </td>
            <td>
                <h2 style="text-align: center;">Pt. Dwarka Prasad Mishra
                    Indian Institute of Information Technology,
                    Design & Manufacturing, Jabalpur <br>
                    (An Institute of National Importance established by an Act of Parliament)
                </h2>
            </td>
        </tr>
    </table>

    <marquee width="100%" direction="LEFT" height="15" behavior="alternate" scrollamount="4">
        <span style=" font-size: 80%; color:red;">YOU CAN VERIFY YOUR REGISTRAION STATUS FROM HERE ALSO</span>
    </marquee>

    <hr>
    <hr>





    <div class="box" style="text-align: center;">


        <form action="view_students.php" method="POST">
            <button type="submit" name="submit" value="reported">View All Students Reported</button>

            <br><br><br>


            <button type="submit" name="submit" value="covid">View All Students Who Tested CORONA positive</button>

            <br><br><br>





            <button type="submit" name="submit" value="covidf">View All Students Whose Family Member(s) Tested Positive</button>

            <br><br><br>





            <button type="submit" name="submit" value="covidreport">View All Students Who Have CORONA Negative Report</button>
            <br><br><br>
        </form>

    </div>

    <!--find a student status-->


</body>

</html>