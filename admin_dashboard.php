<?php
include('inc.admin_header.php');
if(!isset($_SESSION['logged_in']) || $_SESSION['user_role'] != 1) {
    header('Location: login.php');
    exit();
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Admin Dashboard</h1>
            <p>Welcome to the admin dashboard. Here you can manage users, view reports, and configure settings.</p>
        </div>
    </div>
</div>
<?php include('inc.admin_footer.php')?>