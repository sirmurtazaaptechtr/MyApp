<?php
include('inc.header.php');
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['cat_id'])) {
    $id  = $_GET['cat_id'];

    $sql = "DELETE FROM `categories` WHERE id = '$id'";

    if($isDeleted = mysqli_query($conn,$sql)) {
        header("location:categories.php");
        exit();
    }
}
$sql = "SELECT * FROM `categories`";
$result = mysqli_query($conn,$sql);
// pr($result);
?>
<div class="container">
    <h1>Categories Table</h1>
    <a href="category.create.php" type="button" class="btn btn-primary">+ Add Category</a>
    <table class="datatable table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Icon</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $srno = 1; while($row = mysqli_fetch_assoc($result)){ ?>
            <tr>
                <th scope="row"><?php echo $srno;?></th>
                <td><?php echo $row['id'];?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><span><?php echo $row['icon']; ?></span></td>
                <td>
                    <a href="category.edit.php?cat_id=<?php echo $row['id'];?>" type="button" class="btn btn-warning">Edit</a>
                    <a href="category.php?cat_id=<?php echo $row['id'];?>" type="button" class="btn btn-danger">Delete</a>
                </td>
            </tr>   
            <?php $srno++; } ?>             
        </tbody>
    </table>
</div>
<?php include('inc.footer.php'); ?>