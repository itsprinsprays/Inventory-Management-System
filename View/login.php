<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <style>
        body{
            font-family:Arial;
            background:#f4f4f4;
        }

        .container{
            width:350px;
            margin:80px auto;
            background:white;
            padding:30px;
            border-radius:10px;
        }

        input{
            width:100%;
            padding:10px;
            margin-top:10px;
        }

        button{
            width:100%;
            padding:10px;
            margin-top:15px;
            background:#28a745;
            color:white;
            border:none;
        }

        .message{
            color:red;
            margin-top:10px;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>Login</h2>

    <form method="POST" action="index.php?action=login">

        <input type="text" name="username" placeholder="Username" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Login</button>

    </form>

    <div class="message">
        <?= $message ?? '' ?>
    </div>

</div>

</body>
</html>