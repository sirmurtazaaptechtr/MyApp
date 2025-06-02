<?php
include('inc.header.php');
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['product_id'])) {
    $id  = $_GET['product_id'];

    $sql = "DELETE FROM `products` WHERE id = '$id'";

    if($isDeleted = mysqli_query($conn,$sql)) {
        header("location:products.php");
        exit();
    }
}
$sql = "SELECT * FROM `products`";
$result = mysqli_query($conn,$sql);
// pr($result);
?>
<div class="container">
    <h1>Products Table</h1>
    <a href="product.create.php" type="button" class="btn btn-primary">+ Add Product</a>
    <table class="datatable table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Category ID</th>
                <th scope="col">Name</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Image</th>
                <th scope="col">Availability</th>
                <th scope="col">Description</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $srno = 1; while($row = mysqli_fetch_assoc($result)){ ?>
            <tr>
                <th scope="row"><?php echo $srno;?></th>
                <td><?php echo $row['id'];?></td>
                <td><?php echo $row['cat_id'];?></td>
                <td><?php echo $row['name']; ?></td>
                <td><img src="<?php echo $row['image'];?>" alt="<?php echo $row['name']; ?>"></td>
                <td><?php
                $inStock = $row['inStock'];
                if($inStock == 1) {
                    echo '<span class="badge bg-success">In Stock</span>';
                } else {
                    echo '<span class="badge bg-danger">Out of Stock</span>';
                }
                ?></td>
                <td><?php echo $row['description']; ?></td>
                <td>
                    <a href="product.edit.php?product_id=<?php echo $row['id'];?>" type="button" class="btn btn-warning">Edit</a>
                    <a href="product.php?product_id=<?php echo $row['id'];?>" type="button" class="btn btn-danger">Delete</a>
                </td>
            </tr>   
            <?php $srno++; } ?>             
        </tbody>
    </table>
</div>
<?php include('inc.footer.php'); ?>