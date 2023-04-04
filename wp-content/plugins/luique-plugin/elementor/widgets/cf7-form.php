<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Luique CF7 Widget.
 *
 * @since 1.0
 */

class Luique_CF7_Form_Widget extends Widget_Base {

	public function get_name() {
		return 'luique-cf7-form';
	}

	public function get_title() {
		return esc_html__( 'Contact Form 7', 'luique-plugin' );
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
			'form_tab',
			[
				'label' => esc_html__( 'Form', 'luique-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'contact_form',
			[
				'label' => esc_html__( 'Select CF7 Form', 'luique-plugin' ),
				'type' => Controls_Manager::SELECT,
				'default' => 1,
				'options' => $this->contact_form_list(),
			]
		);

		$this->add_control(
			'image',
			[
				'label'       => esc_html__( 'Texture', 'luique-plugin' ),
				'type'        => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'heading_styling',
			[
				'label' => esc_html__( 'Forms', 'luique-plugin' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'label_color',
			[
				'label' => esc_html__( 'Label Color', 'luique-plugin' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .contacts-form label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'label_typography',
				'label' => esc_html__( 'Label Typography:', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .contacts-form label',
			]
		);

		$this->add_control(
			'input_color',
			[
				'label' => esc_html__( 'Input Color', 'luique-plugin' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .contacts-form input' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'input_typography',
				'label' => esc_html__( 'Input Typography:', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .contacts-form input',
			]
		);

		$this->add_control(
			'input_border_color',
			[
				'label' => esc_html__( 'Input Border Color', 'luique-plugin' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .contacts-form input' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render Contact Form List.
	 *
	 * @since 1.0
	 */
	protected function contact_form_list() {
		$cf7_posts = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

		$cf7_forms = array();

		if ( $cf7_posts ) {
			foreach ( $cf7_posts as $cf7_form ) {
				$cf7_forms[ $cf7_form->ID ] = $cf7_form->post_title;
			}
		} else {
			$cf7_forms[ esc_html__( 'No contact forms found', 'luique-plugin' ) ] = 0;
		}

		return $cf7_forms;
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * @since 1.0
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<?php if ( $settings['contact_form'] ) : ?>
		<!-- contact form -->
		<div class="contacts-form scrolla-element-anim-1 scroll-animate" data-animate="active">
			<?php if ( $settings['image'] ) : $image = wp_get_attachment_image_url( $settings['image']['id'], 'full' ); ?>
			<div class="bg-img" style="background-image: url(<?php echo esc_url( $image ); ?>);"></div>
			<?php endif; ?>
			<?php echo do_shortcode( '[contact-form-7 id="'. esc_attr( $settings['contact_form'] ) .'"]' ); ?>
		</div>
		<?php endif; ?>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Luique_CF7_Form_Widget() );
