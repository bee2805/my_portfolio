<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Luique Awwards Widget.
 *
 * @since 1.0
 */

class Luique_Pricing_Widget extends Widget_Base {

	public function get_name() {
		return 'luique-pricing';
	}

	public function get_title() {
		return esc_html__( 'Pricing', 'luique-plugin' );
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
				'label' => esc_html__( 'Items', 'luique-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'label', [
				'label'       => esc_html__( 'Badge', 'luique-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter label', 'luique-plugin' ),
				'default' => esc_html__( '', 'luique-plugin' ),
			]
		);

		$repeater->add_control(
			'subtitle', [
				'label'       => esc_html__( 'Subtitle', 'luique-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter subtitle', 'luique-plugin' ),
				'default' => esc_html__( 'Enter subtitle', 'luique-plugin' ),
			]
		);

		$repeater->add_control(
			'icon', [
				'label'       => esc_html__( 'Icon', 'luique-plugin' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
			]
		);

    $repeater->add_control(
			'price', [
				'label'       => esc_html__( 'Price', 'luique-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter price', 'luique-plugin' ),
				'default' => esc_html__( 'Enter price', 'luique-plugin' ),
			]
		);

		$repeater->add_control(
			'price_after', [
				'label'       => esc_html__( 'Price After', 'luique-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'After', 'luique-plugin' ),
				'default' => esc_html__( 'After', 'luique-plugin' ),
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
			'list', [
				'label'       => esc_html__( 'List', 'luique-plugin' ),
				'type'        => Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'Enter list', 'luique-plugin' ),
				'default' => esc_html__( 'Enter list', 'luique-plugin' ),
			]
		);

    $repeater->add_control(
			'more_text', [
				'label' => esc_html__( 'Button (Text)', 'luique-plugin' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Button Text', 'luique-plugin' ),
				'default' => esc_html__( 'view work', 'luique-plugin' ),
			]
		);

		$repeater->add_control(
			'more_link', [
				'label' => esc_html__( 'Button (URL)', 'luique-plugin' ),
				'label_block' => true,
				'type' => Controls_Manager::URL,
				'show_external' => true,
			]
		);

		$repeater->add_control(
			'texture',
			[
				'label'       => esc_html__( 'Texture', 'luique-plugin' ),
				'type'        => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Items', 'luique-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ subtitle }}}',
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
			'items_styling',
			[
				'label' => esc_html__( 'Items', 'luique-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'item_badge_color',
			[
				'label' => esc_html__( 'Badge Color', 'luique-plugin' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .pricing-col .label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'item_badge_typography',
				'label' => esc_html__( 'Badge Typography:', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .pricing-col .label',
			]
		);

		$this->add_control(
			'item_subtitle_color',
			[
				'label' => esc_html__( 'Subtitle Color', 'luique-plugin' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .pricing-item .lui-subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'item_subtitle_typography',
				'label' => esc_html__( 'Subtitle Typography:', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .pricing-item .lui-subtitle',
			]
		);

		$this->add_control(
			'item_price_color',
			[
				'label' => esc_html__( 'Price Color', 'luique-plugin' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .pricing-item .price' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'item_price_typography',
				'label' => esc_html__( 'Price Typography:', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .pricing-item .price',
			]
		);

		$this->add_control(
			'item_price_after_color',
			[
				'label' => esc_html__( 'Price After Color', 'luique-plugin' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .pricing-item .price em' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'item_price_after_typography',
				'label' => esc_html__( 'Price After Typography:', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .pricing-item .price em',
			]
		);

		$this->add_control(
			'item_text_color',
			[
				'label' => esc_html__( 'Text Color', 'luique-plugin' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .pricing-item .lui-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'item_text_typography',
				'label' => esc_html__( 'Text Typography:', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .pricing-item .lui-text',
			]
		);

		$this->add_control(
			'item_list_color',
			[
				'label' => esc_html__( 'List Color', 'luique-plugin' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .pricing-item .list ul li' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'item_list_typography',
				'label' => esc_html__( 'List Typography:', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .pricing-item .list ul li',
			]
		);

		$this->add_control(
			'button_txt_color',
			[
				'label'     => esc_html__( 'Button Text Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .pricing-item .btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_color_h',
			[
				'label'     => esc_html__( 'Button BG Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .pricing-item .btn:before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'label'     => esc_html__( 'Button Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .pricing-item .btn',
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

		<!-- Pricing -->
		<?php if ( $settings['items'] ) : ?>
		<div class="pricing-items row">

			<?php foreach ( $settings['items'] as $index => $item ) :
		      $item_subtitle = $this->get_repeater_setting_key( 'subtitle', 'items', $index );
		    	$this->add_inline_editing_attributes( $item_subtitle, 'basic' );

					$item_label = $this->get_repeater_setting_key( 'label', 'items', $index );
		    	$this->add_inline_editing_attributes( $item_label, 'basic' );

          $item_price = $this->get_repeater_setting_key( 'price', 'items', $index );
		    	$this->add_inline_editing_attributes( $item_price, 'basic' );

          $item_text = $this->get_repeater_setting_key( 'text', 'items', $index );
		    	$this->add_inline_editing_attributes( $item_text, 'advanced' );

					$item_list = $this->get_repeater_setting_key( 'list', 'items', $index );
		    	$this->add_inline_editing_attributes( $item_list, 'advanced' );
		  ?>
			<div class="pricing-col<?php if ( $item['label'] != '' ) : ?> center<?php endif; ?> col-xs-12 col-sm-6 col-md-6 col-lg-4">
				<?php if ( $item['label'] ) : ?>
				<div class="label">
					<span <?php echo $this->get_render_attribute_string( $item_label ); ?>>
						<?php echo wp_kses_post( $item['label'] ); ?>
					</span>
				</div>
				<?php endif; ?>
				<div class="pricing-item scrolla-element-anim-1 scroll-animate" data-animate="active">
					<?php if ( $item['subtitle'] ) : ?>
					<div class="lui-subtitle">
						<span <?php echo $this->get_render_attribute_string( $item_subtitle ); ?>>
							<?php echo wp_kses_post( $item['subtitle'] ); ?>
						</span>
					</div>
					<?php endif; ?>
					<?php if ( $item['icon'] ) : ?>
					<div class="icon">
						<?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</div>
					<?php endif; ?>
					<?php if ( $item['price'] || $item['price_after'] ) : ?>
					<div class="price">
						<span <?php echo $this->get_render_attribute_string( $item_price ); ?>>
							<?php echo wp_kses_post( $item['price'] ); ?>
						</span>
						<?php if ( $item['price_after'] ) : ?>
						<em><?php echo wp_kses_post( $item['price_after'] ); ?></em>
						<?php endif; ?>
					</div>
					<?php endif; ?>
          <?php if ( $item['text'] ) : ?>
          <div class="lui-text">
            <div <?php echo $this->get_render_attribute_string( $item_text ); ?>>
              <?php echo wp_kses_post( $item['text'] ); ?>
            </div>
          </div>
          <?php endif; ?>
					<?php if ( $item['list'] ) : ?>
          <div class="list">
            <div <?php echo $this->get_render_attribute_string( $item_list ); ?>>
              <?php echo wp_kses_post( $item['list'] ); ?>
            </div>
          </div>
          <?php endif; ?>
          <?php if ( $item['more_text'] ) : ?>
          <a<?php if ( $item['more_link'] ) : ?><?php if ( $item['more_link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $item['more_link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?> href="<?php echo esc_url( $item['more_link']['url'] ); ?>"<?php endif; ?> class="btn btn-solid">
            <span><?php echo esc_html( $item['more_text'] ); ?></span>
          </a>
          <?php endif; ?>
					<?php if ( $item['texture'] ) : $texture = wp_get_attachment_image_url( $item['texture']['id'], 'full' ); ?>
					<div class="bg-img" style="background-image: url(<?php echo esc_url( $texture ); ?>);"></div>
					<?php endif; ?>
				</div>
			</div>
			<?php endforeach; ?>

		</div>
		<?php endif; ?>

		<?php
	}

}

Plugin::instance()->widgets_manager->register( new Luique_Pricing_Widget() );
