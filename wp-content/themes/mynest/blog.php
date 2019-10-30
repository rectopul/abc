
 <?php
 /**
  * The template for displaying all single posts
  *
  * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
  *
  * @package auaha
   * Template Name: about
  */
 get_header(); ?>

<?php if (have_posts()) : the_post(); ?>
    <div class="about__text">
        <h1>Introduction</h1>
        <span>About Maxtoy</span>

        <div class="about__full">
            <div class="content__about">
                <?php the_content(); ?>
            </div>

            <div class="image__about">
                <img src="<?php bloginfo('template_directory'); ?>/img/about.png">
            </div>
        </div>

    </div>

    <ul class="about__pics">
        <li><img src="<?php bloginfo('template_directory'); ?>/img/1.jpg"></li>
        <li><img src="<?php bloginfo('template_directory'); ?>/img/2.jpg"></li>
        <li><img src="<?php bloginfo('template_directory'); ?>/img/3.jpg"></li>
        <li><img src="<?php bloginfo('template_directory'); ?>/img/4.jpg"></li>
        <li><img src="<?php bloginfo('template_directory'); ?>/img/5.jpg"></li>
    </ul>

    <div class="content__compare">
        <div class="compare__item_yellow">
            <div class="compare_text">
                <span><img src="<?php bloginfo('template_directory'); ?>/img/iyellow.png">Product Composition:</span>
                <p>EVA (Ethyl Vinyl Acetate) body, polyester zipper with zinc puller, PVC wheels and aluminum and PVC cart parts.</p>
            </div>
            <div class="foto__prod_compare"><img src="<?php bloginfo('template_directory'); ?>/img/bolsa1.png"></div>
            <div class="foto__prod_compare2"><img src="<?php bloginfo('template_directory'); ?>/img/gp.png"></div>
        </div>
        <div class="compare__item_pink">
            <div class="compare_text">
                <span><img src="<?php bloginfo('template_directory'); ?>/img/ipink.png">Manufacturing:</span>
                <p>Printing, thermoforming, cutting, sewing, cart assembling, quality control and packaging.</p>
            </div>
            <div class="foto__prod_compare"><img src="<?php bloginfo('template_directory'); ?>/img/camaro.png"></div>
            <div class="foto__prod_compare2"><img src="<?php bloginfo('template_directory'); ?>/img/gp2.png"></div>
        </div>
    </div>
    <div class="content__markeplace">
        <h3>Marketplace</h3>
        <hr>
        <span>In Brazil, through differents sales channels:</span>
        <div class="representation__marketplace">
            <ul>
                <li><i><img src="<?php bloginfo('template_directory'); ?>/img/check.png"></i>Online sales (B2B & B2C), www.diplomatashop.com.br;</li>
                <li><i><img src="<?php bloginfo('template_directory'); ?>/img/check.png"></i>Reaching 15,000 retailers in the whole country</li>
            </ul>
        </div>
        <span class="clients__marketplace">Our main retail clients in Brazil are:</span>
        <div class="clients__list">
            <div class="clients__item">
                <div class="clients__item--pic"><img src="<?php bloginfo('template_directory'); ?>/img/cli1.png"></div>
                <div class="clients__item--link"><a href="#">www.kalunga.com.br</a></div>
                <div class="clients__item--desc">office and school supplies - retailer chain</div>
            </div>
            <div class="clients__item">
                <div class="clients__item--pic"><img src="<?php bloginfo('template_directory'); ?>/img/cli2.png"></div>
                <div class="clients__item--link"><a href="#">www.ticae.com.br</a></div>
                <div class="clients__item--desc">gifts - retailer chain</div>
            </div>
            <div class="clients__item">
                <div class="clients__item--pic"><img src="<?php bloginfo('template_directory'); ?>/img/cli3.png"></div>
                <div class="clients__item--link"><a href="#">www.lepostiche.com.br</a></div>
                <div class="clients__item--desc">cases & bags - retailer chain</div>
            </div>
            <div class="clients__item">
                <div class="clients__item--pic"><img src="<?php bloginfo('template_directory'); ?>/img/cli4.png"></div>
                <div class="clients__item--link"><a href="#">www.livrariascuritiba.com.br</a></div>
                <div class="clients__item--desc">bookstore - retailer chain</div>
            </div>
        </div>
    </div>
    <div class="content__world">
        <span><i><img src="<?php bloginfo('template_directory'); ?>/img/www.png"></i>Worldwide</span>
        <p>Maxtoy has its products being offered to Argentina, Colombia, Chile, Singapore, Mexico, Russia, United Arab Emirates, Angola, Ecuador and Venezuela.</p>
    </div>
    <div class="content__world-list">
        <div class="content__world-cert">
            <span>Certifications:</span>
            <div class="content__world-pic"><img src="<?php bloginfo('template_directory'); ?>/img/c1.png"></div>
        </div>
        <div class="content__world-lic">
            <span>Licenses:</span>
            <div class="pic--general">
                <div class="content__world-pic"><img src="<?php bloginfo('template_directory'); ?>/img/l1.png"></div>
                <div class="content__world-pic"><img src="<?php bloginfo('template_directory'); ?>/img/l2.png"></div>
                <div class="content__world-pic"><img src="<?php bloginfo('template_directory'); ?>/img/l3.png"></div>
                <div class="content__world-pic"><img src="<?php bloginfo('template_directory'); ?>/img/l4.png"></div>
                <div class="content__world-pic"><img src="<?php bloginfo('template_directory'); ?>/img/l5.png"></div>
            </div>
        </div>
    </div>

<?php  endif; ?>
 <?php get_footer(); ?>
