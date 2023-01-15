<?php include 'header.php';
if (isset($_POST['add_user'])) {

    $username = mysqli_real_escape_string($config, $_POST['username']);
    $email = mysqli_real_escape_string($config, $_POST['email']);
    $password = mysqli_real_escape_string($config, $_POST['password']);
    $c_password = mysqli_real_escape_string($config, $_POST['c_password']);
    $role = mysqli_real_escape_string($config, $_POST['role']);

    if (strlen($username) < 4 || strlen($username) > 100) {
        $error = "username error ";
    } elseif (strlen($password) < 4) {
        $error = "password  error";
    } elseif ($password != $c_password) {
        $error = "password not match";
    } else {
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $query = mysqli_query($config, $sql);
        $row = mysqli_num_rows($query);
        if ($row >= 1) {
            $error = "already exists";
        }
        else{
        $sql2 = "INSERT INTO user (username , email , password, role) VALUES ('$username','$email','$password','$role')";
        $query2 = mysqli_query($config , $sql2);
        if ($query2) {
            echo "add";
        }else {
            
            $error = "failed to insert user";
        }
        
            //   echo "user added successfully";    
        }
    }
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-5 m-auto bg-info p-4">
            <?php
             if (!empty($error)) {
                echo "<p class='bg-danger text-white p-2'>$error</p>" ;
             }
            ?>
            <form action="" method="POST">
                <p class="text-center">create new user</p>
                <div class="mb-3">
                    <input type="text" name="username" placeholder="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <input type="email" name="email" placeholder="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" placeholder="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="c_password" placeholder="Confirm password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <select name="role" required class="form-control">
                        <option value="">select role</option>
                        <option value="1">admin</option>
                        <option value="0">co-admin</option>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="submit" name="add_user" class="btn btn-primary" value="create">
                </div>
            </form>
        </div>
    </div>
</div>




<?php include 'footer.php' ?>