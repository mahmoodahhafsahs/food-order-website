<?php
   include('partials/menu.php');
   ?>
    <div class="main-content">
        <div class="wrapper">
            
         <h1>MANAGE FOOD</h1>
         <br/><br/>
         <?php
           if(isset($_SESSION['add']))
           {
             echo $_SESSION['add'];
             unset($_SESSION['add']);
           }
           if(isset($_SESSION['upload']))
           {
             echo $_SESSION['upload'];
             unset($_SESSION['upload']);
           }
           if(isset($_SESSION['delete']))
           {
             echo $_SESSION['delete'];
             unset($_SESSION['delete']);
           }
           if(isset($_SESSION['unauthorized']))
           {
             echo $_SESSION['unauthorized'];
             unset($_SESSION['unauthorized']);
           }
           if(isset($_SESSION['remove-failed']))
           {
             echo $_SESSION['remove-failed'];
             unset($_SESSION['remove-failed']);
           }
           if(isset($_SESSION['update']))
           {
             echo $_SESSION['update'];
             unset($_SESSION['update']);
           }
        ?>
         
         <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add food</a>
         <br/><br/><br/>
         <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>title</th>
                <th>price</th>
                <th>image</th>
                <th>featured</th>
                <th>active</th>
                <th>actions</th>
                
            </tr>
         <?php
           $sql="SELECT * FROM tbl_food";
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
             
             $price=$rows['price'];
             $image_name=$rows['image_name'];
             
             $featured=$rows['featured'];
             $active=$rows['active'];





            ?>
            <tr>
                <td><?php echo $sn++ ?></td>
                <td><?php echo $title?></td>
                <td><?php echo "$".$price?></td>
                <td>
                    <?php
                    if($image_name=="")
                    {
                        echo "<div class='error'>image not added.</div>";
                    }
                    else
                    {
                       
                        ?>
                        <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" width="100px";>
                        <?php
                    }
                     
                     ?>
                     </td>
                <td><?php echo $featured?></td>
                <td><?php echo $active?></td>
                <td>
               

                <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">UPDATE FOOD</a>
                    <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">DELETE FOOD</a>
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