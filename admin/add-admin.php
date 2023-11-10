<?php
include('partials/menu.php');
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>
        <?php
          if(isset($_SESSION['add']))
          {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
          }
          ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td>
                        <input type="text" placeholder="enter your name" name="full_name">
                    </td>
                </tr>

                <tr>
                    <td>Username</td>
                    <td>
                        <input type="text" placeholder="enter your username" name="username">
                    </td>
                </tr>

                <tr>
                    <td>Password</td>
                    <td>
                        <input type="password" placeholder="enter your password" name="password">
                    </td>
                </tr>

                <tr>
                    
                    <td colspan="2">
                        <input type="submit" value="Add Admin" name="submit" class="btn-secondary">
                    </td>
                </tr>


            </table>
        </form>   
    </div>
</div>
<?php
include('partials/footer.php');
?>
<?php
if(isset($_POST["submit"])){
     
     $full_name=$_POST["full_name"];
     $username=$_POST["username"];
     $password= $_POST["password"];

     $sql="INSERT INTO tbl_admin SET
        full_name='$full_name',
        username='$username',
        password='$password'
        ";


    
    $res=mysqli_query($conn,$sql) or die(mysqli_error($conn)); 
    if($res==TRUE){
       $_SESSION['add']="Admin added successfully";

       header("location:".SITEURL."admin/manage-admin.php");
    }
    else{
        $_SESSION['add']="Failed";

        header("location:".SITEURL."admin/add-admin.php");
    }  
}




?>