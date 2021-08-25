<?php include 'home.html' ?>

<?php
    session_start();
    if (!isset($_SESSION['IS_AUTHENTICATED']) || $_SESSION['IS_AUTHENTICATED'] != 1)  
    {
        header('location:entry.php');
    }  
    if(@$_SESSION['no_form']==1)
    {
        echo '<script> alert("First Fill The Form Please")</script>';
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="cities.js"></script>

    <link rel="stylesheet" type="text/css" href="log.css">
    <title> Physical Reporting 2021 Registration</title>
</head>

<body style="background-color:powderblue; font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-size:110%;">

    <h2 style="background-color:powderblue; font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-size: 240%; text-align:center;"><b>
            PHYSICAL REPORTING 2021
        </b></h2>
    <marquee width="100%" direction="LEFT" height="15" behavior="alternate" scrollamount="4">
        <span style=" font-size: 80%; color:red;">FOR ANY QUERY CONTACT: <a href="mailto:phc@iiitdmj.ac.in">phc@iiitdmj.ac.in</a></span>
    </marquee>
    <hr>
    <hr>
    <div class="box">
        <img src="image.jpg" class="profile" height="100px" width="100px">

        <form action="register_student.php" method="post">

            <h2>
                <center>
                    HEALTH CARE<br>
                    <span style="font-size: 80%;">---- Registration Form ----</span>
                </center>
            </h2>
            <hr>
            <br><br>


            <!-- for roll number -->
            <label for="rno"><b>Roll No.<sup style="color:red">*</sup></b></label>&nbsp; &nbsp;
            <input type="number" name="rno" placeholder="Roll number" required="required">&nbsp; &nbsp;
            <br><br><br>




            <!-- for name -->
            <label for="name"><b>Name<sup style="color:red">*</sup></b></label>&nbsp; &nbsp;
            <input type="text" name="name" placeholder="Full Name" required="required" size="30">
            <br><br><br>



            <!-- for course -->
            <label for="course"><b>Course<sup style="color:red">*</sup></b></label>&nbsp; &nbsp;
            <input type="radio" name="course" id="B.TECH" value="B.TECH" required="required">
            <label for="B.TECH"> B.Tech </label>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;


            <input type="radio" name="course" id="M.Tech" value="M.Tech">
            <label for="M.Tech"> M.Tech </label>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;


            <input type="radio" name="course" id="Phd" value="Phd">
            <label for="Phd"> Phd </label>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;

            <br><br><br>



            <!-- for year -->
            <label for="year"><b>Year:<sup style="color:red">*</sup></b></label>&nbsp; &nbsp; &nbsp;
            <select id="year" name="year" required="required">
                <option value="none" selected>Select Year</option>
                <option value="I">First</option>
                <option value="II">Second</option>
                <option value="III">Third</option>
                <option value="IV">Fourth</option>
                <option value="IV+">Four+</option>
            </select>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <br><br><br>



            <!--for city-->
            <label for="sts"><b>Which City/State you are arriving from?<sup style="color:red">*</sup></b></label><br><br>

            <select onchange="print_city('state', this.selectedIndex);" id="sts" name="stt" class="form-control" required></select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <select name="city" id="state" class="form-control" required></select>
            <script language="javascript">
                print_state("sts");
            </script>
            <br><br><br>
            <hr>
            <br><br>


            <!-- if(isset($_POST['stt']))
                    echo $_POST['stt'];
                    echo "hello"; -->



            <!-- for covid status-->
            <label for="covid"><b>Have you ever tested CORONA positive?<sup style="color:red">*</sup></b></label>&nbsp; &nbsp;
            <br><br><br>
            <input type="radio" name="covid" id="YES" value="YES" required="required">
            <label for="YES"> Yes </label> &nbsp; &nbsp; &nbsp; &nbsp;

            <input type="radio" name="covid" id="NO" value="NO" required="required">
            <label for="NO"> No </label>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <br><br><br>

            <!--for family member-->
            <label for="covidf"><b>Has any family member of yours tested CORONA positive?<sup style="color:red">*</sup></b></label>&nbsp; &nbsp;
            <br><br><br>
            <input type="radio" name="covidf" id="YES" value="YES" required="required">
            <label for="YES"> Yes </label> &nbsp; &nbsp; &nbsp; &nbsp;


            <input type="radio" name="covidf" id="NO" value="NO" required="required">
            <label for="NO"> No </label>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <br><br><br>


            <!-- for covid report-->
            <label for="covidreport"><b>Do you have a CORONA negative report?<sup style="color:red">*</sup></b></label>&nbsp; &nbsp;
            <br><br><br>
            <input type="radio" name="covidreport" id="YES" value="YES" required="required">
            <label for="YES"> Yes </label> &nbsp; &nbsp; &nbsp; &nbsp;


            <input type="radio" name="covidreport" id="NO" value="NO" required="required">
            <label for="NO"> No </label>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <br><br><br>






            <hr>
            <br><br>
            <center>
                <label for=" submit"><strong style="font-size:120%;">Confirm Your Physical Reporting to PDPM IIITDMJ</strong></label><br><br>

                <button type="submit" name="submit" value=“submit" onclick="validate()">Confirm</button>
            </center>
        </form>

    </div>
    <script>
        alert("Please Fill The Form Carefully!")
    </script>

</body>

</html>