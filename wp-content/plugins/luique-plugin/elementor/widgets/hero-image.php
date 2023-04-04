<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Luique Hero Image Widget.
 *
 * @since 1.0
 */
class Luique_Hero_Image_Widget extends Widget_Base {

	public function get_name() {
		return 'luique-hero-image';
	}

	public function get_title() {
		return esc_html__( 'Hero Image', 'luique-plugin' );
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
			'title_tag',
			[
				'label'       => esc_html__( 'Title Tag', 'luique-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'h1',
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
				'placeholder' => esc_html__( 'Enter subtitle', 'luique-plugin' ),
				'default'     => esc_html__( 'Subtitle', 'luique-plugin' ),
			]
		);

		$this->add_control(
			'description',
			[
				'label'       => esc_html__( 'Description', 'luique-plugin' ),
				'type'        => Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'Enter your description', 'luique-plugin' ),
				'default'     => esc_html__( 'Description', 'luique-plugin' ),
			]
		);

		$this->add_control(
			'btn_1_text', [
				'label' => esc_html__( 'Button 1 (Text)', 'luique-plugin' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Button Text', 'luique-plugin' ),
				'default' => esc_html__( 'Download CV', 'luique-plugin' ),
			]
		);

		$this->add_control(
			'btn_1_link', [
				'label' => esc_html__( 'Button 1 (URL)', 'luique-plugin' ),
				'label_block' => true,
				'type' => Controls_Manager::URL,
				'show_external' => true,
			]
		);

		$this->add_control(
			'btn_2_text', [
				'label' => esc_html__( 'Button 2 (Text)', 'luique-plugin' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Button 2 Text', 'luique-plugin' ),
				'default' => esc_html__( 'My Skills', 'luique-plugin' ),
			]
		);

		$this->add_control(
			'btn_2_link', [
				'label' => esc_html__( 'Button 2 (URL)', 'luique-plugin' ),
				'label_block' => true,
				'type' => Controls_Manager::URL,
				'show_external' => true,
			]
		);

		$this->add_control(
			'image',
			[
				'label'       => esc_html__( 'Image', 'luique-plugin' ),
				'type'        => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'pat_1',
			[
				'label'       => esc_html__( 'Texture 1', 'luique-plugin' ),
				'type'        => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'pat_2',
			[
				'label'       => esc_html__( 'Texture 2', 'luique-plugin' ),
				'type'        => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'pat_3',
			[
				'label'       => esc_html__( 'Texture 3', 'luique-plugin' ),
				'type'        => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'num', [
				'label'       => esc_html__( 'Number', 'luique-plugin' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Number', 'luique-plugin' ),
				'default' => esc_html__( 'Number', 'luique-plugin' ),
			]
		);

		$repeater->add_control(
			'name', [
				'label'       => esc_html__( 'Label', 'luique-plugin' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter label', 'luique-plugin' ),
				'default' => esc_html__( 'Enter label', 'luique-plugin' ),
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Info List', 'luique-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ name }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'typed_tab',
			[
				'label' => esc_html__( 'Typed', 'luique-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'label_type',
			[
				'label'       => esc_html__( 'Label Type', 'luique-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'no'  => __( 'Text', 'luique-plugin' ),
					'yes' => __( 'Typed', 'luique-plugin' ),
				],
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'name', [
				'label'       => esc_html__( 'Name', 'luique-plugin' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter title', 'luique-plugin' ),
				'default' => esc_html__( 'Enter title', 'luique-plugin' ),
			]
		);

		$this->add_control(
			'label_typed',
			[
				'label' => esc_html__( 'Items', 'luique-plugin' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ name }}}',
				'condition' => [
					'label_type' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_text',
			[
				'label'       => esc_html__( 'Label', 'luique-plugin' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter your Label', 'luique-plugin' ),
				'default'     => esc_html__( 'Label', 'luique-plugin' ),
				'condition' => [
					'label_type' => 'no',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'social_tab',
			[
				'label' => esc_html__( 'Social', 'luique-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'icon', [
				'label'       => esc_html__( 'Icon', 'myour-plugin' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'name', [
				'label'       => esc_html__( 'Name', 'luique-plugin' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter title', 'luique-plugin' ),
				'default' => esc_html__( 'Enter title', 'luique-plugin' ),
			]
		);

		$repeater->add_control(
			'title', [
				'label'       => esc_html__( 'Title', 'luique-plugin' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter title', 'luique-plugin' ),
				'default' => esc_html__( 'Enter title', 'luique-plugin' ),
			]
		);

		$repeater->add_control(
			'link', [
				'label' => esc_html__( 'URL', 'luique-plugin' ),
				'label_block' => true,
				'type' => Controls_Manager::URL,
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
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
			'content_styling',
			[
				'label'     => esc_html__( 'Content', 'luique-plugin' ),
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
					'{{WRAPPER}} .section.hero-started .titles .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'     => esc_html__( 'Title Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .section.hero-started .titles .title',
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label'     => esc_html__( 'Subtitle Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .section.hero-started .titles .lui-subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'label'     => esc_html__( 'Subtitle Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .section.hero-started .titles .lui-subtitle',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     => esc_html__( 'Description Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .section.hero-started .description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'label'     => esc_html__( 'Description Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .section.hero-started .description',
			]
		);

		$this->add_control(
			'label_color',
			[
				'label'     => esc_html__( 'Label Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .section.hero-started .titles .label.lui-subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'label_typography',
				'label'     => esc_html__( 'Label Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .section.hero-started .titles .label.lui-subtitle',
			]
		);

		$this->add_control(
			'social_color',
			[
				'label'     => esc_html__( 'Social Icons Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .section.hero-started .social-links a i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_txt_color',
			[
				'label'     => esc_html__( 'Button Text Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .section.hero-started .btn' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .section.hero-started .btn:before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'label'     => esc_html__( 'Button Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .section.hero-started .btn',
			]
		);

		$this->add_control(
			'button_2_color',
			[
				'label'     => esc_html__( 'Button 2 Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .section.hero-started .btn-lnk' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_2_color_h',
			[
				'label'     => esc_html__( 'Button 2 Color HOVER', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .section.hero-started .btn-lnk:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_2_typography',
				'label'     => esc_html__( 'Button 2 Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .section.hero-started .btn-lnk',
			]
		);

		$this->add_control(
			'infolist_color',
			[
				'label'     => esc_html__( 'Info List Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .section.hero-started .info-list ul li' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'infolist_typography',
				'label'     => esc_html__( 'Info List Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .section.hero-started .info-list ul li .value',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'infolist_typography_num',
				'label'     => esc_html__( 'Info List Number Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .section.hero-started .info-list ul li .num',
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
		$this->add_inline_editing_attributes( 'description', 'advanced' );

		?>

		<!-- Section Hero Started -->
		<div class="section hero-started">
			<div class="content scrolla-element-anim-1 scroll-animate" data-animate="active">
				<?php if ( $settings['title'] || $settings['subtitle'] ) : ?>
				<div class="titles">
					<?php if ( $settings['subtitle'] ) : ?>
					<div class="lui-subtitle">
						<span <?php echo $this->get_render_attribute_string( 'subtitle' ); ?>>
							<?php echo wp_kses_post( $settings['subtitle'] ); ?>
						</span>
					</div>
					<?php endif; ?>
					<?php if ( $settings['title'] ) : ?>
					<<?php echo esc_attr( $settings['title_tag'] ); ?> class="title splitting-text-anim-1 scroll-animate" data-splitting="chars" data-animate="active">
						<span <?php echo $this->get_render_attribute_string( 'title' ); ?>>
							<?php echo wp_kses_post( $settings['title'] ); ?>
						</span>
					</<?php echo esc_attr( $settings['title_tag'] ); ?>>
					<?php endif; ?>
					<?php if( $settings['label_type'] == 'yes' ) : ?>
					<div class="label lui-subtitle subtitle-typed">
						<div class="typing-title">
							<?php foreach ( $settings['label_typed'] as $index => $item ) : ?>
								<p><?php echo esc_html( $item['name'] ); ?></p>
							<?php endforeach; ?>
						</div>
					</div>
					<?php endif; ?>
					<?php if( $settings['label_type'] == 'no' ) : ?>
					<div class="label lui-subtitle">
						<?php echo wp_kses_post( $settings['label_text'] ); ?>
					</div>
					<?php endif; ?>
				</div>
				<?php endif; ?>
				<?php if ( $settings['description'] || $settings['items'] ) : ?>
				<div class="description">
					<?php if ( $settings['description'] ) : ?>
					<div <?php echo $this->get_render_attribute_string( 'description' ); ?>>
						<?php echo wp_kses_post( $settings['description'] ); ?>
					</div>
					<?php endif; ?>
					<?php if ( $settings['items'] ) : ?>
					<div class="social-links">
						<?php foreach ( $settings['items'] as $index => $item ) : ?>
						<a<?php if ( $item['link'] ) : ?><?php if ( $item['link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $item['link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?> href="<?php echo esc_url( $item['link']['url'] ); ?>"<?php endif; ?>>
							<?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
						</a>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>
				</div>
				<?php endif; ?>
				<div class="bts">
				<?php if ( $settings['btn_1_text'] ) : ?>
				<a<?php if ( $settings['btn_1_link'] ) : ?><?php if ( $settings['btn_1_link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $settings['btn_1_link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?> href="<?php echo esc_url( $settings['btn_1_link']['url'] ); ?>"<?php endif; ?> class="btn">
					<span><?php echo esc_html( $settings['btn_1_text'] ); ?></span>
				</a>
				<?php endif; ?>
				<?php if ( $settings['btn_2_text'] ) : ?>
				<a<?php if ( $settings['btn_2_link'] ) : ?><?php if ( $settings['btn_2_link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $settings['btn_2_link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?> href="<?php echo esc_url( $settings['btn_2_link']['url'] ); ?>"<?php endif; ?> class="btn-lnk">
					<?php echo esc_html( $settings['btn_2_text'] ); ?>
				</a>
				<?php endif; ?>
				</div>
			</div>
			<?php if ( $settings['image'] ) : $image = wp_get_attachment_image_url( $settings['image']['id'], 'full' ); ?>
			<div class="slide scrolla-element-anim-1 scroll-animate" data-animate="active">
				<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $settings['title'] ); ?>" />
				<span class="circle circle-1"></span>
				<?php if ( $settings['pat_1'] ) : $pat_1 = wp_get_attachment_image_url( $settings['pat_1']['id'], 'full' ); ?>
				<span class="circle img-1" style="background-image: url(<?php echo esc_url( $pat_1 ); ?>);"></span>
				<?php endif; ?>
				<?php if ( $settings['pat_2'] ) : $pat_2 = wp_get_attachment_image_url( $settings['pat_2']['id'], 'full' ); ?>
				<span class="circle img-2" style="background-image: url(<?php echo esc_url( $pat_2 ); ?>);"></span>
				<?php endif; ?>
				<?php if ( $settings['pat_3'] ) : $pat_3 = wp_get_attachment_image_url( $settings['pat_3']['id'], 'full' ); ?>
				<span class="circle img-3" style="background-image: url(<?php echo esc_url( $pat_3 ); ?>);"></span>
				<?php endif; ?>
				<?php if ( $settings['list'] ) : ?>
				<div class="info-list">
					<ul>
	          <?php foreach ( $settings['list'] as $index => $item ) : ?>
							<li>
								<span class="num"><?php echo wp_kses_post( $item['num'] ); ?></span>
								<span class="value"><?php echo wp_kses_post( $item['name'] ); ?></span>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php endif; ?>
			</div>
			<?php endif; ?>
		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Luique_Hero_Image_Widget() );
