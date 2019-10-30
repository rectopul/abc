<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package auaha
 */

?>

	</div>
	<footer class="footer">
        <div class="footer__left">
            <a href="/"><img src="<?php bloginfo('template_directory'); ?>/img/logof.png"></a>
            <ul>
                <li><a href="/">Sobre nós</a></li>
                <li><a href="/">Como funciona</a></li>
                <li><a href="/">Serviços</a></li>
                <li><a href="/">Profissionais</a></li>
                <li><a href="/">Sou profissional</a></li>
                <li><a href="/">Termos & condições</a></li>
                <li><a href="/">Fale conosco</a></li>
            </ul>
             
            <ul>
                <li>
                    <strong>Endereço:</strong>
                    <span>Rua hdtdgsdneif, 543, conjunto 543, Pinheiros, São Paulo - SP</span>
                </li>
                <li>
                    <strong>Contato:</strong>
                    <span>Rafaella@mynest.com.br</span>
                    <span>Marcelle@mynest.com.br</span>
                </li>
            </ul>
        </div>
        <div class="footer__right">
            <ul>
                <li><a href="/"><img src="<?php bloginfo('template_directory'); ?>/img/face.png"></a></li>
                <li><a href="/"><img src="<?php bloginfo('template_directory'); ?>/img/tw.png"></a></li>
                <li><a href="/"><img src="<?php bloginfo('template_directory'); ?>/img/google.png"></a></li>
                <li><a href="/"><img src="<?php bloginfo('template_directory'); ?>/img/in.png"></a></li>
            </ul>

            
        </div>
	</footer>
</div>
<?php wp_footer(); ?> 

<script>
    var slidebar_width  = 300; //slidebar width + padding size
    var slide_bar       = $(".side-menu-wrapper"); //slidebar
    var slide_open_btn  = $(".slide-menu-open"); //slidebar close btn
    var slide_close_btn = $(".menu-close"); //slidebar close btn
    var overlay         = $(".side-menu-overlay"); //slidebar close btn

    slide_open_btn.click(function(e){
        e.preventDefault();
        slide_bar.css( {"left": "0px"}); //change to "right" for right positioned menu
        overlay.css({"opacity":"1", "width":"100%"});
    });

    slide_close_btn.click(function(e){
        e.preventDefault();
        slide_bar.css({"left": "-"+ slidebar_width + "px"}); //change to "right" for right positioned menu
        overlay.css({"opacity":"0", "width":"0"});
    });

    $('.depoimentos__list').slick({
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: 3,  
        arrows: false,
        responsive: [
    {
      breakpoint: 991,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    }

  ]
    });
    

    $('.list__service li').on('click', function(){
        $('.list__service li').removeClass('active__aba');
        $(this).addClass('active__aba');

        var abaselect = $(this).attr('data-layer');
        
        $('.list__post').each(function(){
            var el = $(this).find('[data-layer="' + abaselect + '"]');
            $('.list__post > div').hide();
            el.show();
            
        });
    });

    
</script>

</body>
</html>
