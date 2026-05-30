<!DOCTYPE html>
<html>
<head>
    <title>Inventory Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../Public/Login.css">
</head>
<body>

<div class="split-layout">
    <div class="left-pane">
        <div class="brand-text">
            <h1>INVENTORY<br><span>SYSTEM</span></h1>
        </div>
    </div>

    <div class="right-pane">
        <div class="container">
            <div class="logo">
                <i class="fa-solid fa-boxes-stacked"></i>
            </div>
            
            <h2>Welcome back!</h2>
            <p class="subtitle">Please enter your details to access inventory</p>

            <form method="POST" action="index.php?action=login">

                <div class="input-wrapper">
                    <label>Username / Email</label>
                    <div class="input-group">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" name="username" placeholder="Username" required>
                    </div>
                </div>

                <div class="input-wrapper">
                    <label>Password</label>
                    <div class="input-group">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" required>
                        <i class="fa-regular fa-eye eye-icon"></i>
                    </div>
                </div>

                <button type="submit" class="btn-login">Log In</button>

            </form>

            <div class="message">
                <?= $message ?? '' ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>