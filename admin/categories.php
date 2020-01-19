<?php include_once "includes/admin_header.php" ?>
<?php include_once "includes/admin_navigation.php" ?>

<div id="wrapper">

    <!-- Navigation -->




    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to admin page
                        <small>Author</small>
                    </h1>

                    <div class="col-xs-6">


                        <?php
                        if(isset($_POST['submit'])) {
                            $cat_title = $_POST['cat_title'];

                            if($cat_title == "" || empty($cat_title)){

                                echo "The Category Title should not be empty";


                            } else {
                                $query = "INSERT INTO categories(cat_title) VALUES('{$cat_title}') ";

                                $create_category_query = mysqli_query($connection, $query);

                                if(!$create_category_query) {
                                    die('QUERY FAILED'. mysqli_error($connection));
                                }
                            }
                        }

                        ?>





                        <form action="" method="post">

                            <div class="form-group">
                                <label for="cat-title">Add Category </label>
                                <input type="text" name="cat_title" class="form-control">
                            </div>

                            <div class="form-group">
                                <input type="submit" name="submit" value="Add Category" class="btn btn-primary">
                            </div>

                        </form>


                        <form action="" method="post">

                            <div class="form-group">
                                <label for="cat-title">Edit Category </label>

                                <?php

                                if(isset($_GET['edit'])) {
                                    $cat_id = $_GET['edit'];
                                }

                                $query = "SELECT * FROM categories WHERE cat_id = $cat_id ";
                                $select_categories_id = mysqli_query($connection,$query);

                                while($row = mysqli_fetch_assoc($select_categories_id)) {
                                $cat_id = $row['cat_id'];
                                $cat_title = $row['cat_title'];

                                ?>

                                    <input value="<?php if(isset($cat_title)) { echo $cat_title; } ?>" type="text" name="cat_title" class="form-control">

                                <?php } ?>




                            </div>

                            <div class="form-group">
                                <input type="submit" name="submit" value="Update" class="btn btn-primary">
                            </div>

                        </form>


                    </div>


                    <div class="col-xs-6">



                        <table class="table table-bordered table-hover">
                            <thead>

                            <tr>
                                <th>Id</th>
                                <th>Category </th>
                            </tr>

                            </thead>


                            <?php // find all catagories query
                            $query = "SELECT * FROM categories";
                            $select_categories = mysqli_query($connection,$query);

                            while ($row = mysqli_fetch_assoc($select_categories)) {
                                $cat_id = $row['cat_id'];
                                $cat_title = $row['cat_title'];

                                echo "<tr>";
                                echo "<td>{$cat_id}</td></li>";
                                echo "<td>{$cat_title}</td></li>";
                                echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td></li>";
                                echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td></li>";
                                echo "<tr>";

                            }
                            ?>




                            <?php   //DELETE Query
                            if(isset($_GET['delete'])) {
                                $the_cat_id = $_GET['delete'];
                                $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";

                                $delete_query = mysqli_query($connection,$query);

                                header("location: categories.php");
                            }
                            ?>

                            </tr>
                            </tbody>

                        </table>


                    </div>




                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include_once "includes/admin_footer.php" ?>
