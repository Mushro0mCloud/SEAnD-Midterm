<?php include "includes/db_conn.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container" style="display:flex; flex-direction:column; justify-content:center;">
        <h1>Reset Password</h1>
        <p>Enter your details to recover your account.</p>

        <form action="process_reset.php" method="post" class="form-box" style="box-shadow:none; border:none; padding:0;">
            <?php if (isset($_GET['msg'])) { echo "<p class='error'>".$_GET['msg']."</p>"; } ?>
            
            <label>Email Address</label>
            <input type="email" name="email" placeholder="your@mail.com" required>
            
            <label>Security Question: What is your city of birth?</label>
            <input type="text" name="answer" placeholder="Answer" required>
            
            <label>New Password</label>
            <input type="password" name="new_password" placeholder="New Password" required>
            
            <br>
            <button type="submit">UPDATE PASSWORD</button>
            
            <div style="margin-top: 15px; text-align: center;">
                <a href="index.php" style="font-size: 14px; color: #1976D2;">Back to Login</a>
            </div>
        </form>
    </div>
</body>
</html>