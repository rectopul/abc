<div class="container post--home">
    <?php
        $args = array(
            'posts_per_page' => 1, // -1 Mostrar todos
            'order' => 'desc',
            'post_type' => 'post',
            'p' => 105
        );
        $wp_query = new WP_Query($args);
        if ($wp_query->have_posts()) {
            while ($wp_query->have_posts()) {
                $wp_query->the_post();
    ?>
        <div class="post--produto_home">
            <div class="post--produto_img"><?php the_post_thumbnail(); ?></div>
            <div class="post--produto_right">
                <div class="produto_right--titulo"><?php the_title(); ?></div>
                <div class="produto_right--texto_curto"><?php the_field('frase_curta'); ?></div>
                <div class="produto_right--texto_longo"><?php the_content(); ?></div>
            </div>
        </div>
    <?php } }?>
</div>

<div class="container post--home">
    <?php
        $args = array(
            'posts_per_page' => 1, // -1 Mostrar todos
            'order' => 'desc',
            'post_type' => 'post',
            'p' => 106
        );
        $wp_query = new WP_Query($args);
        if ($wp_query->have_posts()) {
            while ($wp_query->have_posts()) {
                $wp_query->the_post();
    ?>
        <div class="post--produto_home">
            <div class="post--produto_right--2">
                <div class="produto_right--titulo"><?php the_title(); ?></div>
                <div class="produto_right--texto_curto"><?php the_field('frase_curta'); ?></div>
                <div class="produto_right--texto_longo"><?php the_content(); ?></div>
            </div>
            <div class="post--produto_img"><?php the_post_thumbnail(); ?></div>
        </div>
    <?php } }?>
</div>
