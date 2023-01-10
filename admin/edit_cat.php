<?php
include 'header.php';

$id = $_GET['id'];
$sql = "SELECT * FROM category WHERE cat_id = '$id'";
$query = mysqli_query($config, $sql);
$row = mysqli_fetch_assoc($query);

?>
<div class="container">
    <h5 class="mb-2 text-gray-800"></h5>
    <div class="row">
        <div class="col-xl-6 col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h6 class="font-weight-bold text-primary mt-2">Update Category</h6>

                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <input type="text" name="cat_name" placeholder="category name" class="form-control" value="<?= $row['cat_name']; ?>">
                        </div>
                        <div class="mb-3">
                            <input type="submit" name="update_cat" value="update" class="btn btn-primary">
                            <a href="categories.php" class="btn btn-secondary">back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'footer.php';
if (isset($_POST['update_cat'])) {
    $cat_name = mysqli_real_escape_string($config, $_POST['cat_name']);
    $sql2 = "UPDATE category SET cat_name = '{$cat_name}' WHERE cat_id = '{$id}'";
    $update = mysqli_query($config, $sql2);
    if ($update) {
        $msg = ['category hs been added successfully'];
        $_SESSION['msg'] = $msg;
        echo "<script>window.location.href='categories.php'</script>";
        // header("location:categories.php");
    } else {
        $msg = ['category hs been added successfully'];
        $_SESSION['msg'] = $msg;
        header("location:categories.php");
    }
}

?>