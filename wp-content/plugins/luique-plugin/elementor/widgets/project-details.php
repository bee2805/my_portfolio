<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Luique Project Details Widget.
 *
 * @since 1.0
 */
class Luique_Project_Details_Widget extends Widget_Base {

	public function get_name() {
		return 'luique-project-details';
	}

	public function get_title() {
		return esc_html__( 'Project Details', 'luique-plugin' );
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

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title', [
				'label_block' => true,
				'label' => esc_html__( 'Name', 'luique-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Enter name', 'luique-plugin' ),
				'placeholder' => esc_html__( 'Enter name', 'luique-plugin' ),
			]
		);

		$repeater->add_control(
			'text', [
				'label_block' => true,
				'label' => esc_html__( 'Value', 'luique-plugin' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Enter value', 'luique-plugin' ),
				'placeholder' => esc_html__( 'Enter value', 'luique-plugin' ),
			]
		);

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Items', 'luique-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_styling',
			[
				'label'     => esc_html__( 'Items', 'luique-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'item_label_color',
			[
				'label'     => esc_html__( 'Name Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .m-details .details-label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_label_typography',
				'label'     => esc_html__( 'Name Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .m-details .details-label',
			]
		);

		$this->add_control(
			'item_value_color',
			[
				'label'     => esc_html__( 'Value Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .m-details .details-label strong' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_value_typography',
				'label'     => esc_html__( 'Value Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .m-details .details-label strong',
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

		<!-- Details -->
		<div class="m-details">
			<?php if ( $settings['items'] ) : ?>
			<?php foreach ( $settings['items'] as $index => $item ) :
			   $item_title = $this->get_repeater_setting_key( 'title', 'items', $index );
			   $this->add_inline_editing_attributes( $item_title, 'basic' );

			   $item_text = $this->get_repeater_setting_key( 'text', 'items', $index );
			   $this->add_inline_editing_attributes( $item_text, 'basic' );
			?>
			<div class="details-label">
				<?php if ( $item['title'] ) : ?>
				<span <?php echo $this->get_render_attribute_string( $item_title ); ?>>
					<?php echo wp_kses_post( $item['title'] ); ?>
				</span>
				<?php endif; ?>
				<?php if ( $item['text'] ) : ?>
				<strong><span <?php echo $this->get_render_attribute_string( $item_text ); ?>>
					<?php echo wp_kses_post( $item['text'] ); ?>
				</span></strong>
				<?php endif; ?>
			</div>
			<?php endforeach; ?>
			<?php endif; ?>
		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Luique_Project_Details_Widget() );
