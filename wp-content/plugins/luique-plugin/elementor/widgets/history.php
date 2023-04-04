<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Luique Resume Widget.
 *
 * @since 1.0
 */
class Luique_History_Widget extends Widget_Base {

	public function get_name() {
		return 'luique-history';
	}

	public function get_title() {
		return esc_html__( 'History', 'luique-plugin' );
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
			'history_tab',
			[
				'label' => esc_html__( 'History', 'luique-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'his_label',
			[
				'label'       => esc_html__( 'Title', 'luique-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter title', 'luique-plugin' ),
				'default'     => esc_html__( 'Title', 'luique-plugin' ),
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'iscollapse',
			[
				'label' => esc_html__( 'Status', 'luique-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Opened', 'luique-plugin' ),
				'label_off' => __( 'Closed', 'luique-plugin' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$repeater->add_control(
			'name', [
				'label'       => esc_html__( 'Name', 'luique-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter name', 'luique-plugin' ),
				'default' => esc_html__( 'Enter name', 'luique-plugin' ),
			]
		);

		$repeater->add_control(
			'subname', [
				'label'       => esc_html__( 'Subname', 'luique-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter subname', 'luique-plugin' ),
				'default' => esc_html__( 'Enter subname', 'luique-plugin' ),
			]
		);

		$repeater->add_control(
			'date', [
				'label'       => esc_html__( 'Date', 'luique-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter date', 'luique-plugin' ),
				'default' => esc_html__( 'Enter date', 'luique-plugin' ),
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

		$this->add_control(
			'items',
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
			'titles_styling',
			[
				'label'     => esc_html__( 'Titles', 'luique-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Titles Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .history-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'     => esc_html__( 'Titles Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .history-title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'items_styling',
			[
				'label'     => esc_html__( 'Items', 'luique-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'date_color',
			[
				'label'     => esc_html__( 'Date Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .history-item .date.lui-subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'date_typography',
				'label'     => esc_html__( 'Date Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .history-item .date.lui-subtitle',
			]
		);

		$this->add_control(
			'name_color',
			[
				'label'     => esc_html__( 'Name Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .history-item .name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'name_typography',
				'label'     => esc_html__( 'Name Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .history-item .name',
			]
		);

		$this->add_control(
			'subname_color',
			[
				'label'     => esc_html__( 'Subname Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .history-item .subname' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subname_typography',
				'label'     => esc_html__( 'Subname Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .history-item .subname',
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => esc_html__( 'Text Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .history-item .text' => 'color: {{VALUE}};',
					'{{WRAPPER}} .history-item .text p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typography',
				'label'     => esc_html__( 'Text Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .history-item .text',
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

		$this->add_inline_editing_attributes( 'his_label', 'basic' );

		?>

		<!-- History -->

		<?php if ( $settings['his_label'] ) : ?>
		<h5 class="history-title scrolla-element-anim-1 scroll-animate" data-animate="active">
			<span <?php echo $this->get_render_attribute_string( 'his_label' ); ?>>
				<?php echo wp_kses_post( $settings['his_label'] ); ?>
			</span>
		</h5>
		<?php endif; ?>

		<?php if ( $settings['items'] ) : ?>
		<div class="history-items">
			<?php foreach ( $settings['items'] as $index => $item ) :
	    	$item_date = $this->get_repeater_setting_key( 'date', 'education', $index );
	    	$this->add_inline_editing_attributes( $item_date, 'basic' );

	    	$item_name = $this->get_repeater_setting_key( 'name', 'education', $index );
	    	$this->add_inline_editing_attributes( $item_name, 'basic' );

	    	$item_subname = $this->get_repeater_setting_key( 'subname', 'education', $index );
	    	$this->add_inline_editing_attributes( $item_subname, 'basic' );

	    	$item_text = $this->get_repeater_setting_key( 'text', 'education', $index );
	    	$this->add_inline_editing_attributes( $item_text, 'basic' );
	    ?>
	    <div class="history-item lui-collapse-item<?php if ( $item['iscollapse'] == 'yes' ) : ?> opened<?php endif; ?> scrolla-element-anim-1 scroll-animate" data-animate="active">
				<?php if ( $item['name'] ) : ?>
				<h6 class="name lui-collapse-btn<?php if ( $item['iscollapse'] == 'yes' ) : ?> active<?php endif; ?>">
					<span <?php echo $this->get_render_attribute_string( $item_name ); ?>>
						<?php echo wp_kses_post( $item['name'] ); ?>
					</span>
				</h6>
				<?php endif; ?>
				<div class="history-content">
					<?php if ( $item['subname'] ) : ?>
					<div class="subname">
						<span <?php echo $this->get_render_attribute_string( $item_subname ); ?>>
							<?php echo wp_kses_post( $item['subname'] ); ?>
						</span>
					</div>
					<?php endif; ?>
					<?php if ( $item['date'] ) : ?>
					<div class="date lui-subtitle">
						<span <?php echo $this->get_render_attribute_string( $item_date ); ?>>
							<?php echo wp_kses_post( $item['date'] ); ?>
						</span>
					</div>
					<?php endif; ?>
					<?php if ( $item['text'] ) : ?>
					<div class="text">
						<div <?php echo $this->get_render_attribute_string( $item_text ); ?>>
							<?php echo wp_kses_post( $item['text'] ); ?>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Luique_History_Widget() );
