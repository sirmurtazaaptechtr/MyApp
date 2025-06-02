<?php
include('inc.header.php');
$name = $email = $password = '';
// pr($_SERVER);
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_btn'])) {
    // pr($_POST);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);

    $sql = "INSERT INTO `users` (name,email,password) VALUES ('$name','$email','$password')";

    if($isInserted = mysqli_query($conn,$sql)) {
        header("location:users.php");
        exit();
    }
}

?>
<div class="container">
    <h1>Add New User</h1>
    <h2>Enter user details</h2>
    <form action="users.create.php" method="post">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" name="name" placeholder="John Doe">
            <label for="name">Name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
            <label for="email">Email address</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            <label for="password">Password</label>
        </div>
        <div class="mt-3">
            <button type="submit" name="save_btn" class="btn btn-primary mb-3">Save</button>
        </div>

    </form>
</div>
<?php include('inc.footer.php'); ?>