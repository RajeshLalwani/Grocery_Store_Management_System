<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css?v=<?php echo time();?>">
    <style>

        body{
            height:100px;
            background:linear-gradient(to left,rgb(199,176,135),rgb(67,66,66));
            display:flex;
            justify-content:center;
            align-items:center;
            margin-top:300px;
        }
        .login-container{
            background:white;
            width:500px;
            display:flex;
            justify-content:center;
            align-items:center;
            border-radius:20px;
            box-shadow:-2px -2px 10px black;
            
        }
        .input{
            border-radius:20px;
            padding: 5px;
        }
        .b1{
            height:30px;
            margin:20px;
            border-radius:10px;
            color:white;
            background:black;
            border:none;
        }
        .b1:hover{
            color:black;
            background:white;
        }
    </style>
</head>

<body >



    
    <div class="login-container">
  

        <div class="login" align="center" >

            <div class="login-heading">
                <h1>Enter Delivery Address</h1><br >
            </div>
            <?php if(isset($_GET['error'])) {?>
             <p style="color: balck;"><?php echo $_GET['error'];?></p>
            <?php }?>
            <?php
                session_start();
                $sq=$_SESSION['pr'];

            ?>

            <div class="login-form">
                <table>
                    <td>
                    <form method="GET" action="up.php">
                        <input type="hidden" name="ed" value="<?php echo urlencode($sq); ?>">
                        <tr><h3>Phone Number:</h3><input class="input" type="textbox" name="n1" required></tr>
                        <tr><h3>Address:</h3>
                         <textarea class="input" name="n2"style="width:200px; padding:10px;" required></textarea> 
                         <br><br></tr>
                        <tr><input type="submit" value="Next page" class="bton b1" >
                        </form>
                        <a href="ordel.php?id=<?php echo $sq;?>"><button class="bttn1 b1">Cancel</button></a>  
                        </tr>
                    </td>
                </table>
            </div>
        </div>
    </div>




</body>

</html>

<?php
  session_start();
  $a=$_GET['ed'];
  $b=$_GET['n1'];
  $c=$_GET['n2'];
  $d=$_SESSION['name'];
  echo $a;
  echo $b;
  echo $c;
  echo $d;
  include('connect.php');
  $sql="UPDATE `order1` SET `address`='$c',`phone`='$b' WHERE `id`='$a' and `name`='$d'";
  $result=mysqli_query($con,$sql);
  header("Location: payment.php");
  exit();
?>