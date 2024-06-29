<?php
/* Daniel Cartelera 2 functions and definitions */

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


function custom_header_image() {
    if (is_page()) { // Verifica si estamos en una página
        $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); // Obtiene la URL de la imagen destacada de la página actual

        if ($featured_img_url) { // Si hay una imagen destacada
            // Define la imagen de cabecera con la imagen destacada
            return $featured_img_url;
        }
    }

    // Retorna la imagen de cabecera predeterminada si no estamos en una página o si no hay imagen destacada
    return get_header_image();
}

// Filtra la URL de la imagen de cabecera para usar la imagen destacada de la página si está disponible
add_filter('theme_mod_header_image', 'custom_header_image');