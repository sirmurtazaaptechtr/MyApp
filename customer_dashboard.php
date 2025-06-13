<?php
include('inc.customer_header.php');
if(!isset($_SESSION['logged_in']) || $_SESSION['user_role'] != 2) {
    header('Location: login.php');
    exit();
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Customer Dashboard</h1>
            <p>Welcome to the customer dashboard. Here you can manage users, view reports, and configure settings.</p>
        </div>
    </div>
</div>
<?php include('inc.customer_footer.php')?>