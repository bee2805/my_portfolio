<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Luique Testimonials Widget.
 *
 * @since 1.0
 */
class Luique_Testimonials_Widget extends Widget_Base {

	public function get_name() {
		return 'luique-testimonials';
	}

	public function get_title() {
		return esc_html__( 'Testimonials', 'luique-plugin' );
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
			'testimonials_tab',
			[
				'label' => esc_html__( 'Testimonials', 'luique-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image', [
				'label' => esc_html__( 'Image', 'luique-plugin' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
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
			'title', [
				'label'       => esc_html__( 'Title', 'luique-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter title', 'luique-plugin' ),
				'default' => esc_html__( 'Enter title', 'luique-plugin' ),
			]
		);

		$repeater->add_control(
			'author', [
				'label'       => esc_html__( 'Subtitle', 'luique-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter Subtitle', 'luique-plugin' ),
				'default' => esc_html__( 'Enter Subtitle', 'luique-plugin' ),
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
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'testimonials_styling',
			[
				'label'     => esc_html__( 'Testimonials Items', 'luique-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'name_color',
			[
				'label'     => esc_html__( 'Name Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .testimonials-item .info .name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'name_typography',
				'label'     => esc_html__( 'Name Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .testimonials-item .info .name',
			]
		);

		$this->add_control(
			'author_color',
			[
				'label'     => esc_html__( 'Author Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .testimonials-item .info .author' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'author_typography',
				'label'     => esc_html__( 'Author Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .testimonials-item .info .author',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     => esc_html__( 'Description Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .testimonials-item .text.lui-text' => 'color: {{VALUE}};',
					'{{WRAPPER}} .testimonials-item .text.lui-text p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'label'     => esc_html__( 'Description Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .testimonials-item .text.lui-text',
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
		<div class="swiper-container js-testimonials scrolla-element-anim-1 scroll-animate" data-animate="active">
			<div class="swiper-wrapper">
				<?php foreach ( $settings['items'] as $index => $item ) :
					$item_title = $this->get_repeater_setting_key( 'title', 'items', $index );
					$this->add_inline_editing_attributes( $item_title, 'none' );

					$item_text = $this->get_repeater_setting_key( 'text', 'items', $index );
					$this->add_inline_editing_attributes( $item_text, 'basic' );

					$item_author = $this->get_repeater_setting_key( 'author', 'items', $index );
					$this->add_inline_editing_attributes( $item_author, 'none' );
			  ?>
	      <div class="swiper-slide">
	  		  <div class="testimonials-item">
						<?php if ( $item['image'] ) : $image = wp_get_attachment_image_url( $item['image']['id'], 'luique_600xAuto' ); ?>
						<div class="image">
							<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" />
							<div class="icon">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="44px" height="34px">
									<path fill-rule="evenodd"  stroke-width="2px" stroke="rgb(0, 0, 0)" fill="rgb(41, 165, 135)" d="M17.360,8.325 C15.490,5.563 11.616,4.762 8.705,6.536 C6.901,7.635 5.815,9.533 5.826,11.567 C5.828,14.854 8.637,17.516 12.101,17.515 C13.290,17.513 14.456,17.192 15.460,16.587 C14.967,17.975 14.049,19.457 12.537,20.942 C11.934,21.533 11.951,22.476 12.574,23.048 C13.198,23.619 14.192,23.604 14.794,23.012 C20.384,17.515 19.658,11.539 17.360,8.333 L17.360,8.325 ZM32.407,8.325 C30.538,5.563 26.663,4.762 23.752,6.536 C21.949,7.635 20.863,9.533 20.873,11.567 C20.875,14.854 23.685,17.516 27.148,17.515 C28.338,17.513 29.503,17.192 30.508,16.587 C30.015,17.975 29.097,19.457 27.585,20.942 C26.982,21.533 26.999,22.476 27.622,23.048 C28.245,23.619 29.239,23.604 29.842,23.012 C35.432,17.515 34.706,11.539 32.407,8.333 L32.407,8.325 Z"/>
								</svg>
							</div>
						</div>
						<?php endif; ?>
						<?php if ( $item['text'] ) : ?>
						<div class="text lui-text">
							<div <?php echo $this->get_render_attribute_string( $item_text ); ?>><?php echo wp_kses_post( $item['text'] ); ?></div>
						</div>
						<?php endif; ?>
						<?php if ( $item['title'] || $item['author'] ) : ?>
						<div class="info">
							<?php if ( $item['title'] ) : ?>
							<h6 class="name">
								<span <?php echo $this->get_render_attribute_string( $item_title ); ?>><?php echo esc_html( $item['title'] ); ?></span>
							</h6>
							<?php endif; ?>
							<?php if ( $item['author'] ) : ?>
							<div class="author">
								<span <?php echo $this->get_render_attribute_string( $item_author ); ?>><?php echo esc_html( $item['author'] ); ?></span>
							</div>
							<?php endif; ?>
						</div>
						<?php endif; ?>
						<?php if ( $item['texture'] ) : $texture = wp_get_attachment_image_url( $item['texture']['id'], 'full' ); ?>
						<div class="bg-img" style="background-image: url(<?php echo esc_url( $texture ); ?>);"></div>
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

Plugin::instance()->widgets_manager->register( new Luique_Testimonials_Widget() );
