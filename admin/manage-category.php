<?php
   include('partials/menu.php');
   ?>
    <div class="main-content">
        <div class="wrapper">
            
         <h1>MANAGE CATEGORY</h1>
         <br/><br/>
         <?php
         if(isset($_SESSION['add']))
          {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
          }
          if(isset($_SESSION['remove']))
          {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
          }
          if(isset($_SESSION['delete']))
          {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
          }
          if(isset($_SESSION['no-category-found']))
          {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
          }
          if(isset($_SESSION['update']))
          {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
          }
          if(isset($_SESSION['upload']))
          {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
          }
          if(isset($_SESSION['failed-remove']))
          {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
          }
          ?>
         <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Category</a>
         <br/><br/><br/>
         <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>title</th>
                <th>image name</th>
                <th>featured</th>
                <th>active</th>
            </tr>
         <?php
           $sql="SELECT * FROM tbl_category";
           $res=mysqli_query($conn,$sql);
           if($res==TRUE)
           {
            $count=mysqli_num_rows($res);
            $sn=1;

            if($count>0)
            {
                while($rows=mysqli_fetch_assoc($res))
            {
             $id=$rows['id'];
             $title=$rows['title'];
             $image_name=$rows['image_name'];
             $featured=$rows['featured'];
             $active=$rows['active'];





            ?>
            <tr>
                <td><?php echo $sn++ ?></td>
                <td><?php echo $title?></td>
                <td>
                    <?php
                    if($image_name!="")
                    {
                        ?>
                        <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" width="100px";>
                        <?php
                    }
                    else
                    {
                        echo "<div class='error'>image not added.</div>";
                    }
                     
                     ?>
                     </td>
                <td><?php echo $featured?></td>
                <td><?php echo $active?></td>
                <td>
               

                <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">UPDATE CATEGORY</a>
                    <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">DELETE CATEGORY</a>
                </td >
            </tr>
            

            <?php
            }
            }
            else{

            }
           }


         ?>                                                                                     







           
            



          </table>   
        
    </div> 
</div>
<?php
  include('partials/footer.php');
  ?>