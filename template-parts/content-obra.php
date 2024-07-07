<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="dc-blog-post-wrap">

		<div class="dc-post-content">
			<!-- <header class="entry-header">
			</header> -->

			<div class="entry-content">
				<?php


					the_content( sprintf(
						/* translators: %s: Name of current post. */
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'kids-education' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );
					// // Obras de teatro
					// // Asegúrate de estar dentro del Loop de WordPress para que get_the_ID() funcione correctamente.
					// $_id_actual = get_the_ID();

					// // Buscar obras relacionadas con este teatro.
					// $obras_relacionadas = get_posts(array(
					// 	'post_type' => 'obras', // Asumiendo que el tipo de post para las obras es 'obras'.
					// 	'numberposts' => -1, // Obtener todas las obras relacionadas.
					// 	'meta_query' => array(
					// 		array(
					// 			'key' => '_teatro_asociado', // El nombre del campo personalizado que almacena el ID del teatro asociado.
					// 			'value' => $teatro_id_actual,
					// 			'compare' => '=',
					// 		),
					// 	),
					// ));

					// // Verificar si hay obras relacionadas y mostrarlas.
					// if (!empty($obras_relacionadas)) :
						
					// 	//echo '<h3>Obras:</h3>';
					// 	//echo '<strong>Obras:</strong>';
					// 	echo '<div class="dc-cards-wrapper">'; // Contenedor para las tarjetas
					// 	foreach ($obras_relacionadas as $obra) {
					// 		echo '<div class="dc-card">';
					// 		echo '<img src="' . get_the_post_thumbnail_url($obra->ID) . '" alt="' . get_the_title($obra->ID) . '" class="card-img-top">'; // Imagen de la obra
					// 		echo '<div class="dc-card-body">';
					// 		echo '<h5 class="dc-card-title"><a href="' . get_permalink($obra->ID) . '">' . get_the_title($obra->ID) . '</a></h5>';
					// 		// Aquí puedes añadir más información de la obra como fecha, lugar, etc.
					// 		echo '</div>'; // .card-body
					// 		echo '</div>'; // .card
					// 	}
					// 	echo '</div>'; // .cards-wrapper
					// 	echo '</div>'; // .obras-relacionadas
					// endif;

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'kids-education' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->
			<?php
				/**
				 * Hook kids_education_author_profile
				 *  
				 * @hooked kids_education_get_author_profile 
				 */
				//do_action( 'kids_education_author_profile' );
			?>
			<footer class="entry-footer">
				<?php kids_education_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</div>

		<div class="dc-post-thumbnail">
			<?php //kids_education_get_thumbnail_image(); // get thumbnail images ?>
			<?php
			if ( 'obras' === get_post_type() ) :
				
				$horario = get_post_meta( get_the_ID(), '_horario', true );
				$precio = get_post_meta( get_the_ID(), '_precio', true );
				$en_cartelera = get_post_meta( get_the_ID(), '_en_cartelera', true );?>

				<div class="obra-meta">
					<?php kids_education_get_thumbnail_image(); ?>
					<?php if (!empty($en_cartelera) && $en_cartelera) : ?>
							<p class="teatro-sitio-web"><strong>🎭 En Cartelera</strong> </p>
					<?php endif; ?>
					<?php if (!empty($horario)) : ?>
						<p class="obra-horario"><strong>⌚ Horario:</strong> <?php echo esc_html( $horario ); ?></p>
					<?php endif; ?>
					<?php if (!empty($precio)) : ?>
						<p class="teatro-telefono"><strong>🎫 Precio:</strong> <?php echo esc_html( $precio ); ?></p>
					<?php endif; ?>

				</div>
			<?php endif; ?>
		</div>
	</div><!-- .blog-post-wrap -->
</article><!-- #post-## -->
