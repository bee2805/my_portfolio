<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Luique Large Image Widget.
 *
 * @since 1.0
 */
class Luique_Large_Image_Widget extends Widget_Base {

	public function get_name() {
		return 'luique-large-image';
	}

	public function get_title() {
		return esc_html__( 'Large Image', 'luique-plugin' );
	}

	public function get_icon() {
		return 'eicon-parallax';
	}

	public function get_categories() {
		return [ 'luique-category' ];
	}

	/**
	 * Register widget controls.
	 *
	 * @since 1.0
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_tab',
			[
				'label' => esc_html__( 'Content', 'luique-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'image',
			[
				'label'       => esc_html__( 'Image', 'luique-plugin' ),
				'type'        => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->end_controls_section();
	}


	/**
	 * Render widget output on the frontend.
	 *
	 * @since 1.0
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<?php if ( $settings['image'] ) : $image = wp_get_attachment_image_url( $settings['image']['id'], 'luique_1920xAuto' ); ?>
		<!-- Image Large -->
		<div class="m-image-large">
			<div class="image">
				<div class="img js-parallax" style="background-image: url(<?php echo esc_url( $image ); ?>);"></div>
			</div>
		</div>
		<?php endif; ?>

		<?php
	}

}

Plugin::instance()->widgets_manager->register( new Luique_Large_Image_Widget() );
