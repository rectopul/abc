
 <?php
 /**
  * The template for displaying all single posts
  *
  * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
  *
  * @package auaha
   * Template Name: contact
  */
 get_header(); ?>
<div class="contact__container">
    <h1>Entre em contato conosco</h1>

    <div class="contact__form">
        <?php echo do_shortcode('[contact-form-7 id="28" title="Contact"]'); ?>    
        
    </div>

</div>
<?php get_footer(); ?>
