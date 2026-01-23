<?php
include "includes/db_conn.php";
include "includes/functions.php"; // Assuming log_activity() is here

if (isset($_POST['email']) && isset($_POST['answer']) && isset($_POST['new_password'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $answer = mysqli_real_escape_string($conn, $_POST['answer']);
    $new_pass = mysqli_real_escape_string($conn, $_POST['new_password']);
        //mysqli_real_escape_string helps to kepe sql injection away / special characters involved
    
    // 1. Check if user exists and answer is correct
    // We also fetch the 'password' to store it in logs before we change it
    $sql = "SELECT user_id, password FROM users WHERE email='$email' AND security_answer='$answer'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['user_id'];
        $old_pass = $row['password'];

        // 2. Update the password in the Database (Data Tier)
        $update_sql = "UPDATE users SET password='$new_pass' WHERE user_id='$user_id'";
        
        if (mysqli_query($conn, $update_sql)) {
            // 3. Create a log for the Super Admin
            $description = "User reset password via Security Question. Old password: " . $old_pass;
            log_activity($conn, $user_id, 'PASSWORD_RESET', $description);

            header("Location: index.php?error=Password updated successfully! Logged by System.");
            exit();
        }
    } else {
        // Redirect back if details are wrong
        header("Location: forgot_password.php?msg=Email or Security Answer is incorrect.");
        exit();
    }
} else {
    header("Location: forgot_password.php");
    exit();
}
?>