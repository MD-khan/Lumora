<?php
$hero_title = get_theme_mod( 'lumora_hero_title', __( 'Welcome to Lumora', 'lumora' ) );
$hero_bg    = get_theme_mod( 'lumora_hero_bg', '' );
?>

<div class="hero-section" style="background-image: url('<?php echo esc_url( $hero_bg ); ?>');">
    <div class="hero-content">
        <h1 class="hero-title"><?php echo esc_html( $hero_title ); ?></h1>
        <p class="hero-description">Your trusted WordPress theme.</p>
        <a href="#" class="hero-button">Learn More</a>
    </div>
</div>
