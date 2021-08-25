<html>

<head>
    <title> Reported Students 2021 </title>
    <link rel="stylesheet" type="text/css" href="log4.css">
    <style>
        img {
            border-radius: 15%;
        }
    </style>
</head>

<body style="background-color:powderblue; font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-size:110%;">
    <?php
    session_start();

    if (isset($_SESSION['IS_AUTHENTICATED']) && $_SESSION['IS_AUTHENTICATED'] == 1)
{
    
    if (isset($_POST['submit'])) 
    {

        #add code for validation of the year and course chose 
        #add code for checking double entry using roll number
        # add code for last entry
        $submit = $_POST['submit'];



        $link = mysqli_connect('localhost', 'root', '');
        if (!$link) {
            die('<center>Failed to connect to server. <br>Please contact the System Administrator <a href="mailto:2019221@iiitdmj.ac.in"> via email</a> or <a href="tel:+917088481818">via Telephone</a></center>' . mysqli_error($link));
        }


        $db = mysqli_select_db($link, 'dbms_project');
        if (!$db) {
            die('Unable to selct database.<br>Please contact the System Administrator <a href="mailto:2019221@iiitdmj.ac.in"> via email</a> or <a href="tel:+917088481818">via Telephone</a></center>' . mysqli_error($link));
        }




        $query = "SELECT Course, Reported, Positive, Report, LDOR FROM Stats";
        $results = mysqli_query($link, $query);

        if ($results == FALSE
        ) {
            echo 'Unable to execute query.<br>Please contact the System Administrator <a href="mailto:2019221@iiitdmj.ac.in"> via email</a> or <a href="tel:+917088481818">via Telephone </a>: </center>' . mysqli_error($link);
        } else {
            while ($row = mysqli_fetch_assoc($results)) {
                if ($row['Course'] == 'B.TECH') {
                    $btech = $row['Reported'];
                    $bpositive = $row['Positive'];
                    $breport = $row['Report'];
                }

                if ($row['Course'] == 'M.TECH'
                ) {
                    $mtech = $row['Reported'];
                    $mpositive = $row['Positive'];
                    $mreport = $row['Report'];
                }

                if ($row['Course'] == 'Phd'
                ) {
                    $phd = $row['Reported'];
                    $ppositive = $row['Positive'];
                    $preport = $row['Report'];
                }
            }
            
        }
        







        if($_POST['submit'] == 'reported')
        {

            $query = "SELECT Roll_No, Name, Course, Year, City, State, DOR FROM Students_reported ORDER BY course, year asc, Roll_no asc ";
            $table_name = "THE REPORTED STUDENTS";
        }
        if($_POST['submit'] == 'covid')
        {
            $query =
            "SELECT Roll_No, Name, Course, Year, City, State, DOR FROM covid_positive ORDER BY course, year asc, Roll_no asc ";
            $table_name = "STUDENTS TESTED POSITTIVE";
        }
        if($_POST['submit'] == 'covidf')
        {
            $query =
            "SELECT Roll_No, Name, Course, Year, City, State, DOR FROM covid_fam ORDER BY course, year asc, Roll_no asc ";
            $table_name = "STUDENTS BEEN IN DIRECT CONTACT WITH COVID-19 CARRIERS";
        }
        if($_POST['submit'] == 'covidreport')
        {
            $query =
            "SELECT Roll_No, Name, Course, Year, City, State, DOR FROM covid_report ORDER BY course, year asc, Roll_no asc ";
            $table_name = "STUDENTS WITH COVID-19 NEGATIVE REPORT";
        }
        

        $results = mysqli_query($link, $query);

        if ($results == FALSE) {
            echo 'Unable to execute query.<br>Please contact the System Administrator <a href="mailto:2019221@iiitdmj.ac.in"> via email</a> or <a href="tel:+917088481818">via Telephone </a>: </center>' . mysqli_error($link);
        } else {
            include('home.html');
            echo '<table align="center"  style="background-color:powderblue;">
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
        </table>';

            if ($_POST['submit'] == 'reported') {

                echo '<marquee width="100%" direction="LEFT" height="15" behavior="alternate" scrollamount="4">
                            <span style=" font-size: 80%; color:red;">B.TECH: ' . $btech . '   &nbsp;&nbsp;M.TECH: ' . $mtech . '   &nbsp;&nbsp;PHD: ' . $phd . '</span>
                        </marquee>';
            }

            if ($_POST['submit'] == 'covid') {

                echo '<marquee width="100%" direction="LEFT" height="15" behavior="alternate" scrollamount="4">
                            <span style=" font-size: 80%; color:red;">B.TECH: ' . $bpositive . '   &nbsp;&nbsp;M.TECH: ' . $mpositive . '   &nbsp;&nbsp;PHD: ' . $ppositive . '</span>
                        </marquee>';
            }

            if ($_POST['submit'] == 'covidreport') {

                echo '<marquee width="100%" direction="LEFT" height="15" behavior="alternate" scrollamount="4">
                            <span style=" font-size: 80%; color:red;">B.TECH: ' . $breport . '   &nbsp;&nbsp;M.TECH: ' . $mreport . '   &nbsp;&nbsp;PHD: ' . $preport . '</span>
                        </marquee>';
            }

            
            
        echo '<hr>
        <hr>';

        echo '<div class="box4"><center><h2>'. $table_name.'</h2></center>';

        echo '<table align="center" style="font-size:80%; background-color:white; border-radius:10px;" >
        <tr>
            <th>Roll No.</th>
            <th>Name</th>
            <th>Course</th>
            <th>Year</th>
            <th>City</th>
            <th>State</th>
            <th>Date Of Reporting</th>
        </tr>';

            while ($row = mysqli_fetch_assoc($results))
            { 
                    echo '<tr> 

                    <td>'.$row['Roll_No'].'</td>
                    <td>'.$row['Name'].'</td>
                    <td>'.$row['Course']. '</td>
                    <td>' . $row['Year'] . '</td>
                    <td>' . $row['City'] . '</td>
                    <td>' . $row['State'] . '</td> 
                    <td>' . $row['DOR'] . '</td>   
                    </tr></div>'; 
            }

            
        }
    }
    else{
        header('location:incampus_main.php');
        $_SESSION['select_view']=1;
    }
}
else{
    header('location:entry.php');
    exit();
}
    ?>
</body>

</html>