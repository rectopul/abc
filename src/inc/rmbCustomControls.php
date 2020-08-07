<?php

/**
 * Insert all Customizes Panels in one function
 */
function rmb_customize_panels($wp_customize)
{
    $wp_customize->add_panel('panel_home', array(
        'priority'       => 40,
        'capability'     => 'edit_theme_options',
        'title'          => 'Páginas e textos',
        'description'    => 'Editar textos e informações das paginas do site',
    ));
}
add_action('customize_register', 'rmb_customize_panels');

/**
 * Insert all Customizes Sections in one function
 */
function rmb_customize_sections($wp_customize)
{
    $wp_customize->add_section('header_title', array(
        'title'    => __('Home Page', 'auaha'),
        'capability' => 'edit_theme_options',
        'description' => 'Conteúdos da página "Home"',
        'priority' => 2,
        'panel'            => 'panel_home'
    ));

    //$wp_customize->get_section('header_title')->active_callback = 'is_front_page';
}
add_action('customize_register', 'rmb_customize_sections');


/**
 * Insert all Customizes Settings in one function
 */
function rmb_customize_settings($wp_customize)
{
    $wp_customize->add_setting('header_title', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->get_setting('header_title')->transport = 'postMessage';
}
add_action('customize_register', 'rmb_customize_settings');

function rmb_custom_controls($wp_customize)
{

    $wp_customize->add_control(new Skyrocket_TinyMCE_Custom_control($wp_customize, 'header_title', array(
        'label' => __('Texto Header'),
        'type' => 'textarea',
        'description' => __('Titulo apresentado no header da homepage'),
        'section'    => 'header_title',
        'settings'   => 'header_title',
        'input_attrs' => array(
            'toolbar1' => 'undo redo formatselect bold italic fontsizeselect forecolor bullist numlist alignleft aligncenter alignright link',
            'mediaButtons' => true,
        )
    )));

    //$wp_customize->get_control('header_title')->active_callback = 'is_front_page';

    $wp_customize->selective_refresh->add_partial(
        'header_title',
        [
            'selector' => '.headerTitle',
            'render_callback' => 'get_header_message',
            'container_inclusive' => false,
            'fallback_refresh' => false
        ]
    );

    require_once get_template_directory() . '/inc/getThemeMods.php';
}


add_action('customize_register', 'rmb_custom_controls');
