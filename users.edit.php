<?php
include('inc.header.php');
$id = $name = $email = $password = '';
// pr($_SERVER);
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['user_id'])) {
    $id = $_GET['user_id'];
    $sql = "SELECT * FROM `users` WHERE id = '$id'";
    $result = mysqli_query($conn,$sql);
    // pr($result);
    if(mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);
        $name = $user['name'];
        $email = $user['email'];
        $password = $user['password'];        
    }
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_btn'])) {
    // pr($_POST);
    $id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    if($_POST['password']) {
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    }
    
    $sql = "UPDATE `users` SET `name` = '$name', `email` = '$email', `password` = '$password' WHERE `users`.`id` = '$id'";
    if($isUpdated = mysqli_query($conn,$sql)) {
        header("location:users.php");
        exit();
    }

}

?>
<div class="container">
    <h1>Add New User</h1>
    <h2>Enter user details</h2>
    <form action="users.edit.php" method="post">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="user_id" name="user_id" value="<?php echo $id;?>" readonly>
            <label for="user_id">User ID</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" value="<?php echo $name;?>">
            <label for="name">Name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="<?php echo $email;?>">
            <label for="email">Email address</label>
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