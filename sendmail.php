<?php
 $to=$email;
 $subject="OTP";  
 $message="1258";  
 $header='From: NIIR-OTP';  

 $result=mail($to,$subject,$message,$header);  

 if( $result==true ){  
    echo "Message sent successfully...";  
 }else{  
    echo "Sorry, unable to send mail...";  
 } 
 
 ?>
