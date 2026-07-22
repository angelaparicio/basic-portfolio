<?php
/**
 * Lógica de renderizado para el Shortcode y futuros Bloques de Gutenberg.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Basic_Portfolio_Shortcode {

	/**
	 * Registra el shortcode en WordPress.
	 */
	public function init() {
		add_shortcode( 'show_portfolio', array( $this, 'render' ) );
	}

	/**
	 * Renderiza el listado de trabajos del portafolio.
	 * Este método servirá tanto para el Shortcode [show_portfolio]
	 * como para el 'render_callback' del futuro Bloque de Gutenberg.
	 *
	 * @param array $atts Atributos enviados desde el shortcode o bloque.
	 * @return string HTML resultante.
	 */
	public function render( $atts = array() ) {
		// 1. Normalización de atributos con valores por defecto
		$atts = shortcode_atts(
			array(
				'posts_per_page' => 20,
				'category'       => '',
			),
			$atts,
			'show_portfolio'
		);

		// 2. Construcción de la consulta
		$query_args = array(
			'post_type'      => 'work-portfolio',
			'posts_per_page' => intval( $atts['posts_per_page'] ),
			'post_status'    => 'publish',
		);

		if ( ! empty( $atts['category'] ) ) {
			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'categories-work-portfolio',
					'field'    => 'slug',
					'terms'    => sanitize_text_field( $atts['category'] ),
				),
			);
		}

		$portfolio_query = new WP_Query( $query_args );

		if ( ! $portfolio_query->have_posts() ) {
			return '<p class="basic-portfolio-no-results">' . esc_html__( 'No se encontraron trabajos.', 'basic-portfolio' ) . '</p>';
		}

		// 3. Captura del búfer de salida (Evita concatenaciones HTML molestas)
		ob_start();
		?>
		<div class="work-portfolio-wrapper">
			<?php
			while ( $portfolio_query->have_posts() ) :
				$portfolio_query->the_post();
				$post_id = get_the_ID();

				// Lógica simplificada de años
				$start_year = get_post_meta( $post_id, 'work_start_year', true );
				$end_year   = get_post_meta( $post_id, 'work_end_year', true );
				
				// Filtra valores vacíos y los une con un guion
				$years_array = array_filter( array( $start_year, $end_year ) );
				$years_str   = ! empty( $years_array ) ? ' (' . implode( ' - ', array_map( 'esc_html', $years_array ) ) . ')' : '';
				?>
				<div id="work-portfolio-element-<?php echo esc_attr( $post_id ); ?>" class="work-portfolio-element">
					<a href="<?php echo esc_url( get_permalink() ); ?>">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="work-portfolio-image">
								<?php the_post_thumbnail( 'medium' ); ?>
							</div>
						<?php endif; ?>
						
						<div class="work-portfolio-title">
							<?php the_title(); ?>
							<?php echo esc_html( $years_str ); ?>
						</div>
					</a>
				</div>
			<?php
			endwhile;
			wp_reset_postdata(); // Restaura la consulta global de WordPress
			?>
		</div>
		<?php

		return ob_get_clean();
	}
}

// Inicializar módulo
$basic_portfolio_shortcode = new Basic_Portfolio_Shortcode();
$basic_portfolio_shortcode->init();