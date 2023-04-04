<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Luique BG Title Widget.
 *
 * @since 1.0
 */
class Luique_BG_Title_Widget extends Widget_Base {

	public function get_name() {
		return 'luique-bgtitle';
	}

	public function get_title() {
		return esc_html__( 'BG Title', 'luique-plugin' );
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
			'bgtitle_tab',
			[
				'label' => esc_html__( 'BG Title', 'luique-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'bgtitle',
			[
				'label'       => esc_html__( 'Title', 'luique-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter Title', 'luique-plugin' ),
				'default'     => esc_html__( 'Title', 'luique-plugin' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'bgtitle_styling',
			[
				'label'     => esc_html__( 'BG Title', 'luique-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'name_color',
			[
				'label'     => esc_html__( 'Title Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .lui-bgtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'name_typography',
				'label'     => esc_html__( 'Title Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .lui-bgtitle',
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

		$this->add_inline_editing_attributes( 'bgtitle', 'basic' );

		?>

		<?php if ( $settings['bgtitle'] ) : ?>
		<div class="lui-bgtitle">
			<span <?php echo $this->get_render_attribute_string( 'bgtitle' ); ?>>
				<?php echo wp_kses_post( $settings['bgtitle'] ); ?>
			</span>
		</div>
		<?php endif; ?>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Luique_BG_Title_Widget() );
