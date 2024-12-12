<?php
/* Template Name: Login-Signup */
if (is_user_logged_in()) {
    wp_redirect(home_url('/dashboard')); // Redirect logged-in users to the dashboard
    exit;
}
get_header();
?>

<style>
/* Inline styles for simplicity - move to style.css for better organization */
.login-signup-container {
    display: flex;
    height: 100vh;
}
.login-signup-left {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 20px;
    background-color: #f8f8f8;
}
.login-signup-right {
    flex: 1;
    background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/your-photo.jpg');
    background-size: cover;
    background-position: center;
}
form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}
form input {
    padding: 10px;
    font-size: 16px;
    width: 100%;
}
button {
    padding: 10px;
    font-size: 16px;
    background-color: #007BFF;
    color: #fff;
    border: none;
    cursor: pointer;
}
button:hover {
    background-color: #0056b3;
}
</style>

<div class="login-signup-container">
    <div class="login-signup-left">
        <h1>Welcome to The Better Co.</h1>
        <p>Choose an option below:</p>
        <button id="login-btn">Log In</button>
        <button id="signup-btn">Sign Up</button>

        <!-- Login Form -->
        <form id="login-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST" style="display: none;">
            <input type="hidden" name="action" value="user_login">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Log In</button>
        </form>

        <!-- Signup Form -->
        <form id="signup-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST" style="display: none;">
            <input type="hidden" name="action" value="user_signup">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="number" name="age" placeholder="Age" required>
            <input type="text" name="phone" placeholder="Phone Number" required>
            <input type="text" name="address" placeholder="Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Sign Up</button>
        </form>
    </div>
    <div class="login-signup-right"></div>
</div>

<script>
document.getElementById('login-btn').addEventListener('click', () => {
    document.getElementById('login-form').style.display = 'flex';
    document.getElementById('signup-form').style.display = 'none';
});
document.getElementById('signup-btn').addEventListener('click', () => {
    document.getElementById('signup-form').style.display = 'flex';
    document.getElementById('login-form').style.display = 'none';
});
</script>

<?php get_footer(); ?>
