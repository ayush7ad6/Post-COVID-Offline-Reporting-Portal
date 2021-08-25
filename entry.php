<?php include 'home.html' ?>
<?php
    session_start();
    $_SESSION['IS_AUTHENTICATED'] = 1;
    $_SESSION['entry']=0;
    if(@$_SESSION['already_registered']==1)
    {
        echo '<script> alert("You are already registered")</script>';
        $_SESSION['already_registered'] = 0;
    }
?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="log2.css">
    <title>Physical Reporting Portal 2021</title>
    <style>
        img {
            border-radius: 15%;
        }
    </style>
    <style>
        /* Popup container - can be anything you want */
        .popup {
            position: relative;
            display: inline-block;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* The actual popup */
        .popup .popuptext {
            visibility: hidden;
            width: 160px;
            background-color: #555;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 8px 0;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            margin-left: -80px;
        }

        /* Popup arrow */
        .popup .popuptext::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #555 transparent transparent transparent;
        }

        /* Toggle this class - hide and show the popup */
        .popup .show {
            visibility: visible;
            -webkit-animation: fadeIn 1s;
            animation: fadeIn 1s;
        }

        /* Add animation (fade in the popup) */
        @-webkit-keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
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
        <span style=" font-size: 80%; color:red;">THIS IS THE HEALTHCARE REGISTRATION PORTAL COMPULSORY FOR EVERY STUDENT REPORTING</span>
    </marquee>
    <hr>
    <hr>


    <div class="box">
        <!--<h3 style="text-align: center;"> Fill the details below carefully. </h3>-->
        <table style="font-size: 20px;">
            <tr>
                <td>
                    i.<br><br>
                </td>
                <td>
                    <br>New students should register to the PHC Office through the follow-up form in order to complete the process of physical reporting.
                </td>
            </tr>

            <tr>
                <td>
                    ii.<br><br>
                </td>
                <td>
                    <br>After successful registration, every eligible student will receive a <span style="color:green;">
                        <div class="popup" onclick="myFunction()"><u>HealthCare PASS</u>
                            <span class="popuptext" id="myPopup" style="font-size: 15px;">Certification To Stay In The Campus</span>
                        </div>
                        <script>
                            // When the user clicks on div, open the popup
                            function myFunction() {
                                var popup = document.getElementById("myPopup");
                                popup.classList.toggle("show");
                            }
                        </script>
                    </span> along with further instructions via email.
                </td>
            </tr>

            <tr>
                <td>
                    iii.<br>
                </td>
                <td>
                    <br>Registration Verification will be done through email after successful registration.
                </td>
            </tr>

        </table>
        <br><br>

        <form method="post" ; action="entrycheck.php">
            <center><br>
                <input type="submit" name="submit" value="Physical Reporting 2021">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" name="submit" value="Students In-Campus">
            </center>
        </form>


        <!--php display for count-->
        <?php
        
        $link = mysqli_connect('localhost', 'root', '');
        if (!$link) {
            die('<center>Failed to connect to server. <br>Please contact the System Administrator <a href="mailto:2019221@iiitdmj.ac.in"> via email</a> or <a href="tel:+917088481818">via Telephone</a></center>' . mysqli_error($link));
        }


        $db = mysqli_select_db($link, 'dbms_project');
        if (!$db) {
            die('Unable to selct database.<br>Please contact the System Administrator <a href="mailto:2019221@iiitdmj.ac.in"> via email</a> or <a href="tel:+917088481818">via Telephone</a></center>' . mysqli_error($link));
        }
         $query1 = "UPDATE Stats, Students_Reported
SET Reported = (
				SELECT count(Roll_No)
				FROM Students_Reported
				WHERE Students_Reported.Course = Stats.Course
				)";
				
				
        $query2="UPDATE Stats, Students_Reported
SET Positive = (
				SELECT count(Roll_No)
				FROM Students_Reported
				WHERE Students_Reported.Course = Stats.Course AND Students_Reported.COVID_POS = 'YES'
				)";
				
				
        $query3 = "UPDATE Stats, Students_Reported
SET Report = (
				SELECT count(Roll_No)
				FROM Students_Reported
				WHERE Students_Reported.Course = Stats.Course AND Students_Reported.COVID_REPORT = 'YES'
				)";

            $query4 = "UPDATE Stats, Students_Reported
SET LDOR = (
				SELECT max(DOR)
				FROM Students_Reported
				WHERE Students_Reported.Course = Stats.Course
				)";
        mysqli_query($link,$query1);
        mysqli_query($link, $query2);
        mysqli_query($link, $query3);
        mysqli_query($link, $query4);
        $query = "SELECT Course, Reported, Positive, Report, LDOR FROM Stats";
        $results = mysqli_query($link, $query);

        if ($results == FALSE) {
            echo 'Unable to execute query.<br>Please contact the System Administrator <a href="mailto:2019221@iiitdmj.ac.in"> via email</a> or <a href="tel:+917088481818">via Telephone </a>: </center>' . mysqli_error($link);
        } else {
            while ($row = mysqli_fetch_assoc($results)) {
                if ($row['Course'] == 'B.TECH') {
                    $btech = $row['Reported'];
                }

                if ($row['Course'] == 'M.TECH') {
                    $mtech = $row['Reported'];
                }

                if ($row['Course'] == 'Phd') {
                    $phd = $row['Reported'];
                }
                
            }

            //to display the last entry at
             $query_time = "SELECT max(DOR) FROM Students_Reported";
            $result_time = mysqli_query($link, $query_time);
            while ($row = mysqli_fetch_assoc($result_time))
            {
                echo '<div class="time">Last Entry on: '.$row['max(DOR)']. '</div>';
            } 






            echo '<div class="boxcount">
            Students Reported:<br><br>
            B.TECH: '.$btech. '<br>
            M.TECH: '.$mtech. ' 
            <br>PhD: '.$phd. '
            </div>';
        }


        ?>

</body>

</html>