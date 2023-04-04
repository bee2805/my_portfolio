<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Luique Heading Widget.
 *
 * @since 1.0
 */
class Luique_Section_Heading_Widget extends Widget_Base {

	public function get_name() {
		return 'luique-section-heading';
	}

	public function get_title() {
		return esc_html__( 'Section Heading', 'luique-plugin' );
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
			'title_tab',
			[
				'label' => esc_html__( 'Title', 'luique-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'       => esc_html__( 'Title Tag', 'luique-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					'h1'  => __( 'H1', 'luique-plugin' ),
					'h2' => __( 'H2', 'luique-plugin' ),
					'div' => __( 'DIV', 'luique-plugin' ),
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'luique-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter title', 'luique-plugin' ),
				'default'     => esc_html__( 'Title', 'luique-plugin' ),
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label'       => esc_html__( 'Subtitle', 'luique-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter Subtitle', 'luique-plugin' ),
				'default'     => esc_html__( 'Subtitle', 'luique-plugin' ),
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'luique-plugin' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'luique-plugin' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'luique-plugin' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'luique-plugin' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
				'default'	=> 'center',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_styling',
			[
				'label'     => esc_html__( 'Title', 'luique-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Title Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .m-titles .m-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'     => esc_html__( 'Title Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .m-titles .m-title',
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label'     => esc_html__( 'SubTitle Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .m-titles .m-subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'label'     => esc_html__( 'SubTitle Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .m-titles .m-subtitle',
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

		$this->add_inline_editing_attributes( 'title', 'basic' );
		$this->add_inline_editing_attributes( 'subtitle', 'basic' );

		?>

		<!-- Section Heading -->
		<?php if ( $settings['title'] || $settings['subtitle'] ) : ?>
		<div class="m-titles">
			<?php if ( $settings['title'] ) : ?>
			<<?php echo esc_attr( $settings['title_tag'] ); ?> class="m-title splitting-text-anim-1 scroll-animate" data-splitting="words" data-animate="active">
				<span <?php echo $this->get_render_attribute_string( 'title' ); ?>>
					<?php echo wp_kses_post( $settings['title'] ); ?>
				</span>
			</<?php echo esc_attr( $settings['title_tag'] ); ?>>
			<?php endif; ?>
			<?php if ( $settings['subtitle'] ) : ?>
			<div class="m-subtitle splitting-text-anim-1 scroll-animate" data-splitting="words" data-animate="active">
				<span <?php echo $this->get_render_attribute_string( 'subtitle' ); ?>>
					<?php echo wp_kses_post( $settings['subtitle'] ); ?>
				</span>
			</div>
			<?php endif; ?>
		</div>
		<?php endif; ?>

		<?php
	}

}

Plugin::instance()->widgets_manager->register( new Luique_Section_Heading_Widget() );
