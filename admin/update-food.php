<?php
 include('partials/menu.php');
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>
        <?php
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
            $sql2="SELECT * FROM tbl_food WHERE id=$id";
            $res2=mysqli_query($conn,$sql2);
            
            
               $row2=mysqli_fetch_assoc($res2);
               $title=$row2['title'];
               $description=$row2['description'];
               $price=$row2['price'];
               $current_image=$row2['image_name'];
               $current_category=$row2['category_id'];
               $featured=$row2['featured'];
               $active=$row2['active'];
           

        }
        else
        {
            header('location:'.SITEURL.'admin/mange-food.php');
        }
        ?>
        
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>title</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr> 
                <tr>
                    <td>description</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" ><?php echo $description; ?></textarea>
                    </td>
                </tr> 
                <tr>
                    <td>price</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr> 
                
                

                <tr>
                    <td>current image</td>
                    <td>
                     <?php
                     if($current_image=="")
                     {
                        echo"<div class='error'>image no available</div>";

                     }
                     else
                     {
                        ?>
                        <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image;?>" width="100px">
                        <?php
                     }
                     ?>
                    </td>
                </tr> 

                <tr>
                    <td>new image</td>
                    <td>
                    <input type="file" name="image" value="">
                    </td>
                </tr> 
                <tr>
                    <td>category</td>
                    <td>
                        <select name="category">
                            <?php
                            $sql="SELECT * FROM tbl_category WHERE active='Yes'";
                            $res=mysqli_query($conn,$sql);
                            $count=mysqli_num_rows($res);
                            if($count>0)
                            {
                              while($row=mysqli_fetch_assoc($res))
                              {
                                $category_title=$row['title'];
                                $category_id=$row['id'];
                                ?>
                               <option <?php if($current_category==$category_id){echo "selected";}?> value="<?php echo $category_id;?>"><?php echo $category_title;?></option>
                            <?php  
                            }
                            }
                            else
                            {
                                echo "<option value='0'>category no available</option>";
                            }
                            ?>
                       
                    </select>
                    </td>
                </tr> 

                <tr>
                    <td>Featured</td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" value="Yes" name="featured" >Yes
                        <input <?php if($featured=="No"){echo "checked";}?> type="radio" value="No" name="featured">No
                    </td>
                </tr>

                <tr>
                    <td>active</td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";}?> type="radio" value="Yes" name="active" >Yes
                        <input <?php if($active=="No"){echo "checked";}?> type="radio" value="No" name="active">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                    <input type="hidden" name="curret_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update category" class="btn-secondary">
                    </td>
                
                </tr>
</table>
</form>  
<?php 
 if(isset($_POST['submit']))
 {
    $id=$_POST['id'];
    $title=$_POST['title'];
    
    $description=$_POST['description'];
    
    $price=$_POST['price'];
    
    $current_image=$_POST['image'];
    
    $category=$_POST['category'];
    
    $featured=$_POST['featured'];
    $active=$_POST['active'];
    if(isset($_FILES['image']['name']))
    {
        $image_name=$_FILES['image']['name'];
        if($image_name!="")
        {
            $ext=end(explode('.',$image_name));
            $image_name="Food-Name-".rand(0000,9999).'.'.$ext;
            $src_path=$_FILES['image']['tmp_name'];
            $dest_path="../images/food/".$image_name;
            $upload=move_uploaded_file($src_path,$dest_path);
            if($upload==false)
            {
                $_SESSION['upload']="<div class='error'>failed</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                die();
            
            }
            if($current_image!="")
            {
                $remove_path="../image/food".$current_image;
                $remove=unlink($remove_path);
                if($remove==false)
                {
                    $_SESSION['remove-failed']="<div class='error'>failed</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                    die();  
                }
            }
        }
        else
        {
            $image_name=$current_image;
        }
    }
    else
    {
        $image_name=$current_image;
    }
    $sql3="UPDATE tbl_food SET 
    title='$title',
    description='$description',
    price=$price,
    image_name='$image_name',
    category_id='$category',
    featured='$featured',
    active='$active'
    WHERE id=$id
    ";
    $res3=mysqli_query($conn,$sql3);
    if($res3==true)
    {
        $_SESSION['update']="<div class='error'>failed</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
    }
    else
    {
        $_SESSION['update']="<div class='error'>failed</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
    }
    
    
 }
?>

</div>
</div>


<?php include('partials/footer.php');?>