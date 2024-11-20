<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="header-container">
        <h1 class="site-title"><a href="<?php echo home_url(); ?>">Blogger Blog</a></h1>
        <nav class="navbar">
            <ul class="nav-menu">
                <li><a href="<?php echo home_url('/?page=landing'); ?>">Landing</a></li>
                <li><a href="<?php echo home_url('/?page=home'); ?>">Home</a></li>
                <li><a href="<?php echo home_url('/?page=blogs'); ?>">Blogs</a></li>
                <li><a href="<?php echo home_url('/?page=videos'); ?>">Videos</a></li>
                <li><a href="<?php echo home_url('/?page=audios'); ?>">Audios</a></li>
                <li><a href="<?php echo home_url('/?page=profile'); ?>">Profile</a></li>
            </ul>
        </nav>
        <div class="menu-toggle" onclick="toggleMenu()">☰</div>
    </div>
</header>

<div id="mobile-menu-overlay" onclick="toggleMenu()">
    <div class="mobile-menu-content">
        <?php
            wp_nav_menu(array(
                'theme_location' => 'header-menu',
                'container' => false,
                'menu_class' => 'mobile-nav-menu',
            ));
        ?>
    </div>
</div>

<!-- Removed <main> tag and dynamic content logic from header.php -->
<!-- This ensures that header.php only handles the header section -->

<script>
    function toggleMenu() {
        document.getElementById('mobile-menu-overlay').classList.toggle('open');
    }
</script>

<?php wp_footer(); ?>
</body>
</html>
