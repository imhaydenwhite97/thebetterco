<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="main-nav">
        <div class="container">
            <div class="nav-wrapper">
                <div class="logo">
                    <a href="<?php echo home_url(); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/better-logo.svg" alt="The Better Co">
                    </a>
                </div>
                
                <div class="nav-buttons">
                    <a href="/login" class="nav-login">Log in</a>
                    <a href="/signup" class="nav-signup">Sign up</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="secondary-nav">
        <div class="container">
            <nav class="page-links">
                <div class="main-links">
                    <a href="/invest">Invest</a>
                    <a href="/properties">Properties</a>
                    <a href="/returns">Returns</a>
                </div>
                <div class="secondary-links">
                    <a href="/learn">Learn</a>
                    <a href="/about">About</a>
                    <a href="/help">Help</a>
                </div>
            </nav>
        </div>
    </div>
</header>

<script>
let lastScroll = 0;
const header = document.querySelector('.site-header');

window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset;
    
    if (currentScroll > lastScroll && currentScroll > 100) {
        header.classList.add('nav-hidden');
    } else {
        header.classList.remove('nav-hidden');
    }
    
    lastScroll = currentScroll;
});
</script>
