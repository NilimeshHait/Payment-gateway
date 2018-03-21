<?php
    
    if(isset($_POST['pay']))
    {
        session_start();
        $otp=$_POST['otp'];

        if($otp===$_SESSION['otp'])
        {
            unset($_SESSION['otp']);
            header('location:operation.php');
        }
        else
        {
            echo "invalid otp";
            $rs=$_SESSION['amount'];
            $_SESSION['otp']=1;
            goto continu;
        }
    }
?>
<?php
session_start();

if( $_SESSION['user_card'])
{
    $user_card=$_SESSION['user_card'];
    $user_bank=$_SESSION['user_bank'];
    $rs=$_SESSION['amount'];
    $email=$_SESSION['email'];
    
    
    include('otpgenaration.php');
    //sending mail for otp ..........
    

    $to=$email;
    $subject="OTP";  
    $message="Your One Time Password is " .$_SESSION['otp'] . " Don't Share With Others";  
    $header='From: NILR-I';  

    $result=mail($to,$subject,$message,$header);  

    if( $result==true )
    {  
        echo "OTP Successfully send to your registerd email id";  
        
    }
    else
    {  
        echo "Sorry, unable to send mail...";  
    } 


    
}
?>


<?php
continu:
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>otp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>


    <center>
        <font size="18" >
            <?php
                echo "Amount " .$rs;
            ?>
        </font>
        <form method="POST" action="sendotp.php">
            OTP <input type="text" placeholder="Enter OTP" required name="otp">
            <br><br>
            <input type="submit" value="Make Payment" name="pay">
            <br>

        <form>
        <a href="sendotp.php">Resend OTP</a>
    </center>
</body>
</html>

