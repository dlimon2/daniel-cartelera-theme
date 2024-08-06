<?php
/* Daniel Cartelera 2 functions and definitions */

function daniel_cartelera_cpt_init() {
    /* Custom Post Types: Teatros y Obras */

    //Teatros
    $teatros_args = array(
        'label' => 'Teatros',
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'has_archive' => true,
        'rewrite' => array('slug' => 'teatros'),
        'menu_icon' => 'dashicons-art',
        'menu_position' => 0,
        'show_in_rest' => true);

    register_post_type('teatros', $teatros_args);

    $obras_taxonomy_labels = array(
        'name' => _x('Obras', 'Post Type General Name', 'textdomain'),
        'singular_name' => _x('Obra', 'Post Type Singular Name', 'textdomain'),
        'menu_name' => __('Obras', 'textdomain'),
        'name_admin_bar' => __('Obra', 'textdomain'),
        'archives' => __('Archivo de Obras', 'textdomain'),
        'attributes' => __('Atributos de Obras', 'textdomain'),
        'parent_item_colon' => __('Obra Padre:', 'textdomain'),
        'all_items' => __('Todas las Obras', 'textdomain'),
        'add_new_item' => __('Añadir Nueva Obra', 'textdomain'),
        'add_new' => __('Añadir Nueva', 'textdomain'),
        'new_item' => __('Nueva Obra', 'textdomain'),
        'edit_item' => __('Editar Obra', 'textdomain'),
        'update_item' => __('Actualizar Obra', 'textdomain'),
        'view_item' => __('Ver Obra', 'textdomain'),
        'view_items' => __('Ver Obras', 'textdomain'),
        'search_items' => __('Buscar Obra', 'textdomain'),
        'not_found' => __('No encontrado', 'textdomain'),
        'not_found_in_trash' => __('No encontrado en la papelera', 'textdomain'),
        'featured_image' => __('Imagen destacada', 'textdomain'),
        'set_featured_image' => __('Establecer imagen destacada', 'textdomain'),
        'remove_featured_image' => __('Eliminar imagen destacada', 'textdomain'),
        'use_featured_image' => __('Usar como imagen destacada', 'textdomain'),
        'insert_into_item' => __('Insertar en la obra', 'textdomain'),
        'uploaded_to_this_item' => __('Subido a esta obra', 'textdomain'),
        'items_list' => __('Lista de obras', 'textdomain'),
        'items_list_navigation' => __('Navegación de lista de obras', 'textdomain'),
        'filter_items_list' => __('Filtrar lista de obras', 'textdomain'),
    );

    $obras_args = array(
        'label' => 'Obra',
        'labels' => $obras_taxonomy_labels,
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'has_archive' => true,
        'rewrite' => array('slug' => 'obras'),
        'menu_icon' => 'dashicons-tickets-alt',
        'menu_position' => 0,
        'show_in_rest' => true);
    
    register_post_type('obras', $obras_args);
}
add_action('init', 'daniel_cartelera_cpt_init');

function obras_cpt_taxonimy_init() {
    register_taxonomy_for_object_type('category', 'obras');
}
add_action('init', 'obras_cpt_taxonimy_init');  


function daniel_cartelera_customfields_init() {
    /* Custom Fields for Teatros and Obras Post Types */
    add_meta_box(
        $id = 'teatro_meta',
        $title = 'Información del Teatro',
        $callback = 'daniel_cartelera_teatro_meta_box',
        $screen = 'teatros',
        $context = 'side',
        $priority = 'high',
    
    );  

    add_meta_box(
        $id = 'obra_meta',
        $title = 'Información de la Obra',
        $callback = 'daniel_cartelera_obra_meta_box',
        $screen = 'obras',
        $context = 'side',
        $priority = 'high',
    
    );

    // Relación obra-teatro
    add_meta_box(
        $id = 'relacion_obra_teatro',
        $title = 'Seleccionar Teatro',
        $callback = 'daniel_cartelera_relacion_obra_teatro',
        $screen = 'obras',
        $context = 'side',
        $priority = 'default',
    
    );

}
add_action('add_meta_boxes', 'daniel_cartelera_customfields_init');

function daniel_cartelera_relacion_obra_teatro($post) {
    $teatro_asociado = get_post_meta($post->ID, '_teatro_asociado', true);
    $teatros = get_posts(array(
        'post_type' => 'teatros',
        'numberposts' => -1
    ));

    echo '<label for="teatro_asociado">Teatro:</label>';
    echo '<select id="teatro_asociado" name="teatro_asociado">';
    foreach ($teatros as $teatro) {
        echo '<option value="' . $teatro->ID . '" ' . selected($teatro_asociado, $teatro->ID, false) . '>' . $teatro->post_title . '</option>';
    }
    echo '</select>';
}

