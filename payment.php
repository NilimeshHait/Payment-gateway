<?php
session_start();
if($_SESSION['user_card'])
{
    $user_card=$_SESSION['user_card'];
    $user_bank=$_SESSION['user_bank'];
}
else
{
    header('location:debit.php');
}
?>

<?php
    include('header.php');
?>
<div class="debitbody">
<form action="payment.php" method="POST">
    <label class="lb">Holder Bank Type:</label><br>
    <select name="bank_type" required class="inpbox">
        <option value="" disable selected hidden>Select bank type</option>
        <option value="sbi">SBI</option>
        <option value="allhb">ALLAHABAD BANK</option>
        <option value="ubi">UBI</option>
    </select>
    <br><br>
    <label class="lb">Holder Acc. Number<br>
    <input type="text" name="h_a_no" required class="inpbox">
    <br><br>
    <label class="lb">Amount:</label><br><input type="text" name="amount" required class="inpbox">
    <br><br>
    <label class="lb">Holder IFSC Code:</label><br><input type="text" name="ifsc" required class="inpbox">
    <br>
    <br>
    <input type="submit" name="getotp" value="Get OTP" class="btn">
    <br>

</form>
</div>
</body>
</html>

<?php

if(isset($_POST['getotp']))
{
    $banktype=$_POST['bank_type'];
    $holder_acc=$_POST['h_a_no'];
    $amount=$_POST['amount'];
    $ifsc=$_POST['ifsc'];
   include('dbcon.php');
   $qry="SELECT * FROM `$banktype` where `acc_no`='$holder_acc'";
    $run=mysqli_query($con,$qry);
    $row=mysqli_fetch_assoc($run);
    

    $qry1="SELECT * FROM card,$user_bank where card.acc_no=$user_bank.acc_no and card.card_no='$user_card'";
        $run1=mysqli_query($con,$qry1);
        
        $row1=mysqli_fetch_assoc($run1);
        $email=$row1['email'];
        $user_acc=$row1['acc_no'];
    if($row1['acc_no']===$holder_acc)
    {
        echo "No. need to transfer money !!";
    }
    else
    {
        if($row['acc_no']===$holder_acc and $row['ifsc_no']===$ifsc)
        {
            if($row1['balance']>=$amount)
            {
                $_SESSION['amount']=$amount;
                $_SESSION['email']=$email;
                $_SESSION['user_acc']=$user_acc;
                $_SESSION['holder_acc']=$holder_acc;
                $_SESSION['holder_bank']=$banktype;
                header('location:sendotp.php');
            }
            else
            {
                echo "Low Balance";
            }
        }
        else
        {
            echo "Holder Account no. or IFSC code Not valid ";
        }
    }
}

?>