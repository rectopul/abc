<div class="about">
    <div class="container content--about">
        <div class="text--about">
            <div class="content--about_left">
            <img src="<?php bloginfo('template_directory'); ?>/img/logo_about.png">
            <?php
                $args = array(
                    'posts_per_page' => 1, // -1 Mostrar todos
                    'order' => 'desc',
                    'post_type' => 'post',
                    'p' => 118
                );
                $wp_query = new WP_Query($args);
                if ($wp_query->have_posts()) {
                    while ($wp_query->have_posts()) {
                        $wp_query->the_post();
            ?>
            <div class="content--about_texto">
                <?php the_content(); ?>
            </div>
            <?php } }?>
        </div>
        </div>
        <div class="content--about_right">
                <h1>Opnião de quem já comprou</h1>
                <h2>Avaliações</h2>
                <div class="media--gereal">
                    <div class="media--number">
                        <span>5.0</span>/ 5.0
                    </div>
                    <div class="estrelas">
                        <span class="mr-star-rating">
                            <i class="fa fa-star mr-star-full"></i>
                            <i class="fa fa-star mr-star-full"></i>
                            <i class="fa fa-star mr-star-full"></i>
                            <i class="fa fa-star mr-star-full"></i>
                            <i class="fa fa-star mr-star-full"></i>
                        </span> (3)
                    </div>
                </div>
                <?php
                    $args = array(
                        'posts_per_page' => -1, // -1 Mostrar todos
                        'order' => 'desc',
                        'post_type' => 'produto'
                    );
                    $wp_query = new WP_Query($args);
                    if ($wp_query->have_posts()) {
                        while ($wp_query->have_posts()) {
                            $wp_query->the_post();
                ?>
                <?php
                    $postID = $post->ID;

                    $comment_array = get_approved_comments($postID);
                    $title = get_the_title();

                    foreach ($comment_array as $comment) {
                        echo('<div class="list"><p class="coments-p">

                        <span class="comentario-autor">' . $comment->comment_content . '</span></p>

                        <span class="comentario-autor">
                            <span class="autor-coment">' . $comment->comment_author . '</span>
                            <span class="nome--post">' . $title                   . '</span>
                        </span>

                        </div>');
                    }
                ?>
                <?php } }?>

                <div class="btn-avaliacao">
                    <a href="<?php bloginfo('template_directory'); ?>/produto" class="avaliar">Deixe sua avaliação</a>
                </div>
        </div>
    </div>
</div>
