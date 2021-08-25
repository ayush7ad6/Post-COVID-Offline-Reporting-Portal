<html>

<head>
    <title> Welcome </title>
    <link rel="stylesheet" type="text/css" href="log4.css">
    <style>
        img {
            border-radius: 15%;
        }
    </style>
</head>

<body style="background-color:powderblue; font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-size:110%;">
    <?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Load Composer's autoloader
    require 'vendor/autoload.php';
    session_start();
    $_SESSION['already_registered'] = 0;
    if (isset($_SESSION['IS_AUTHENTICATED']) && $_SESSION['IS_AUTHENTICATED'] == 1)
    {
        
        if (isset($_POST['submit'])) 
        {

            #add code for validation of the year and course chose 
            #add code for checking double entry using roll number
            # add code for last entry
            $name = $_POST['name'];
            $rno = $_POST['rno'];
            $course = $_POST['course'];
            $year = $_POST['year'];
            $city = $_POST['city'];
            $state = $_POST['stt'];
            $covid = $_POST['covid'];
            $covidf = $_POST['covidf'];
            $covid_report = $_POST['covidreport'];
            date_default_timezone_set("Asia/Calcutta");
            $dor = date("d-m-Y h:i:sa");
            $email = $rno . '@iiitdmj.ac.in';



            $link = mysqli_connect('localhost', 'root', '');
            if (!$link) {
                die('<center>Failed to connect to server. <br>Please contact the System Administrator <a href="mailto:2019221@iiitdmj.ac.in"> via email</a> or <a href="tel:+917088481818">via Telephone</a></center>' . mysqli_error($link));
            }


            $db = mysqli_select_db($link, 'dbms_project');
            if (!$db) {
                die('Unable to selct database.<br>Please contact the System Administrator <a href="mailto:2019221@iiitdmj.ac.in"> via email</a> or <a href="tel:+917088481818">via Telephone</a></center>' . mysqli_error($link));
            }

            $query = "INSERT INTO Students_reported (Roll_No, Name, Course, year, city, state, DOR, covid_pos, fam_covid, covid_report) VALUES ('$rno', '$name', '$course', '$year', '$city', '$state', '$dor', '$covid', '$covidf', '$covid_report')";

            $results = mysqli_query($link, $query);
            if ($results == FALSE) {
                /* echo 'Unable to selct database.<br>Please contact the System Administrator <a href="mailto:2019221@iiitdmj.ac.in"> via email</a> or <a href="tel:+917088481818">via Telephone </a></center>' . mysqli_error($link); */
                /* echo '<script>alert("You are already registered")</script>';
                include('home.html'); */
                header('location:entry.php');
                
                
                $_SESSION['already_registered'] = 1;
            } else {
                include('home.html');

                echo '<table align="center">
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
                echo '<marquee width="100%" direction="LEFT" height="15" behavior="alternate" scrollamount="5">
                        <span style=" font-size: 80%; color:red;">NOTE FROM THE DIRECTOR: Maintain Social Distancing & Keep Wearing Masks, GOOD LUCK</span>
                    </marquee>';
                echo '<hr>
            <hr>';

                if ($year == 'I') {
                    echo '<div class = "box"><center> <h2>WELCOME <span style="color:red;">' . $name . ',</span></h2><br>';
                    echo 'Hope you have great time here in this Institute Of National Importance</center><br><br>';
                    echo '<center>Based on the <u> Health Care Registration Form</u> filled, you will receive an email on your registered email address <u>' . $email . '</u></center></div>';
                } else {
                    echo '<div class = "box"><center> <h2>WELCOME back <span style="color:red;">' . $name . ',</span></h2><br>';
                    echo 'Hope you & your loved ones stay safe amid the pandemic.</center><br><br>';
                    echo '<center>Based on the <u> Health Care Registration Form</u> filled, you will receive an email on your registered email address <u>' . $email . '</u></center></div>';
                }
                #PHP MAILER PROGRAM


                // Instantiation and passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    #$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                    $mail->isSMTP();                                            // Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                    $mail->Username   = 'thenarci001@gmail.com';                     // SMTP username
                    $mail->Password   = 'probe1010';                               // SMTP password
                    $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                    //Recipients
                    $mail->setFrom('thenarci001@gmail.com', '2019221_AYUSH_DUBEY_PROJECT');
                    $mail->addAddress($email);     // Add a recipient
                    // Name is optional


                    if ($covid_report == 'YES' || ($covid == 'NO' && $covidf == 'NO')) {
                        //body for students with negative report or who never tested positive and neither their family members
                        $body = 'Dear ' . $name . ',<br>Your HealthCare PASS is ready:<br><center><h2>HealthCare PASS</h2><br><table border="1" cellpadding = "20%">
                        <tr>
                        <td>Roll No.</td>
                        <td>' . $rno . '</td>
                        </tr>
                        <tr>
                        <td>Name</td>
                        <td>' . $name . '</td>
                        </tr>
                        <tr>
                        <td>Status</td>
                        <td><span style="color:green;">COMPLETED</span></td>
                        </tr>
                        </table></center><br>STAY SAFE, MAINTAIN SOCIAL DISTANCING & WEAR MASKS!';
                    }


                    if ($covid_report == 'NO' && ($covid == 'YES' || $covidf == 'YES')) {

                        //body for stuents with no negative report but tested positive or their family member(s) testes positive
                        $body = 'Dear ' . $name . ',<br>Your HealthCare PASS is ready:<br><br><center><h2>HealthCare PASS</h2><br><table border="1" cellpadding = "20%">
                        <tr>
                        <td>Roll No.</td>
                        <td>' . $rno . '</td>
                        </tr>
                        <tr>
                        <td>Name</td>
                        <td>' . $name . '</td>
                        </tr>
                        <tr>
                        <td>Status</td>
                        <td><span style="color:red;">NEED NEGATIVE REPORT</span></td>
                        </tr>
                        </table></center><br>You are required to carry a COVID-19 negative report to stay in the campus.<br> Once done, you may contact phc@iiitdmj.ac.in<br>STAY SAFE, MAINTAIN SOCIAL DISTANCING & WEAR MASKS!';
                    }





                    // Content
                    $mail->isHTML(true); // Set email format to HTML
                    $mail->Subject = 'HealthCare PASS';
                    $mail->Body = $body;
                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    $mail->send();
                    #echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }


                echo '<br><div class="box3"> <center> Find the Post-COVID Protocols to be followed by every member of PDPM IIITDMJ <a href="protocols.txt" download><span style="color:red;">here</span></a></center></div>';




                //verification snippet for email
                #verification mail snippet

                // Instantiation and passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    #$mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
                    $mail->isSMTP(); // Send using SMTP
                    $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
                    $mail->SMTPAuth = true; // Enable SMTP authentication
                    $mail->Username = 'thenarci001@gmail.com'; // SMTP username
                    $mail->Password = 'probe1010'; // SMTP password
                    $mail->SMTPSecure = 'tls'; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                    $mail->Port = 587; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                    //Recipients
                    $mail->setFrom('thenarci001@gmail.com', '2019221_Project');
                    $mail->addAddress($email); // Add a recipient
                    // Name is optional




                    // Content
                    $mail->isHTML(true); // Set email format to HTML
                    $mail->Subject = 'Registration Verification';
                    $mail->Body = '<h1>HealthCare Registration Successful!</h1>';
                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    $mail->send();
                    #echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
        }
        else
        {
            header('location:registration.php');
            $_SESSION['no_form']=1;
            exit();
        }
    }
    else
    {
        header('location:entry.php');
        exit();
    }
    ?>
</body>

</html>