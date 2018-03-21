<?php

    $rand=md5(microtime());
    $rand=substr($rand,20,4);
    //session_start();
    $_SESSION['otp']=$rand;

?>