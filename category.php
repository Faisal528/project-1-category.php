            <?php 

                include "inc/header.php";
                include "inc/menubar.php";

            ?>

            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Category Page</h4>
                    </div>
                    
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">

                <!-- main content -->

            <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-12">

                        <!-- add category -->

                        <div class="white-box analytics-info">
                            <h3 class="box-title">Add New Category</h3>
                            <ul class="mt-3">
                                <form method="POST">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Category Name</label>
                                     <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="cat_name">
                                    </div>
                                    <div class="mb-3">
                                     <label for="exampleInputPassword1" class="form-label">Category Description</label>
                                     <textarea rows="3" class="form-control" id="exampleInputPassword1" name="cat_description"></textarea>
                                    </div>
                                    
                                     <button type="submit" class="btn btn-primary" name="cat_submit">Submit</button>
                                    </form>

                                    <!-- category insert code here -->

                                    <?php

                                    if(isset($_POST['cat_submit'])){
                                        $cat_name           =$_POST['cat_name'];
                                        $cat_description    =$_POST['cat_description'];

                                        // 3 step (sql, sql->database, feedback)
                                        $sql = "INSERT INTO category (c_name,c_description,c_status) VALUES ('$cat_name','$cat_description', 0)";
                                        $result = mysqli_query($db,$sql);

                                        if($result){
                                            header('Location: category.php');
                                        }else{
                                            echo "category insert error!";
                                        }

                                    }

                                    ?>
                            </ul>
                        </div>

                        <!-- edit category -->

                        <?php
                        if(isset($_GET['edit_id'])){
                            $e_id = $_GET['edit_id'];

                            // read all info of id $e_id

                            $sql2 = "SELECT * FROM category WHERE c_id='$e_id'";
                            $edit_category = mysqli_query($db,$sql2);

                            while($row = mysqli_fetch_assoc($edit_category)){
                                $c_name         = $row['c_name'];
                                $c_description  = $row['c_description'];
                                $c_status       = $row['c_status'];

                            }

                            ?>

                            <div class="white-box analytics-info">
                            <h3 class="box-title">Update Category</h3>
                            <ul class="mt-3">
                                <form method="POST">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Category Name</label>
                                     <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="cat_name" value="<?php echo $c_name?>">
                                    </div>
                                    <div class="mb-3">
                                     <label for="exampleInputPassword1" class="form-label">Category Description</label>
                                     <textarea rows="3" class="form-control" id="exampleInputPassword1" name="cat_description" value="<?php echo $c_description?>"><?php echo $c_description?></textarea>
                                    </div>
                                    <div class="mb-3">
                                     <label for="exampleInputPassword1" class="form-label">Category Status</label>
                                     <select class="form-select" aria-label="Default select example" name="cat_status">
                                        <option value="1" <?php if($c_status == 1) echo "Selected";?>>Active</option>
                                        <option value="0" <?php if($c_status == 0) echo "Selected";?>>Inactive</option>
                                        </select>
                                    </div>
                                    
                                     <button type="submit" class="btn btn-primary" name="cat_update">Update Category</button>
                                    </form>

                                    <!-- update operation-->

                                    <?php

                                    if(isset($_POST['cat_update'])){
                                        $cat_name          = $_POST['cat_name'];
                                        $cat_description   = $_POST['cat_description'];
                                        $cat_status        = $_POST['cat_status'];

                                        $sql4 = "UPDATE category SET c_name='$cat_name',c_description='$cat_description',c_status='$cat_status' WHERE c_id='$e_id'";

                                        $update_res = mysqli_query($db,$sql4);

                                        if($update_res){
                                            header('Location: category.php');
                                        }else{
                                            die("category update error!".error($db));
                                        }
                                    }

                                    ?> 
                            </ul>
                        </div>

                            <?php

                        }

                        ?>

                 </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">All Category List</h3>
                            <ul class="mt-3">
                                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">Category Name</th>
                                            <th class="border-top-0">Description Name</th>
                                            <th class="border-top-0">Status</th>
                                            <th class="border-top-0">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <!-- category read operation -->

                                        <?php

                                        // 3 step

                                        $sql2 = "SELECT * FROM category";
                                        $all_category = mysqli_query($db,$sql2);

                                        $serial = 0;

                                        while($row = mysqli_fetch_assoc($all_category)){
                                            $c_id = $row['c_id'];
                                            $c_name = $row['c_name'];
                                            $c_description = $row['c_description'];
                                            $c_status = $row['c_status'];

                                            $serial++

                                            ?>

                                        <tr>
                                            <td><?php echo $serial;?></td>
                                            <td><?php echo $c_name;?></td>
                                            <td><?php echo $c_description;?></td>
                                            <td>
                                                <?php
                                                if($c_status == 0){
                                                    echo "<span class='badge bg-danger'>Inactive</span>";
                                                }else{
                                                    echo "<span class='badge bg-success'>Active</span>";
                                                }

                                                ?>
                                                
                                            </td>
                                            <td>
                                                <a href="category.php?edit_id=<?php echo $c_id;?>">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="" class="ms-3" data-bs-toggle="modal" data-bs-target="#delete<?php echo $c_id;?>">
                                                            <i class="fas fa-trash-alt text-danger"></i>
                                                        </a>
   
                                            </td>
                                        </tr>

                                        <!-- Delete modal -->
                                        <div class="modal fade" id="delete<?php echo $c_id;?>" tabindex="-1" aria-labelledby="vertical-center-modal" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content modal-filled bg-warning">
                                                    <div class="modal-body p-4">
                                                        <div class="text-center text-light">
                                                            <i data-feather="x-octagon" class="fill-white feather-lg"></i>
                                                            <h2 class="mt-2">Are You Sure!</h2>
                                                            <a type="button" class="btn btn-light my-2"
                                                                data-bs-dismiss="modal">Cancel</a>
                                                            <a href="category.php?delete_id=<?php echo $c_id;?>" type="button" class="btn btn-light my-2 bg-danger text-light">Confirm?</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                            <?php

                                        }


                                        ?>

                                        <!-- delete operation -->

                                        <?php

                                        if(isset($_GET['delete_id'])){
                                            $d_id = $_GET['delete_id'];

                                            $sql3 = "DELETE FROM category WHERE c_id='$d_id'";
                                            $delete_res = mysqli_query($db,$sql3);

                                            
                                            if($delete_res){
                                           header('Location: category.php');
                                            }else{
                                              die('Category Delete Error!'.error($db));
                                       }

                                        }


                                        ?>
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                            </ul>
                        </div>
                    </div>
                    
                </div>
                
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            
            <?php 

                include "inc/footer.php";

            ?>

 