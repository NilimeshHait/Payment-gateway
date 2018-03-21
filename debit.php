
<?php
    include('header.php');
?>
<?php
if(isset($_POST['payment']))
{
    session_start();
    $code=$_SESSION['cap_no'];
   
    $cap=$_POST['captcha'];
    if($code===$cap)
    {
        include('dbcon.php');
        $cardno=$_POST['card_no'];
        $edate=$_POST['edate'];
        $cvc=$_POST['cvc/cvv'];

        $qry="SELECT * FROM `card` where `card_no`='$cardno'";
       $run=mysqli_query($con,$qry);

       $row=mysqli_fetch_assoc($run);
       if($row['exp_date']===$edate and $row['cvv_cvc']===$cvc)
       {
           session_destroy();
           session_start();
           $_SESSION['user_card']=$row['card_no'];
           $_SESSION['user_bank']=$row['bank'];
           header('location:payment.php');
       }
       else
       {?>
       <center>
        <font color="red">
           Enter correct details...!!!
           </font>
        </center>
        <?php
       }

    }
    else
    {?>
    <center>
        <font color="red">
            Invalid Captcha...!!!
        </font>
    </center>
    <?php
    }
}

?>
    
</body>
</html>
    <div class="debitbody">
    <form action="debit.php" method="post">
        <label class="lb">Card No:</label><br>
        <input type="text" name="card_no" placeholder="Enter your card no." required class="inpbox"><br>
        <label class="lb">Expiration Date:</label><br>
        <input type="date" name="edate" required class="inpbox">
        <br></br>
        <label class="lb">CVV/CVC:</label><br>
        <input type="text" name="cvc/cvv" required class="inpbox" placeholder="Enter cvc/cvv Code..."><br><br>
        <label class="lb">Captcha:</label><br>
        <input type="text" name="captcha" required class="inpbox"  placeholder="Enter Bellow Captcha code...">
        <br><br>
        
        <img src="captcha.php" style="margin-left:150px">
        <br><br>
        <input type="submit" value="Make payment" name="payment" class="btn">
    </form>
   <div> 
</body>
</html>