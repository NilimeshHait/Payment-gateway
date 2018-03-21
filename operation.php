<?php

    echo "processing...";
    include('dbcon.php');
    session_start();
    $user_card=$_SESSION['user_card'];
    $rs=$_SESSION['amount'];
    $user_bank=$_SESSION['user_bank'];
    $user_acc=$_SESSION['user_acc'];
    $holder_acc=$_SESSION['holder_acc'];
    $holder_bank=$_SESSION['holder_bank'];
    echo $user_acc;
    $qry="SELECT * FROM $user_bank where acc_no='$user_acc'";
    $run=mysqli_query($con,$qry);
    $row=mysqli_fetch_assoc($run);
    
    $user_rs=$row['balance'];
    $user_rs=$user_rs-$rs;

  $qry3="update $user_bank set balance=$user_rs where acc_no='$user_acc'";
  $run3=mysqli_query($con,$qry3);

  $qry1="SELECT * FROM  $holder_bank where acc_no='$holder_acc'";
   $run1=mysqli_query($con,$qry1);
   $row1=mysqli_fetch_assoc($run1);
   $holder_rs=$row1['balance'];
   $holder_rs=$holder_rs+$rs;

  $qry4="update $holder_bank set balance=$holder_rs where acc_no='$holder_acc'";
  $run4=mysqli_query($con,$qry4);

  session_destroy();
  header('location:debit.php');
?>  