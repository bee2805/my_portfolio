<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Luique Header Menu Widget.
 *
 * @since 1.0
 */

class Luique_Header_Menu_Widget extends Widget_Base {

	public function get_name() {
		return 'luique-header-menu';
	}

	public function get_title() {
		return esc_html__( 'Header Menu', 'luique-plugin' );
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
			'menu',
			[
				'label' => esc_html__( 'Select Menu', 'luique-plugin' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => $this->nav_menu_list(),
			]
		);

		$this->add_control(
			'switcher',
			[
				'label'       => esc_html__( 'UI Switcher', 'luique-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 2,
				'options' => [
					1  => __( 'No', 'luique-plugin' ),
					2 => __( 'Yes', 'luique-plugin' ),
				],
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
				'default'	=> 'left',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render List.
	 *
	 * @since 1.0
	 */
	protected function nav_menu_list() {
		$menus = wp_get_nav_menus();
		$items = array();
		$i = 0;

		foreach ( $menus as $menu ) {
			if ( $i == 0 ) {
				$default = $menu->slug;
				$i ++;
			}
			$items[ $menu->slug ] = $menu->name;
		}

		return $items;
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * @since 1.0
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$social_links = get_field( 'social_links', 'option' );

		?>

		<?php if ( $settings['switcher'] == 2 ) : ?>
		<!-- switcher btn -->
		<a href="#" class="switcher-btn">
			<span class="sw-before">
				<svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23">
					<path id="Dark_Theme" data-name="Dark Theme" fill="#000" d="M1759.46,111.076a0.819,0.819,0,0,0-.68.147,8.553,8.553,0,0,1-2.62,1.537,8.167,8.167,0,0,1-2.96.531,8.655,8.655,0,0,1-8.65-8.682,9.247,9.247,0,0,1,.47-2.864,8.038,8.038,0,0,1,1.42-2.54,0.764,0.764,0,0,0-.12-1.063,0.813,0.813,0,0,0-.68-0.148,11.856,11.856,0,0,0-6.23,4.193,11.724,11.724,0,0,0,1,15.387,11.63,11.63,0,0,0,19.55-5.553A0.707,0.707,0,0,0,1759.46,111.076Zm-4.5,6.172a10.137,10.137,0,0,1-14.29-14.145,10.245,10.245,0,0,1,3.38-2.836c-0.14.327-.29,0.651-0.41,1.006a9.908,9.908,0,0,0-.56,3.365,10.162,10.162,0,0,0,10.15,10.189,9.776,9.776,0,0,0,3.49-.62,11.659,11.659,0,0,0,1.12-.473A10.858,10.858,0,0,1,1754.96,117.248Z" transform="translate(-1737 -98)"/>
				</svg>
			</span>
			<span class="sw-after">
				<svg xmlns="http://www.w3.org/2000/svg" width="22.22" height="22.313" viewBox="0 0 22.22 22.313">
					<path id="Light_Theme" data-name="Light Theme" fill="#fff" d="M1752.49,105.511a5.589,5.589,0,0,0-3.94-1.655,5.466,5.466,0,0,0-3.94,1.655,5.61,5.61,0,0,0,3.94,9.566,5.473,5.473,0,0,0,3.94-1.653,5.643,5.643,0,0,0,1.65-3.957A5.516,5.516,0,0,0,1752.49,105.511Zm-1.06,6.85a4.1,4.1,0,0,1-5.76,0,4.164,4.164,0,0,1,0-5.788A4.083,4.083,0,0,1,1751.43,112.361Zm7.47-3.662h-2.27a0.768,0.768,0,0,0,0,1.536h2.27A0.768,0.768,0,0,0,1758.9,108.7Zm-10.35,8.12a0.777,0.777,0,0,0-.76.769v2.274a0.777,0.777,0,0,0,.76.767,0.786,0.786,0,0,0,.77-0.767v-2.274A0.786,0.786,0,0,0,1748.55,116.819Zm7.85-.531-1.62-1.624a0.745,0.745,0,0,0-1.06,0,0.758,0.758,0,0,0,0,1.063l1.62,1.625a0.747,0.747,0,0,0,1.06,0A0.759,0.759,0,0,0,1756.4,116.288ZM1748.55,98.3a0.777,0.777,0,0,0-.76.768v2.273a0.778,0.778,0,0,0,.76.768,0.787,0.787,0,0,0,.77-0.768V99.073A0.786,0.786,0,0,0,1748.55,98.3Zm7.88,3.278a0.744,0.744,0,0,0-1.06,0l-1.62,1.624a0.758,0.758,0,0,0,0,1.063,0.745,0.745,0,0,0,1.06,0l1.62-1.624A0.758,0.758,0,0,0,1756.43,101.583Zm-15.96,7.116h-2.26a0.78,0.78,0,0,0-.77.768,0.76,0.76,0,0,0,.77.768h2.26A0.768,0.768,0,0,0,1740.47,108.7Zm2.88,5.965a0.745,0.745,0,0,0-1.06,0l-1.62,1.624a0.759,0.759,0,0,0,0,1.064,0.747,0.747,0,0,0,1.06,0l1.62-1.625A0.758,0.758,0,0,0,1743.35,114.664Zm0-11.457-1.62-1.624a0.744,0.744,0,0,0-1.06,0,0.758,0.758,0,0,0,0,1.063l1.62,1.624a0.745,0.745,0,0,0,1.06,0A0.758,0.758,0,0,0,1743.35,103.207Z" transform="translate(-1737.44 -98.313)"/>
				</svg>
			</span>
		</a>
		<?php endif; ?>

		<!-- menu btn -->
		<a href="#" class="menu-btn"><span></span><span></span></a>

		<!-- Menu Full Overlay -->
		<div class="menu-full-overlay">

			<div class="menu-full-container">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

							<!-- menu full -->
							<div class="menu-full">

								<?php luique_get_topmenu( $settings['menu'] ); ?>

							</div>

							<?php if ( $social_links ) : ?>
							<!-- social -->
							<div class="menu-social-links">
								<?php $i=0; foreach ( $social_links as $link ) : $i++; ?>
								<a href="<?php echo esc_url( $link['url'] ); ?>" target="blank" class="scrolla-element-anim-1" title="<?php echo esc_attr( $link['name'] ); ?>">
									<i class="<?php echo esc_attr( $link['icon'] ); ?>"></i>
								</a>
								<?php endforeach; ?>
							</div>
							<?php endif; ?>

							<div class="v-line-block"><span></span></div>

						</div>
					</div>
				</div>
			</div>

			<div class="menu-overlay"></div>

		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Luique_Header_Menu_Widget() );
