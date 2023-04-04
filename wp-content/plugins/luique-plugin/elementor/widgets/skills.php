<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Luique Resume Widget.
 *
 * @since 1.0
 */
class Luique_Skills_Widget extends Widget_Base {

	public function get_name() {
		return 'luique-skills';
	}

	public function get_title() {
		return esc_html__( 'Skills', 'luique-plugin' );
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
			'skills_tab',
			[
				'label' => esc_html__( 'Skills', 'luique-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'name', [
				'label'       => esc_html__( 'Name', 'luique-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter title', 'luique-plugin' ),
				'default' => esc_html__( 'Enter title', 'luique-plugin' ),
			]
		);

		$repeater->add_control(
			'text', [
				'label'       => esc_html__( 'Description', 'luique-plugin' ),
				'type'        => Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'Enter description', 'luique-plugin' ),
				'default' => esc_html__( 'Enter description', 'luique-plugin' ),
			]
		);

		$repeater->add_control(
			'value', [
				'label'       => esc_html__( 'Value', 'luique-plugin' ),
				'type'        => Controls_Manager::NUMBER,
				'placeholder' => esc_html__( 'Enter value', 'luique-plugin' ),
				'default' => esc_html__( 'Enter value', 'luique-plugin' ),
			]
		);

		$this->add_control(
			'skills',
			[
				'label' => esc_html__( 'Items', 'luique-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ name }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'skills_styling',
			[
				'label'     => esc_html__( 'Skills Items', 'luique-plugin' ),
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
					'{{WRAPPER}} .skills-item .name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'name_typography',
				'label'     => esc_html__( 'Title Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .skills-item .name',
			]
		);

		$this->add_control(
			'value_color',
			[
				'label'     => esc_html__( 'Value Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .skills-item .value .num' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'value_typography',
				'label'     => esc_html__( 'Value Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .skills-item .value .num',
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => esc_html__( 'Text Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .skills-item .text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typography',
				'label'     => esc_html__( 'Text Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .skills-item .text',
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

		$this->add_inline_editing_attributes( 'label', 'basic' );

		?>

		<!-- Skills -->
		<?php if ( $settings['skills'] ) : ?>
		<div class="skills-items">
			<?php foreach ( $settings['skills'] as $index => $item ) :
		    	$item_name = $this->get_repeater_setting_key( 'name', 'skills', $index );
		    	$this->add_inline_editing_attributes( $item_name, 'basic' );

		    	$item_value = $this->get_repeater_setting_key( 'value', 'skills', $index );
		    	$this->add_inline_editing_attributes( $item_value, 'basic' );

					$item_text = $this->get_repeater_setting_key( 'text', 'skills', $index );
		    	$this->add_inline_editing_attributes( $item_text, 'advanced' );
		    ?>
		    <div class="skills-item scrolla-element-anim-1 scroll-animate" data-animate="active">
				<?php if ( $item['name'] ) : ?>
				<h6 class="name">
					<span <?php echo $this->get_render_attribute_string( $item_name ); ?>>
						<?php echo wp_kses_post( $item['name'] ); ?>
					</span>
				</h6>
				<?php endif; ?>
				<?php if ( $item['text'] ) : ?>
				<div class="text">
					<div <?php echo $this->get_render_attribute_string( $item_text ); ?>>
						<?php echo wp_kses_post( $item['text'] ); ?>
					</div>
				</div>
				<?php endif; ?>
				<?php if ( $item['value'] ) : ?>
				<div class="dots">
					<div class="dot" style="width: <?php echo esc_attr( $item['value'] ); ?>%;">
						<span></span>
					</div>
				</div>
				<div class="value"><span class="num"><?php echo esc_html( $item['value'] ); ?><span>%</span></span></div>
				<?php endif; ?>
			</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Luique_Skills_Widget() );
