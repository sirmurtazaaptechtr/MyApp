<?php
include('inc.header.php');
$name = $email = $password = '';
// pr($_SERVER);
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_btn'])) {
    // pr($_FILES);
    // prx($_POST);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);

    $sql = "INSERT INTO `users` (name,email,password) VALUES ('$name','$email','$password')";

    if($isInserted = mysqli_query($conn,$sql)) {
        header("location:users.php");
        exit();
    }
}

$sql = "SELECT * FROM `categories`";
$result = mysqli_query($conn,$sql);

?>
<div class="container">
    <h1>Add New Product</h1>
    <h2>Enter Product details</h2>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" enctype="multipart/form-data">
        <div class="form-floating mb-3">
            <select name="cat_id" id="cat_id" class="form-select">
                <option value="">Select Category</option>
                <?php
                while($row = mysqli_fetch_assoc($result)) { ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                <?php } ?>
            </select>
            <label for="cat_id">Category</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" name="name" placeholder="John Doe">
            <label for="name">Name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="unit_price" name="unit_price" placeholder="12.75">
            <label for="unit_price">Unit Price</label>
        </div>
        <div class="form-floating mb-3">
            <input type="file" class="form-control" id="image" name="image" placeholder="Image">
            <label for="image">Image</label>
        </div>
        <div class="form-floating mb-3">
            <textarea name="description" id="description" class="form-control"></textarea>
            <label for="name">Description</label>
        </div>
        <div class="mt-3">
            <button type="submit" name="save_btn" class="btn btn-primary mb-3">Save</button>
        </div>

    </form>
</div>
<?php include('inc.footer.php'); ?>