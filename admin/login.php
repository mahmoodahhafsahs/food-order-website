<?php include('../config/constant.php');?>
<html>
<head>
    
    <title>Document</title>
    <link rel="stylesheet" href="../admin.css">

</head>
<body>
<div class="kit1">

        <h1 class="text-center">LOGIN</h1>
        <br><br>
        <?php
        if(isset($_SESSION['login']))
          {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
          }

          if(isset($_SESSION['no-login-message']))
          {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
          }
          ?>
        <br><br>


        <form action="" method="POST" class="text-center">
            USERNAME:<br>
            <input type="text" name="username" placeholder="enter username"><br><br>
            PASSWORD:<br>
            <input type="password" name="password" placeholder="enter password"><br><br>
            <input type="submit" name="submit" value="login" class="btn-primary">
            <br><br>
</form>

            
        
    </div>
</body>
</html>
<?php
if(isset($_POST['submit']))
{
    $username=$_POST['username'];
    $password=$_POST['password'];

    $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    $res=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($res);
    if($count==1)
    {
        $_SESSION['login']="<div class='success text-center'>login success</div>";
        $_SESSION['user'] = $username;
        header('location:'.SITEURL.'admin/');
    }
    else{
        $_SESSION['login']="<div class='error text-center'>login failed</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

}




?>