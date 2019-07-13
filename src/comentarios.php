
 <?php
 /**
  * The template for displaying all single posts
  *
  * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
  *
  * @package auaha
   * Template Name: Comentarios
  */
 get_header(); ?>
<?php comment_form(); ?>
 <!-- Include newsletter -->
 <?php include('components/newsletter.php'); ?>
 <?php get_footer(); ?>