function daniel_carelera_save_relacion_obra_teatro($post_id) {
    if (array_key_exists('teatro_asociado', $_POST)) {
        update_post_meta(
            $post_id,
            '_teatro_asociado',
            intval($_POST['teatro_asociado'])
        );
    }
}
add_action('save_post', 'daniel_carelera_save_relacion_obra_teatro');

function daniel_cartelera_teatro_meta_box($post) {
    $direccion = get_post_meta($post->ID, '_direccion', true);
    echo '<label for="direccion">Dirección:</label>';
    echo '<input type="text" id="direccion" name="direccion" value="' . esc_attr($direccion) . '" />  ';

    $telefono = get_post_meta($post->ID, '_telefono', true);
    echo '<label for="telefono">Teléfono:</label>';
    echo '<input type="text" id="telefono" name="telefono" value="' . esc_attr($telefono) . '" />  ';

    $sitio_web = get_post_meta($post->ID, '_sitio_web', true);
    echo '<label for="sitio_web">Sitio Web:</label>';
    echo '<input type="text" id="sitio_web" name="sitio_web" value="' . esc_attr($sitio_web) . '" />    ';
}

function daniel_cartelera_obra_meta_box($post) {

    $en_cartelera = get_post_meta($post->ID, '_en_cartelera', true);
    echo '<label for="en_cartelera">En Cartelera:</label>';
    echo '<input type="checkbox" id="en_cartelera" name="en_cartelera" value="1" ' . checked($en_cartelera, 1, false) . ' /><br />';

    $horario = get_post_meta($post->ID, '_horario', true);
    echo '<label for="horario">Horario:</label>';
    echo '<input type="text" id="horario" name="horario" value="' . esc_attr($horario) . '" />  ';

    $precio = get_post_meta($post->ID, '_precio', true);
    echo '<label for="precio">Precio:</label>';
    echo '<input type="text" id="precio" name="precio" value="' . esc_attr($precio) . '" />  ';
}

function daniel_cartelera_save_metabox($post_id) {

    // Teatro Meta
    if (array_key_exists('direccion', $_POST)) {
        update_post_meta(
            $post_id,
            '_direccion',
            sanitize_text_field($_POST['direccion'])
        );
    }
    if (array_key_exists('telefono', $_POST)) {
        update_post_meta(
            $post_id,
            '_telefono',
            sanitize_text_field($_POST['telefono'])
        );
    }
    if (array_key_exists('sitio_web', $_POST)) {
        update_post_meta(
            $post_id,
            '_sitio_web',
            sanitize_text_field($_POST['sitio_web'])
        );
    }

    // Obra Meta
    if (array_key_exists('en_cartelera', $_POST)) {
        update_post_meta(
            $post_id,
            '_en_cartelera',
            1
        );
    } else {
        update_post_meta(
            $post_id,
            '_en_cartelera',
            0
        );
    }
    if (array_key_exists('horario', $_POST)) {
        update_post_meta(
            $post_id,
            '_horario',
            sanitize_text_field($_POST['horario'])
        );
    }
    if (array_key_exists('precio', $_POST)) {
        update_post_meta(
            $post_id,
            '_precio',
            sanitize_text_field($_POST['precio'])
        );
    }
}
add_action('save_post', 'daniel_cartelera_save_metabox');

function daniel_cartelera_banners_init(){

    // Registro del primer área de widget para el banner arriba del header
    register_sidebar( array(
        'name'          => __( 'Banner Top Header 1', 'daniel-cartelera-2' ),
        'id'            => 'banner-top-header-1',
        'description'   => __( 'Agrega un widget aquí para aparecer en tu primer banner arriba del header.', 'daniel-cartelera-2' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    // Registro del segundo área de widget para el banner arriba del header
    register_sidebar( array(
        'name'          => __( 'Banner Top Header 2', 'daniel-cartelera-2' ),
        'id'            => 'banner-top-header-2',
        'description'   => __( 'Agrega un widget aquí para aparecer en tu segundo banner arriba del header.', 'daniel-cartelera-2' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    // Registro del primer área de widget para el banner abajo del header
    register_sidebar( array(
        'name'          => __( 'Banner Bottom Header 1', 'daniel-cartelera-2' ),
        'id'            => 'banner-bottom-header-1',
        'description'   => __( 'Agrega un widget aquí para aparecer en tu primer banner abajo del header.', 'daniel-cartelera-2' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    // Registro del segundo área de widget para el banner abajo del header
    register_sidebar( array(
        'name'          => __( 'Banner Bottom Header 2', 'daniel-cartelera-2' ),
        'id'            => 'banner-bottom-header-2',
        'description'   => __( 'Agrega un widget aquí para aparecer en tu segundo banner abajo del header.', 'daniel-cartelera-2' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'daniel_cartelera_banners_init' );