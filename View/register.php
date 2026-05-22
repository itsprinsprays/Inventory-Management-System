<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

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

        input, select{
            width:100%;
            padding:10px;
            margin-top:10px;
        }

        button{
            width:100%;
            padding:10px;
            margin-top:15px;
            background:#007bff;
            color:white;
            border:none;
        }

        .message{
            color:green;
            margin-top:10px;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>Register</h2>

    <form method="POST" action="index.php?action=register">

        <input type="text" name="username" placeholder="Username" required>

        <input type="password" name="password" placeholder="Password" required>

        <select name="role" required>
            <option value="">Select Role</option>
            <option value="admin">Admin</option>
            <option value="employee">Teacher</option>
        </select>

        <input type="number" name="employee_id" placeholder="Employee ID" required>

        <button type="submit">Register</button>

    </form>

    <div class="message">
        <?= $message ?? '' ?>
    </div>

    <p>
        Already have an account?
        <a href="index.php?action=login">Login</a>
    </p>

</div>

</body>
</html>