<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Luique Video Widget.
 *
 * @since 1.0
 */
class Luique_Section_Video_Widget extends Widget_Base {

	public function get_name() {
		return 'luique-section-video';
	}

	public function get_title() {
		return esc_html__( 'Section Video', 'luique-plugin' );
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
			'video',
			[
				'label'       => esc_html__( 'Video ID (Youtube)', 'luique-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'	  => 'Gu6z6kIukgg',
				'placeholder' => esc_html__( 'Gu6z6kIukgg', 'luique-plugin' ),
			]
		);

		$this->add_control(
			'image',
			[
				'label'       => esc_html__( 'Video Poster (Image)', 'luique-plugin' ),
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

		if ( $settings['image']['id'] ) {
			$image = wp_get_attachment_image_url( $settings['image']['id'], 'luique_1920xAuto' );
		} else {
			$image = $settings['image']['url'];
		}

		?>

		<!-- Video -->
		<div class="m-video-large">
			<div class="video">
				<?php if ( $image ) : ?>
				<div class="img js-parallax" style="background-image: url(<?php echo esc_url( $image ); ?>);"></div>
				<?php endif; ?>
				<?php if ( $settings['video'] ) : ?>
				<iframe class="js-video-iframe" data-src="https://www.youtube.com/embed/<?php echo esc_attr( $settings['video'] ); ?>?showinfo=0&rel=0&autoplay=1"></iframe>
				<?php endif; ?>
				<div class="play"></div>
			</div>
		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Luique_Section_Video_Widget() );
