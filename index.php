<?php
session_start();
if (isset($_POST['login'])) {
    if ($_POST['username'] == 'avimxi' && $_POST['password'] == '10011997tapo') {
        $_SESSION['login'] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "USERNAME KA PASSWORD SALA!";
    }
}
?>
<!DOCTYPE html>
<html lang="tet">
<head>
    <meta charset="UTF-8">
    <title>LOGIN - SISTEMA ANEKSOS</title>
    <style>
        /* Desain Metan & Bold Professional (Hanesan Dashboard) */
        body { 
            margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, sans-serif; 
            background: #050a14; height: 100vh; display: flex; 
            justify-content: center; align-items: center; font-weight: bold;
        }
        
        .login-card {
            background: #050a14; 
            padding: 40px;
            border: 1px solid #1a2a4a;
            border-radius: 8px;
            text-align: center;
            width: 320px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.5);
        }
        
        .login-card img { width: 70px; margin-bottom: 20px; }
        
        .title {
            color: #ffffff;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 25px;
            text-transform: uppercase;
            border-bottom: 1px solid #1a2a4a;
            padding-bottom: 10px;
        }
        
        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #1a2a4a;
            background: #0a1428;
            color: #ffffff;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 12px;
            font-weight: bold;
            text-align: center;
        }
        
        button {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            border: 1px solid #ffffff;
            border-radius: 4px;
            background: #0a1428;
            color: #ffffff;
            font-weight: bold;
            font-size: 12px;
            cursor: pointer;
        }
        
        button:hover { background: #1a2a4a; }
        
        .error { color: #ff6b6b; font-size: 11px; margin-top: 15px; font-weight: bold; text-transform: uppercase; }
    </style>
</head>
<body>

<div class="login-card">
    <img src="gmprm.png" alt="Logo">
    <div class="title">SISTEMA ANEKSOS DOKUMENTO</div>
    <form method="POST">
        <input type="text" name="username" placeholder="USERNAME" required>
        <input type="password" name="password" placeholder="PASSWORD" required>
        <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>
        <button type="submit" name="login">LOGIN</button>
    </form>
</div>

</body>
</html>