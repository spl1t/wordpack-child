<?php 

add_action('wp_enqueue_scripts', function () {
    // CSS
    wp_enqueue_style(
        'child_styles', // идентификатор стиля
        get_stylesheet_directory_uri() . '/dist/main.css',  // URL стиля
        array(), // без зависимостей
        scriptEnvVersion() // версия
    );

    wp_enqueue_style(
        'parent_styles', // идентификатор стиля
        get_template_directory_uri() . '/dist/main.css',  // URL стиля
        array(), // без зависимостей
        scriptEnvVersion() // версия
    );

    // JavaScript
    wp_enqueue_script(
        'child_scripts', // идентификатор скрипта
        get_stylesheet_directory_uri() . '/dist/main.js', // URL скрипта
        array(), // без зависимостей
        scriptEnvVersion(), // версия
        true
    );

    wp_enqueue_script(
        'parent_scripts', // идентификатор скрипта
        get_template_directory_uri() . '/dist/main.js', // URL скрипта
        array(), // без зависимостей
        scriptEnvVersion(), // версия
        true
    );
});



// Create demo page and home page set
if (isset($_GET['activated']) && is_admin()) {
    // Home page create
    $home_page_title = 'Главная';
    $home_page_check = get_page_by_title($home_page_title);

    $home_page = array(
        'post_type' => 'page',
        'post_title' => $home_page_title,
        'post_status' => 'publish',
        'post_author' => 1,
    );

    if (!isset($home_page_check->ID)) {
        //Add demo page
        $new_page_id = wp_insert_post($home_page);
        //Change template for demo page
        update_post_meta($new_page_id, '_wp_page_template', '/page-templates/home.php');
        //Change home page
        $homepage = get_page_by_title($home_page_title);
        update_option('page_on_front', $homepage->ID);
        update_option('show_on_front', 'page');
    }


}