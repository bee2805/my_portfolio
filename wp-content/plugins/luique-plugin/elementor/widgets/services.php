<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Luique Services Widget.
 *
 * @since 1.0
 */
class Luique_Services_Widget extends Widget_Base {

	public function get_name() {
		return 'luique-services';
	}

	public function get_title() {
		return esc_html__( 'Services', 'luique-plugin' );
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
			'services_tab',
			[
				'label' => esc_html__( 'Services', 'luique-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'subtitle', [
				'label'       => esc_html__( 'Subtitle', 'luique-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter Subtitle', 'luique-plugin' ),
				'default' => esc_html__( 'Enter Subtitle', 'luique-plugin' ),
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
			'title', [
				'label'       => esc_html__( 'Title', 'luique-plugin' ),
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
			'image',
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
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'services_styling',
			[
				'label'     => esc_html__( 'Services Items', 'luique-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .services-item .icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label'     => esc_html__( 'Subtitle Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .services-item .lui-subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'label'     => esc_html__( 'Subtitle Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .services-item .lui-subtitle',
			]
		);

		$this->add_control(
			'name_color',
			[
				'label'     => esc_html__( 'Title Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .services-item .lui-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'name_typography',
				'label'     => esc_html__( 'Title Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .services-item .lui-title',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     => esc_html__( 'Description Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .services-item .lui-text' => 'color: {{VALUE}};',
					'{{WRAPPER}} .services-item .lui-text p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'label'     => esc_html__( 'Description Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .services-item .lui-text',
			]
		);

		$this->add_control(
			'lnk_color',
			[
				'label'     => esc_html__( 'Link Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .services-item .lnk' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'lnk_typography',
				'label'     => esc_html__( 'Link Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .services-item .lnk',
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

		<!-- Services -->
    <?php if ( $settings['items'] ) : ?>
		<div class="swiper-container js-services scrolla-element-anim-1 scroll-animate" data-animate="active">
			<div class="swiper-wrapper">
				<?php foreach ( $settings['items'] as $index => $item ) :
			    	$item_name = $this->get_repeater_setting_key( 'title', 'items', $index );
			    	$this->add_inline_editing_attributes( $item_name, 'basic' );

						$item_subname = $this->get_repeater_setting_key( 'subtitle', 'items', $index );
			    	$this->add_inline_editing_attributes( $item_subname, 'basic' );

	          $item_text = $this->get_repeater_setting_key( 'text', 'items', $index );
	          $this->add_inline_editing_attributes( $item_text, 'basic' );
			    ?>
	      <div class="swiper-slide">
	  		  <div class="services-item">
						<?php if ( $item['subtitle'] ) : ?>
						<div class="lui-subtitle">
							<span <?php echo $this->get_render_attribute_string( $item_subname ); ?>>
								<?php echo wp_kses_post( $item['subtitle'] ); ?>
							</span>
						</div>
						<?php endif; ?>
						<?php if ( $item['icon'] ) : ?>
  		    	<div class="icon">
  						<?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
  					</div>
  					<?php endif; ?>
  					<?php if ( $item['title'] ) : ?>
  					<h5 class="lui-title">
  						<span <?php echo $this->get_render_attribute_string( $item_name ); ?>>
  							<?php echo wp_kses_post( $item['title'] ); ?>
  						</span>
  					</h5>
  					<?php endif; ?>
            <?php if ( $item['text'] ) : ?>
  					<div class="lui-text">
  						<div <?php echo $this->get_render_attribute_string( $item_text ); ?>>
  							<?php echo wp_kses_post( $item['text'] ); ?>
  						</div>
  					</div>
  					<?php endif; ?>
            <?php if ( $item['more_text'] ) : ?>
  					<a<?php if ( $item['more_link'] ) : ?><?php if ( $item['more_link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $item['more_link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?> href="<?php echo esc_url( $item['more_link']['url'] ); ?>"<?php endif; ?> class="lnk">
  						<?php echo esc_html( $item['more_text'] ); ?>
  					</a>
  					<?php endif; ?>
						<?php if ( $item['image'] ) : $image = wp_get_attachment_image_url( $item['image']['id'], 'full' ); ?>
						<div class="image" style="background-image: url(<?php echo esc_url( $image ); ?>);"></div>
						<?php endif; ?>
	  			</div>
	      </div>
				<?php endforeach; ?>
			</div>
			<div class="swiper-pagination"></div>
		</div>
		<?php endif; ?>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Luique_Services_Widget() );
