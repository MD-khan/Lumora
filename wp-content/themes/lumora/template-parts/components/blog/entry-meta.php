<?php
/**
 * Template part for displaying entry meta information (date and author)
 *
 * @package Lumora
 */
?>

<div class="entry-meta mb-3">
    <?php 
    echo lumora_get_posted_on(); 
    echo lumora_get_posted_by(); 
    ?>
</div>
