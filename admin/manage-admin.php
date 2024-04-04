


<?php include('partials/menu.php')?>



        <!-- main content section starts -->
        <div class="main-content">
        <div class="wrapper">
                <h1>Manage Admin</h1>
                <br>

                <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add']; //displaying session messages
                    unset($_SESSION['add']);//removing session messages
                }
                ?>
                <br> 
                <br>   

                <!-- button to add admin -->
                <a href="add-admin.php" class="btn-primary">Add Admin</a>
                <br>
                <br>

                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                    //query to get all admin
                      $sql="SELECT * FROM tbl_admin";

                      //execute the query
                      $res=mysqli_query($conn , $sql);

                      //check whether the query is executed or not
                      if($res==TRUE){
                        //COUNT rows to check whether there are data in database
                        $count=mysqli_num_rows($res);

                        $sn=1; //create a variable and assign the value

                        //check number of rows
                        if($count>0){
                            //we have data in database
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                //using while loop to get all the data in database
                                //it will run as long as we have data in database

                                //get individual data
                                $id=$rows['id'];
                                $full_name=$rows['full_name'];
                                $username=$rows['username'];

                                //display values in table

                                ?>

                    <tr>
                        <td><?php echo $sn++?></td>
                        <td><?php echo $full_name?></td>
                        <td><?php echo $username?></td>
                        <td>
                            <a href="" class="btn-secondary">Update</a>
                            <a href="" class="btn-danger">Delete</a>

                        </td>
                    </tr>

                                <?php
                            }

                        }

                      }
                    
                    ?>

                    
                </table>

            
                

            </div>

        </div>
        <!-- main content section ends -->



        <?php include('partials/footer.php') ?>