<?php
require('inc.connection.php');
$login = $email = $password = '';
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['loginBtn'])) {
    
    $email = safe_input($_POST['email']);
    $password = safe_input($_POST['password']);     
    
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verify the password
        if(password_verify($password, $user['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['role_id'];

            if($_SESSION['user_role'] == 1) {
                header('Location: admin_dashboard.php');
            } elseif($_SESSION['user_role'] == 2) {
                header('Location: customer_dashboard.php');
            }         
            exit();           
        } else {
            $login = false;
        }        
        
    } else {
        $login = false;
    }    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">My App Login</h1>
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-title">
                    <!-- <h2 class="text-center">Login Form</h2> -->
                     <?php
                     if($login === false) {
                        echo '<div class="alert alert-danger" role="alert">
                            Invalid email or password. Please try again.
                            </div>';
                        }
                    ?>
                </div>
                <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email;?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" value="<?php echo $password?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="loginBtn">Login</button>
                    </form>        
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>