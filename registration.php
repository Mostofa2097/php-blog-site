<?php
include "Config.php";
include 'header.php';
session_start();
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-xl-5 col-md-4 m-auto p-5 mt-5 bg-info">
            <form action="code.php" method="POST">
                <p class="text-center">blog! Login your account </p>
                <div class="mb-3">
                    <input type="name" name="username" placeholder="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <input type="email" name="email" placeholder="Email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" placeholder="Password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <input type="role" name="role" placeholder="role" class="form-control" required>
                </div>
                <div class="mb-3">
                    <input type="submit" name="reg_btn" class="btn btn-success" value="reg">
                </div>
                <?php
                if (isset($_SESSION['message'])) {
                    $message = $_SESSION['message'];
                    echo "<p class='bg-danger p-2 text-white'>" . $message . "</p>";
                    unset($_SESSION['message']);
                }
                ?>
            </form>
        </div>



    </div>
</div>
</div>


<?php include 'footer.php';
if (isset($_POST['login_btn'])) {
    $name = mysqli_real_escape_string($config, $_POST['username']);
    $email = mysqli_real_escape_string($config, $_POST['email']);
    $pass = mysqli_real_escape_string($config, sha1($_POST['password']));
    $role = mysqli_real_escape_string($config, sha1($_POST['role']));

    $query = "INSERT INTO user (username,password,email,role) VALUES
    ('$username','$email','$password','$role')";
    $query_run = mysqli_query($config, $query);

    if ($query_run) {

        $_SESSION['user_data'] = $user_data;
        header("location:admin.php");
        exit(0);
    } else {
        $_SESSION['error'] = "invalid email/pass";
        header("location:login.php");
    }
}
?>