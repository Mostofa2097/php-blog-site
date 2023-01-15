<?php
include 'header.php';
$sql = "SELECT * FROM user ";
$query = mysqli_query($config , $sql);
$row = mysqli_num_rows($query);

?>


<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h5 class="mb-2 text-gray-800">User</h5>
    <!-- DataTales Example -->
    <div class="card shadow">
        <div class="card-header py-3 d-flex justify-content-between">
            <div>
                <a href="add_user.php">
                    <h6 class="font-weight-bold text-primary mt-2">Add New user</h6>
                </a>
            </div>
            <div>
                <form class="navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-white border-0 small" placeholder="Search for...">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button"> <i class="fa fa-search"></i> </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>username</th>
                            <th>email</th>
                            <th>role</th>
                            
                            <th colspan="1">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php
                    $count = 1;
                        if ($row) {
                            while ($rows = mysqli_fetch_assoc($query)){
                                ?>
                                <tr>
                                 <td><?= $count++ ?></td>
                                 <td><?= $rows['username'] ?></td>
                                 <td><?= $rows['email'] ?></td>
                                 <td><?php
                                 $role = $rows['role'];
                                 if ($role == 1) {
                                    echo "Admin";
                                 }else{
                                    echo "co-admin";
                                 }
                                 ?></td>
                                 <td>
                                 <form action="" class="mt-2" method="POST" onsubmit="return confirm('Are you sure')">
                                            <input type="hidden" name="userId" value="<?= $rows['user_id'] ?>">
                                            <input type="submit" name="deleteUser" value="Delete" class="btn btn-sm btn-danger">

                                        </form>
                                 </td>
                                </tr>

                                <?php
                            }
                        }
                            
                    ?>
                       

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>


<?php
include 'footer.php';
if (isset($_POST['deleteUser'])) {
    $id = $_POST['userId'];
    $delete = "DELETE FROM user WHERE user_id = '$id'";
    $run = mysqli_query($config, $delete);
    if ($run) {
        echo "delete successfully";
        echo "<script>window.location.href='user.php'</script>";
        // header("location:categories.php");
    } else {
        echo "<script>window.location.href='user.php'</script>";
        // header("location:categories.php");
        // echo "failed please agin try";
    }
}



?>