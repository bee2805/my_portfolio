<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Luique Project Nav Links Widget.
 *
 * @since 1.0
 */
class Luique_Project_NavLinks_Widget extends Widget_Base {

	public function get_name() {
		return 'luique-project-nav-links';
	}

	public function get_title() {
		return esc_html__( 'Project Nav (Links)', 'luique-plugin' );
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
			'subtitle',
			[
				'label'       => esc_html__( 'Subtitle', 'luique-plugin' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter title', 'luique-plugin' ),
				'default'     => esc_html__( 'Next Project', 'luique-plugin' ),
			]
		);

		$this->add_control(
			'source',
			[
				'label'       => esc_html__( 'Source', 'luique-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'auto',
				'options' => [
					'auto'  => __( 'Auto', 'luique-plugin' ),
					'manual' => __( 'Manual', 'luique-plugin' ),
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'luique-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter title', 'luique-plugin' ),
				'default'     => esc_html__( 'Enter title', 'luique-plugin' ),
				'condition'	=> [
					'source'	=> 'manual'
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label'       => esc_html__( 'Link (URL)', 'luique-plugin' ),
				'type' => Controls_Manager::URL,
				'show_external' => false,
				'condition'	=> [
					'source'	=> 'manual'
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_styling',
			[
				'label'     => esc_html__( 'Project Navigation', 'luique-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label'     => esc_html__( 'Subtitle Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .m-page-navigation .nav-arrow' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'label'     => esc_html__( 'Subtitle Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .m-page-navigation .nav-arrow',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Title Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .m-page-navigation .h-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'     => esc_html__( 'Title Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .m-page-navigation .h-title',
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

		$this->add_inline_editing_attributes( 'subtitle', 'basic' );
		$this->add_inline_editing_attributes( 'title', 'basic' );

		$next_post = get_adjacent_post( false, '', false );

		$next_url = '';
		$next_title = '';

		if ( is_a( $next_post, 'WP_Post' ) ) :
			$next_url = get_permalink( $next_post->ID );
			$next_title = get_the_title( $next_post->ID );
		endif;

		?>

		<?php if ( $next_url && $settings['source'] == 'auto' ) : ?>

		<!-- Navigation -->
		<div class="m-page-navigation">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="h-titles h-navs">
						<a href="<?php echo esc_url( $next_url ); ?>">
							<span class="nav-arrow scrolla-element-anim-1 scroll-animate" data-animate="active">
								<span <?php echo $this->get_render_attribute_string( 'subtitle' ); ?>>
									<?php echo wp_kses_post( $settings['subtitle'] ); ?>
								</span>
							</span>
							<span class="h-title splitting-text-anim-2 scroll-animate" data-splitting="chars" data-animate="active">
								<?php echo wp_kses_post( $next_title ); ?>
							</span>
						</a>
					</div>
				</div>
			</div>
		</div>

		<?php elseif ( $settings['source'] == 'manual' ) : ?>

		<!-- Navigation -->
		<div class="m-page-navigation">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="h-titles h-navs">
						<a<?php if ( $settings['link'] ) : ?><?php if ( $settings['link']['url'] ) : ?><?php if ( $settings['link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $settings['link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?> href="<?php echo esc_url( $settings['link']['url'] ); ?>"<?php endif; ?><?php endif; ?>>
							<span class="nav-arrow scrolla-element-anim-1 scroll-animate" data-animate="active">
								<span <?php echo $this->get_render_attribute_string( 'subtitle' ); ?>>
									<?php echo wp_kses_post( $settings['subtitle'] ); ?>
								</span>
							</span>
							<span class="h-title splitting-text-anim-2 scroll-animate" data-splitting="chars" data-animate="active">
								<span <?php echo $this->get_render_attribute_string( 'title' ); ?>>
									<?php echo wp_kses_post( $settings['title'] ); ?>
								</span>
							</span>
						</a>
					</div>
				</div>
			</div>
		</div>

		<?php endif; ?>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Luique_Project_NavLinks_Widget() );
