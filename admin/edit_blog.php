<?php
include 'header.php';
if (isset($_SESSION['user_data'])) {
    $author_id = $_SESSION['user_data']['0'];
}
$sql = "SELECT * FROM category ";
$query = mysqli_query($config, $sql);

$blogId = $_GET['id'];
$sql2 = "SELECT * FROM blog LEFT JOIN category ON blog.category = category.cat_id LEFT JOIN 
user ON blog.author_id = user.user_id WHERE blog_id = '$blogId'";
$query2 = mysqli_query($config, $sql2);
$result = mysqli_fetch_assoc($query2);

?>
<div class="container">
    <h5 class="mb-2 text-gray-800">Blogs</h5>
    <div class="row">
        <div class="col-xl-8 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="font-weight-bold text-primary mt-2">Edit Blog</h6>

                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">

                        <div class="mb-3">
                            <input type="text" name="blog_title" class="form-control"  required value="<?= $result['blog_title']?>">
                        </div>
                        <label for="">body</label>
                        <div class="mb-3">
                            <textarea class="form-control" placeholder="Body" name="blog_body" id="blog" rows="2" required>
                            <?= $result['blog_body']?>
                            </textarea>
                        </div>
                        <div class="mb-3">
                            <input type="file" name="blog_image" class="form-control">
                            <img src="upload/<?= $result['blog_image']?>" width="100px" alt="">
                        </div>
                        <div class="mb-3">
                            <select class="form-control" name="category">
                    
                                <?php 
                                  while ($cats = mysqli_fetch_assoc($query)) { ?>

                                    <option value="<?= $cats['cat_id'] ?>"
                                    
                                         <?php 
                                          if($result['category']==$cats['cat_id']){
                                            echo "selected";
                                          }
                                          else{
                                            echo "";
                                          }
                                         
                                         ?>> 
                                        

                                        <?= $cats[ "cat_name"] ?>
                                    </option>

                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="submit" name="edit_blog" value="Update" class="btn btn-primary">
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
if (isset($_POST['edit_blog'])) {
    $title = mysqli_real_escape_string($config, $_POST['blog_title']);
    $body = mysqli_real_escape_string($config, $_POST['blog_body']);
    $category = mysqli_real_escape_string($config, $_POST['category']);
    $filename =  $_FILES['blog_image']['name'];
    $tmp_name = $_FILES['blog_image']['tmp_name'];
    $size = $_FILES['blog_image']['size'];
    $image_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $allow_type = ['jpg', 'png', 'jpeg'];
    $destination = "upload/" . $filename;
    if(!empty($filename)){
        if (in_array($image_ext, $allow_type)) {
            if ($size <= 2000000) {
                $unlink = "upload/".$result['blog_image'];
                unlink($unlink);
                move_uploaded_file($tmp_name, $destination);
                $sql3 = "UPDATE blog SET blog_title='$title',blog_body='$body',blog_image='$filename',category='$category',author_id='$author_id' 
                WHERE blog_id='$blogId'"; 
                $query3 = mysqli_query($config, $sql3);
                if ($query3) {
                    echo "add";
                    echo "<script>window.location.href='index.php'</script>";

                } else {
                    echo "error";
                }
            } else {
                echo "image size should not be grater then 2mb";
            }
        } else {
            echo "file type is not allow(only jpg,png,jpeg";
        }

    }
    else {
        $sql3 = "UPDATE blog SET blog_title='$title',blog_body='$body',category='$category',author_id='$author_id' 
                WHERE blog_id='$blogId'"; 
                $query3 = mysqli_query($config, $sql3);
                if ($query3) {
                    echo "add";
                    echo "<script>window.location.href='index.php'</script>";

                } else {
                    echo "error";
                }
    }
    
}

?>