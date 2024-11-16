<?php
/**
 * The header template for the Lumora theme
 *
 * This template displays all of the <head> section and everything up until the opening of the main content area.
 * It is included on all pages using the get_header() WordPress function.
 *
 * @package Lumora
 */
?>
<!DOCTYPE html>
<html lang="<?php language_attributes(); ?>">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>


<div id="page" class="site">
    <header id="masterhead" class="site-header" role="banner">
    <?php get_template_part( get_template_part('template-parts/header/nav') ); ?>
    </header>
    <div id="content" class="site-content">

