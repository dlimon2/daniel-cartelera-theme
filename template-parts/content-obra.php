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

				$teatro_asociado_id = get_post_meta( get_the_ID(), '_teatro_asociado', true );

				if (!empty($teatro_asociado_id)) {
					$teatro_post = get_post($teatro_asociado_id);
					if ($teatro_post !== null) {
						$nombre_del_teatro = $teatro_post->post_title;
						$enlace_del_teatro = get_permalink($teatro_asociado_id);
					} else {
						$nombre_del_teatro = 'Teatro no encontrado';
					}
				} else {
					$nombre_del_teatro = 'ID de teatro no proporcionado';
					$enlace_del_teatro = '';
				}
				$horario = get_post_meta( get_the_ID(), '_horario', true );
				$precio = get_post_meta( get_the_ID(), '_precio', true );
				$en_cartelera = get_post_meta( get_the_ID(), '_en_cartelera', true );?>

				<div class="obra-meta">
					<?php kids_education_get_thumbnail_image(); ?>

					<?php if (!empty($teatro_asociado_id)) : ?>
						<p class="obra-teatro-asociado"><strong>🎭 Teatro:</strong> <a href="<?php echo esc_url( $enlace_del_teatro ); ?>"><?php echo esc_html( $nombre_del_teatro ); ?></a></p>
					<?php endif; ?>
					<?php if (!empty($en_cartelera) && $en_cartelera) : ?>
							<p class="teatro-sitio-web"><strong>✅ En Cartelera</strong> </p>
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

				<!-- Obras Destacadas -->
				<?php
				// Consulta las publicaciones de la categoría "obras-destacadas" del CPT "Obras"
				$args = array(
					'post_type' => 'obras',
					'tax_query' => array(
						array(
							'taxonomy' => 'category',
							'field'    => 'slug',
							'terms'    => 'obras-destacadas',
						),
					),
					'posts_per_page' => -1, // Obtener todas las publicaciones
				);

				$obras_destacadas = new WP_Query($args);

				if ($obras_destacadas->have_posts()) : ?>
				<div class="dc-blog-post-wrap">
				<section class="obras-destacadas">
						<h2>Obras Destacadas</h2>
						<div class="dc-cards-wrapper">
							<?php while ($obras_destacadas->have_posts()) : $obras_destacadas->the_post(); ?>
								<div class="dc-card">
									<?php if (has_post_thumbnail()) : ?>
										<div class=".dc-card-img-top">
											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
										</div>
									<?php endif; ?>
									<div class="dc-card-body">
										<h3 class="dc-card-title"><?php the_title(); ?></h3>
										<a href="<?php the_permalink(); ?>" class="card-link">Ver obra</a>
									</div>
								</div>
							<?php endwhile; ?>
						</div>
					</section>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
				</div>
					
