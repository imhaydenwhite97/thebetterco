<?php
/* Template Name: Dashboard */
if (!is_user_logged_in()) {
    wp_redirect(home_url('/login-signup'));
    exit;
}
get_header();
?>

<div class="dashboard">
    <h1>Welcome, <?php echo wp_get_current_user()->display_name; ?>!</h1>
    <p>Track your investments and manage your account here.</p>
</div>

<?php get_footer(); ?>
