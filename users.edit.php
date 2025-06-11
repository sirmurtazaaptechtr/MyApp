<?php
include('inc.header.php');
$id = $name = $email = $password = '';
$nameError = $emailError = $passwordError = '';
// pr($_SERVER);
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['user_id'])) {
    $id = safe_input($_GET['user_id']);
    $sql = "SELECT * FROM `users` WHERE id = '$id'";
    $result = mysqli_query($conn,$sql);
    // pr($result);
    if(mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);
        $name = safe_input($user['name']);
        $email = safe_input($user['email']);
        $password = safe_input($user['password']);        
    }
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_btn'])) {
    // pr($_POST);
    $id = safe_input($_POST['user_id']);

    if(empty($_POST['name'])) {
        $nameError = 'User name is required';
    }else {
        $name = safe_input($_POST['name']);
        if (!preg_match("/^[a-zA-Z-' ]+$/",$name)) {
            $nameError = "Only letters and white space allowed";
        }
    }
    
    if(empty($_POST['email'])) {
        $emailError = 'Email is required';
    }else {
        $email = safe_input($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format";
        }
    }

    if($_POST['password']) {
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    }
    
    if(empty($nameError) && empty($emailError) && empty($passwordError)) {
        $sql = "UPDATE `users` SET `name` = '$name', `email` = '$email', `password` = '$password' WHERE `users`.`id` = '$id'";
        if($isUpdated = mysqli_query($conn,$sql)) {
            header("location:users.php");
            exit();
        }        
    }

}

?>
<div class="container">
    <h1>Add New User</h1>
    <h2>Enter user details</h2>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="user_id" name="user_id" value="<?php echo $id;?>" readonly>
            <label for="user_id">User ID</label>
        </div>
        
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" value="<?php echo $name;?>">
            <label for="name">Name</label>
            <span class="text-danger">* <?php echo $nameError?></span>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="<?php echo $email;?>">
            <label for="email">Email address</label>
            <span class="text-danger">* <?php echo $emailError?></span>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo $password?>">
            <label for="password">Password</label>
        </div>
        <div class="mt-3">
            <button type="submit" name="update_btn" class="btn btn-primary mb-3">Update</button>
        </div>

    </form>
</div>
<?php include('inc.footer.php'); ?>