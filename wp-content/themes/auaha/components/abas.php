<div class="tab1 tabs first-tab">
    <?php
            $args = array(
                'posts_per_page' => 1, // -1 Mostrar todos
                'order' => 'desc',
                'post_type' => 'banner',
                'p' => 149
            );
            $wp_query = new WP_Query($args);
            if ($wp_query->have_posts()) {
                while ($wp_query->have_posts()) {
                    $wp_query->the_post();
                    ?>
                    <div class="post--left">
                        <?php
                            $image = get_field('imagem_banner');
                            if( !empty($image) ): ?>
                                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                            <?php endif; ?>
                    </div>
                    <div class="conteudo--post">
                        <div class="post--alinha_right">
                            <div class="post--right">
                                <span class="aba--titulo"><?php the_field('titulo_banner'); ?></span>
                                <p class="aba--texto"><?php the_field('texto_banner'); ?></p>
                                <ul class="aba--caracteristica">
                                    <li><a href="#"><?php the_field('caracteristica_aba_1'); ?></a></li>
                                    <li><a href="#"><?php the_field('caracteristica_aba_2'); ?></a></li>
                                    <li><a href="#"><?php the_field('caracteristica_aba_3'); ?></a></li>
                                    <li><a href="#"><?php the_field('caracteristica_aba_4'); ?></a></li>
                                </ul>
                            </div>
                        </div>

                       <div class="right__img">
                            <?php
                                $image = get_field('imagem_produto');
                                if( !empty($image) ): ?>
                                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                            <?php endif; ?>
                        </div>
                    </div>

            <?php } }?>
</div>
<div class="tab2 tabs" style="display: none">
    <?php
            $args = array(
                'posts_per_page' => 1, // -1 Mostrar todos
                'order' => 'desc',
                'post_type' => 'banner',
                'p' => 152
            );
            $wp_query = new WP_Query($args);
            if ($wp_query->have_posts()) {
                while ($wp_query->have_posts()) {
                    $wp_query->the_post();
                    ?>
                    <div class="post--left">
                        <?php
                            $image = get_field('imagem_banner');
                            if( !empty($image) ): ?>
                                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                            <?php endif; ?>
                    </div>
                    <div class="conteudo--post">
                        <div class="post--alinha_right">
                            <div class="post--right">
                                <span class="aba--titulo"><?php the_field('titulo_banner'); ?></span>
                                <p class="aba--texto"><?php the_field('texto_banner'); ?></p>
                                <ul class="aba--caracteristica">
                                    <li><a href="#"><?php the_field('caracteristica_aba_1'); ?></a></li>
                                    <li><a href="#"><?php the_field('caracteristica_aba_2'); ?></a></li>
                                    <li><a href="#"><?php the_field('caracteristica_aba_3'); ?></a></li>
                                    <li><a href="#"><?php the_field('caracteristica_aba_4'); ?></a></li>
                                </ul>
                            </div>
                        </div>

                       <div class="right__img">
                            <?php
                                $image = get_field('imagem_produto');
                                if( !empty($image) ): ?>
                                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                            <?php endif; ?>
                        </div>
                    </div>

            <?php } }?>
</div>

<div class="tab3 tabs" style="display: none">
    <?php
            $args = array(
                'posts_per_page' => 1, // -1 Mostrar todos
                'order' => 'desc',
                'post_type' => 'banner',
                'p' => 153
            );
            $wp_query = new WP_Query($args);
            if ($wp_query->have_posts()) {
                while ($wp_query->have_posts()) {
                    $wp_query->the_post();
                    ?>
                    <div class="post--left">
                        <?php
                            $image = get_field('imagem_banner');
                            if( !empty($image) ): ?>
                                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                            <?php endif; ?>
                    </div>
                    <div class="conteudo--post">
                        <div class="post--alinha_right">
                            <div class="post--right">
                                <span class="aba--titulo"><?php the_field('titulo_banner'); ?></span>
                                <p class="aba--texto"><?php the_field('texto_banner'); ?></p>
                                <ul class="aba--caracteristica">
                                    <li><a href="#"><?php the_field('caracteristica_aba_1'); ?></a></li>
                                    <li><a href="#"><?php the_field('caracteristica_aba_2'); ?></a></li>
                                    <li><a href="#"><?php the_field('caracteristica_aba_3'); ?></a></li>
                                    <li><a href="#"><?php the_field('caracteristica_aba_4'); ?></a></li>
                                </ul>
                            </div>
                        </div>

                       <div class="right__img">
                            <?php
                                $image = get_field('imagem_produto');
                                if( !empty($image) ): ?>
                                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                            <?php endif; ?>
                        </div>
                    </div>

            <?php } }?>
</div>
