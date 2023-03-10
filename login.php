<?php
include "Config.php";
include 'header.php';
session_start();
if (isset($_SESSION['user_data'])) {
    header("location:http://localhost/php-blog-site/admin/index.php");
}
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-xl-5 col-md-4 m-auto p-5 mt-5 bg-info">
            <form action="" method="POST">
                <p class="text-center">blog! Login your account </p>
                <div class="mb-3">
                    <input type="email" name="email" placeholder="Email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" placeholder="Password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <input type="submit" name="login_btn" class="btn btn-primary" value="login">
                </div>
                <?php
                if (isset($_SESSION['error'])) {
                    $error = $_SESSION['error'];
                    echo "<p class='bg-danger p-2 text-white'>" . $error . "</p>";
                    unset($_SESSION['error']);
                }
                ?>
            </form>
        </div>



    </div>
</div>
</div>


<?php include 'footer.php';
if (isset($_POST['login_btn'])) {
    $username = mysqli_real_escape_string($config, $_POST['username']);
    $email = mysqli_real_escape_string($config, $_POST['email']);
    $pass = mysqli_real_escape_string($config, $_POST['password']);

    $sql = "SELECT * FROM user WHERE email = '{$email}' AND password = '{$pass}'";
    $query = mysqli_query($config, $sql);
    $data = mysqli_num_rows($query);
    if ($data) {
        $result = mysqli_fetch_assoc($query);
        $user_data = array($result['user_id'], $result['username'], $result['email'], $result['role']);
        $_SESSION['user_data'] = $user_data;
        if (isset($_SESSION['user_data'])) {
            $userRole = $_SESSION['user_data']['3'];
        if ($userRole == 1) {
            echo "<script>window.location.href='admin/index.php'</script>";
        } else {
            echo "<script>window.location.href='index.php'</script>";
        }

        // header("location:admin/index.php");
    } else {
        $_SESSION['error'] = "invalid email/pass";
        header("location:home.php");
    }
}
}
?>