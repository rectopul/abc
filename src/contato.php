
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
    <h1>Contact</h1>
    <span>
        Our exclusive 3 Wheel System was designed to make it easier to pull the backpack <br/>
        through stairs and ledges, besides increasing its durability.
    </span>

    <div class="contact__form">
        <?php echo do_shortcode('[contact-form-7 id="4" title="Contact"]'); ?>    
        <div class="footer__container">
                <div class="links__footer">
                    <ul>
                        <li><a href="#"><img src="<?php bloginfo('template_directory'); ?>/img/fb.png"></a></li>
                        <li><a href="#"><img src="<?php bloginfo('template_directory'); ?>/img/ins.png"></a></li>
                        <li><a href="#"><img src="<?php bloginfo('template_directory'); ?>/img/you.png"></a></li>
                    </ul>
                    <span>sac@maxtoy.com</span>
                    
                </div>
                
                <div class="auaha__assinatura">
                    <em class="copyright">© 2018 MaxToy Diplomata</em>
                    <a href="http://www.auaha.com.br" target= "_blank"><img src="<?php bloginfo('template_directory'); ?>/img/auaha.png"></a>
                </div>

            </div>
    </div>

</div>
<?php get_footer(); ?>
