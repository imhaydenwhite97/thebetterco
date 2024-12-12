<?php
// Handle User Login
function handle_user_login() {
    $username = sanitize_text_field($_POST['username']);
    $password = sanitize_text_field($_POST['password']);
    $user = wp_signon(array(
        'user_login' => $username,
        'user_password' => $password,
        'remember' => true,
    ));

    if (is_wp_error($user)) {
        wp_redirect(home_url('/login-signup?login=failed'));
    } else {
        wp_redirect(home_url('/dashboard'));
    }
    exit;
}
add_action('admin_post_nopriv_user_login', 'handle_user_login');

// Handle User Signup
function handle_user_signup() {
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $age = intval($_POST['age']);
    $phone = sanitize_text_field($_POST['phone']);
    $address = sanitize_text_field($_POST['address']);
    $password = sanitize_text_field($_POST['password']);

    $user_id = wp_create_user($email, $password, $email);
    if (is_wp_error($user_id)) {
        wp_redirect(home_url('/login-signup?signup=failed'));
    } else {
        update_user_meta($user_id, 'full_name', $name);
        update_user_meta($user_id, 'age', $age);
        update_user_meta($user_id, 'phone', $phone);
        update_user_meta($user_id, 'address', $address);
        wp_redirect(home_url('/dashboard'));
    }
    exit;
}
add_action('admin_post_nopriv_user_signup', 'handle_user_signup');
?>
