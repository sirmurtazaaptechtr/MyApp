<?php
include('inc.header.php');
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['user_id'])) {
    $id  = $_GET['user_id'];

    $sql = "DELETE FROM `users` WHERE id = '$id'";

    if($isDeleted = mysqli_query($conn,$sql)) {
        header("location:users.php");
        exit();
    }
}
$sql = "SELECT * FROM `users`";
$result = mysqli_query($conn,$sql);
// pr($result);
?>
<div class="container">
    <h1>Users Table</h1>
    <a href="users.create.php" type="button" class="btn btn-primary">+ Add User</a>
    <table class="datatable table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $srno = 1; while($row = mysqli_fetch_assoc($result)){ ?>
            <tr>
                <th scope="row"><?php echo $srno;?></th>
                <td><?php echo $row['id'];?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['password']; ?></td>
                <td>
                    <a href="users.edit.php?user_id=<?php echo $row['id'];?>" type="button" class="btn btn-warning">Edit</a>
                    <a href="users.php?user_id=<?php echo $row['id'];?>" type="button" class="btn btn-danger">Delete</a>
                </td>
            </tr>   
            <?php $srno++; } ?>             
        </tbody>
    </table>
</div>
<?php include('inc.footer.php'); ?>