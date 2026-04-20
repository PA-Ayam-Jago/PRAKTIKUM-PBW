<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - Samarinda Theme Park</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container d-flex justify-content-center">
    <div class="card card-login shadow w-100">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 text-danger">Admin Login</h3>
            
            <form action="aksi_login.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                </div>
                <button type="submit" class="btn btn-danger w-100">Login</button>
            </form>
            
            <div class="text-center mt-3">
                <small class="text-muted">Samarinda Theme Park Project</small>
            </div>
        </div>
    </div>
</div>

</body>
</html>