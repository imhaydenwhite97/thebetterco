<?php
/*
Template Name: Login/Signup
*/

// Add body class for login page
add_filter('body_class', function($classes) {
    return array_merge($classes, array('login-signup-page'));
});

get_header();

// Check if user is already logged in
if (is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
}

// Initialize variables
$login_error = '';
$register_error = '';
$register_success = '';

// Handle login form submission
if (isset($_POST['login_submit'])) {
    $creds = array(
        'user_login'    => $_POST['login_username'],
        'user_password' => $_POST['login_password'],
        'remember'      => true
    );

    $user = wp_signon($creds, false);

    if (is_wp_error($user)) {
        $login_error = $user->get_error_message();
    } else {
        wp_redirect(home_url());
        exit;
    }
}

// Handle registration form submission
if (isset($_POST['register_submit'])) {
    $username = sanitize_user($_POST['register_username']);
    $email = sanitize_email($_POST['register_email']);
    $password = $_POST['register_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $register_error = "Passwords do not match.";
    } elseif (username_exists($username)) {
        $register_error = "Username already exists.";
    } elseif (email_exists($email)) {
        $register_error = "Email already exists.";
    } else {
        $user_id = wp_create_user($username, $password, $email);
        if (!is_wp_error($user_id)) {
            $register_success = "Registration successful! You can now log in.";
            // Optional: automatically log in the user
            $creds = array(
                'user_login'    => $username,
                'user_password' => $password,
                'remember'      => true
            );
            $user = wp_signon($creds, false);
            if (!is_wp_error($user)) {
                wp_redirect(home_url());
                exit;
            }
        } else {
            $register_error = $user_id->get_error_message();
        }
    }
}
?>

<div class="login-signup-container">
    <div class="forms-container">
        <!-- Login Form -->
        <div class="login-section">
            <h2>Login</h2>
            <?php if ($login_error) : ?>
                <div class="error-message"><?php echo $login_error; ?></div>
            <?php endif; ?>
            <form method="post" action="" class="login-form">
                <div class="form-group">
                    <input type="text" name="login_username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input type="password" name="login_password" placeholder="Password" required>
                </div>
                <button type="submit" name="login_submit">Login</button>
            </form>
        </div>

        <!-- Registration Form -->
        <div class="register-section">
            <h2>Register</h2>
            <?php if ($register_error) : ?>
                <div class="error-message"><?php echo $register_error; ?></div>
            <?php endif; ?>
            <?php if ($register_success) : ?>
                <div class="success-message"><?php echo $register_success; ?></div>
            <?php endif; ?>
            <form method="post" action="" class="register-form">
                <div class="form-group">
                    <input type="text" name="register_username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input type="email" name="register_email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" name="register_password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                </div>
                <button type="submit" name="register_submit">Register</button>
            </form>
        </div>
    </div>
</div>

<?php get_footer(); ?>
