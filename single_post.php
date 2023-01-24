<?php
session_start();
include 'header.php';
include 'Config.php';
$id = $_GET['id'];
$sql = "SELECT *FROM blog WHERE blog_id = '$id'";
$run = mysqli_query($config, $sql);
$post = mysqli_fetch_assoc($run);
if (!isset($_SESSION['user_data'])) {
    header("location:http://localhost/php-blog-site/login.php");
}


?>
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-body">
                    <div id="single_img">
                        <?php $img = $post['blog_image'] ?>
                        <a href="">
                            <img src="admin/upload/<?= $img ?>" alt="">
                        </a>
                    </div>
                    <div>
                        <hr>
                        <h5><?= $post['blog_title'] ?></h5>
                        <p><?= $post['blog_body'] ?></p>

                    </div>
                    <div>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <input type="text" name="comment" placeholder="add a comment" class="form-control">
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="id" value=<?php echo $id; ?>>
                                <input type="submit" name="addComment" value="SAVE it" class="btn btn-primary">

                            </div>
                        </form>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="col-lg6">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row mt-2">
                <div class="col-lg-8">
                    <div class="card shadow">
                        <div class="card-body">
                            <h1>All Comment</h1>
                           <?php
                             $com_sql = "SELECT * FROM comments WHERE blog_id = '$id'";
                             $com_query = mysqli_query($config, $com_sql);
                             $com_rows = mysqli_num_rows($com_query);
                             if ($com_rows) {
                                while ($result = mysqli_fetch_assoc($com_query)) {
                            ?>
                                 <p><?= $result['comment']?></p>   
                                 <h6>Posted by: <?= $result['username']?></h6>   
                            <?php
                                }
                            }
    
                            ?>
                           
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <?php include 'sidebar.php' ?>
        <?php
        include 'footer.php';
        if (isset($_POST['addComment'])) {
            $com = mysqli_real_escape_string($config, $_POST['comment']);
            $blog_id = $_POST['id'];
            $userId = $_SESSION['user_data']['0'];
            $username = $_SESSION['user_data']['1'];

            $query = "INSERT INTO comments (comment,user_id,username,blog_id) VALUES
                 ('$com','$userId','$username','$blog_id')";
            $query_run = mysqli_query($config, $query);

            if ($query_run) {
                echo "<script>window.location.href='single_post.php'</script>";
                //$_SESSION['message'] = "student created successfully";
                //header("location: login.php ");
                echo "ok done";
                exit(0);
            } else {
                echo "<script>window.location.href='single_post.php?id=<?=$blog_id ?>'</script>";
                // $_SESSION['message'] = "student not created";
                // header("location: registration.php ");
                echo "not done ";
                exit(0);
            }
        }


        ?>