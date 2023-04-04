<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Luique Portfolio Widget.
 *
 * @since 1.0
 */
class Luique_Portfolio_Module_Widget extends Widget_Base {

	public function get_name() {
		return 'luique-portfolio-module';
	}

	public function get_title() {
		return esc_html__( 'Portfolio Module', 'luique-plugin' );
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
			'filters_tab',
			[
				'label' => esc_html__( 'Filters', 'luique-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'filters_note',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'Filters show only with pagination "Infinite Scrolling", "Button" or "No"', 'luique-plugin' ),
				'content_classes' => 'elementor-descriptor',
			]
		);

		$this->add_control(
			'filters',
			[
				'label' => esc_html__( 'Show Filters', 'luique-plugin' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'luique-plugin' ),
				'label_off' => __( 'Hide', 'luique-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'items_tab',
			[
				'label' => esc_html__( 'Items', 'luique-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'source',
			[
				'label'       => esc_html__( 'Source', 'luique-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'all',
				'options' => [
					'all'  => __( 'All', 'luique-plugin' ),
					'categories' => __( 'Categories', 'luique-plugin' ),
				],
			]
		);

		$this->add_control(
			'source_categories',
			[
				'label'       => esc_html__( 'Source', 'luique-plugin' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => $this->get_portfolio_categories(),
				'condition' => [
		            'source' => 'categories'
		        ],
			]
		);

		$this->add_control(
			'limit',
			[
				'label'       => esc_html__( 'Number of Items', 'luique-plugin' ),
				'type'        => Controls_Manager::NUMBER,
				'placeholder' => 8,
				'default'     => 8,
			]
		);

		$this->add_control(
			'sort',
			[
				'label'       => esc_html__( 'Sorting By', 'luique-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'menu_order',
				'options' => [
					'date'  => __( 'Date', 'luique-plugin' ),
					'title' => __( 'Title', 'luique-plugin' ),
					'rand' => __( 'Random', 'luique-plugin' ),
					'menu_order' => __( 'Order', 'luique-plugin' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label'       => esc_html__( 'Order', 'luique-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'asc',
				'options' => [
					'asc'  => __( 'ASC', 'luique-plugin' ),
					'desc' => __( 'DESC', 'luique-plugin' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'settings_tab',
			[
				'label' => esc_html__( 'Settings', 'luique-plugin' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layouts',
			[
				'label'       => esc_html__( 'Layout', 'luique-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'list',
				'options' => [
					'list'  => __( 'List', 'luique-plugin' ),
					'masonry'  => __( 'Masonry', 'luique-plugin' ),
				],
			]
		);

		$this->add_control(
			'pagination',
			[
				'label'       => esc_html__( 'Pagination', 'luique-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'loadmore'  => __( 'Load More', 'luique-plugin' ),
					'button'  => __( 'Button', 'luique-plugin' ),
				],
			]
		);

    $this->add_control(
			'load_more_btn_txt',
			[
				'label'       => esc_html__( 'Button (label)', 'luique-plugin' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter button', 'luique-plugin' ),
				'default'     => esc_html__( 'Load More', 'luique-plugin' ),
				'condition' => [
		            'pagination' => 'loadmore'
		        ],
			]
		);

    $this->add_control(
			'more_text', [
				'label' => esc_html__( 'Button (Text)', 'luique-plugin' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Button Text', 'luique-plugin' ),
				'default' => esc_html__( 'view work', 'luique-plugin' ),
        'condition' => [
		            'pagination' => 'button'
		        ],
			]
		);

		$this->add_control(
			'more_link', [
				'label' => esc_html__( 'Button (URL)', 'luique-plugin' ),
				'label_block' => true,
				'type' => Controls_Manager::URL,
				'show_external' => true,
        'condition' => [
		            'pagination' => 'button'
		        ],
			]
		);

		$this->add_control(
			'show_category',
			[
				'label'       => esc_html__( 'Show Category?', 'luique-plugin' ),
				'type'        => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'no'  => __( 'No', 'luique-plugin' ),
					'yes' => __( 'Yes', 'luique-plugin' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'filters_styling',
			[
				'label'     => esc_html__( 'Filters', 'luique-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'filters_color',
			[
				'label'     => esc_html__( 'Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .filter-links a.lui-subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'filters_active_color',
			[
				'label'     => esc_html__( 'Active Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .filter-links a.lui-subtitle.active' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'filters_typography',
				'selector' => '{{WRAPPER}} .filter-links a.lui-subtitle',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'items_styling',
			[
				'label'     => esc_html__( 'Portfolio Items', 'luique-plugin' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'item_list_title_color',
			[
				'label'     => esc_html__( 'Item (List) Title Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .works-items.works-list-items .works-item .desc .name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_list_title_typography',
				'label'     => esc_html__( 'Item (List) Title Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .works-items.works-list-items .works-item .desc .name',
			]
		);

		$this->add_control(
			'item_list_cat_color',
			[
				'label'     => esc_html__( 'Item (List) Categories Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .works-items.works-list-items .works-item .desc .category' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_list_cat_typography',
				'label'     => esc_html__( 'Item (List) Categories Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .works-items.works-list-items .works-item .desc .category',
			]
		);

		$this->add_control(
			'item_title_color',
			[
				'label'     => esc_html__( 'Item (Grid) Title Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .works-items.works-masonry-items .works-item .desc .name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_title_typography',
				'label'     => esc_html__( 'Item (Grid) Title Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .works-items.works-masonry-items .works-item .desc .name',
			]
		);

		$this->add_control(
			'item_cat_color',
			[
				'label'     => esc_html__( 'Item (Grid) Categories Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .works-items.works-masonry-items .works-item .desc .category' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_cat_typography',
				'label'     => esc_html__( 'Item (Grid) Categories Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .works-items.works-masonry-items .works-item .desc .category',
			]
		);

		$this->add_control(
			'item_text_color',
			[
				'label'     => esc_html__( 'Item (Grid) Text Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .works-items.works-masonry-items .works-item .desc .text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_text_typography',
				'label'     => esc_html__( 'Item (Grid) Text Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .works-items.works-masonry-items .works-item .desc .text',
			]
		);

		$this->add_control(
			'button_txt_color',
			[
				'label'     => esc_html__( 'Item (Grid) Button Color', 'luique-plugin' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .works-items.works-masonry-items .works-item .desc .link' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'label'     => esc_html__( 'Item (Grid) Button Typography', 'luique-plugin' ),
				'selector' => '{{WRAPPER}} .works-items.works-masonry-items .works-item .desc .link',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render Categories List.
	 *
	 * @since 1.0
	 */
	protected function get_portfolio_categories() {
		$categories = [];

		$args = array(
			'type'			=> 'post',
			'child_of'		=> 0,
			'parent'		=> '',
			'orderby'		=> 'name',
			'order'			=> 'DESC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 1,
			'taxonomy'		=> 'portfolio_categories',
			'pad_counts'	=> false
		);

		$portfolio_categories = get_categories( $args );

		foreach ( $portfolio_categories as $category ) {
			$categories[$category->term_id] = $category->name;
		}

		return $categories;
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * @since 1.0
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_inline_editing_attributes( 'title', 'basic' );

		$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
		$page_id = get_the_ID();

		if ( $settings['source'] == 'all' ) {
			$cat_ids = '';
		} else {
			$cat_ids = $settings['source_categories'];
		}

		$cat_args = array(
			'type'			=> 'post',
			'child_of'		=> 0,
			'parent'		=> '',
			'orderby'		=> 'name',
			'order'			=> 'DESC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 1,
			'taxonomy'		=> 'portfolio_categories',
			'pad_counts'	=> false,
			'include'		=> $cat_ids
		);

		$pf_categories = get_categories( $cat_args );

		$args = array(
			'post_type'			=> 'portfolio',
			'post_status'		=> 'publish',
			'orderby'			=> $settings['sort'],
			'order'				=> $settings['order'],
			'posts_per_page'	=> $settings['limit'],
			'paged' 			=> $paged
		);

		if( $settings['source'] == 'categories' ) {
			$tax_array = array(
				array(
					'taxonomy' => 'portfolio_categories',
					'field'    => 'id',
					'terms'    => $cat_ids
				)
			);

			$args += array('tax_query' => $tax_array);
		}

		$q = new \WP_Query( $args );

		$temp = 'portfolio';

		$item_classes = '';

		if ( $settings['show_category'] == 'no' ) :
			$item_classes .= ' hide_category';
		endif;

		?>

		<!-- Works -->
    <div class="works-box<?php if ( $settings['layouts'] == 'list' ) : ?> works-list<?php endif; ?>">

  		<?php if ( $settings['filters'] && $pf_categories) : ?>
  		<div class="filter-links scrolla-element-anim-1 scroll-animate" data-animate="active">
  			<a href="#" class="lui-subtitle active" data-href=".works-col">
  				<?php echo esc_html__( 'All', 'luique-plugin' ); ?>
  			</a>
  			<?php foreach ( $pf_categories as $category ) : ?>
  			<a href="#" class="lui-subtitle" data-href=".sorting-<?php echo esc_attr( $category->slug ); ?>">
  				<?php echo esc_html( $category->name ); ?>
  			</a>
  			<?php endforeach; ?>
  		</div>
  		<?php endif; ?>

  		<?php if ( $q->have_posts() ) : ?>
  		<div class="works-items<?php if ( $settings['layouts'] == 'list' ) : ?> works-list-items<?php endif; ?><?php if ( $settings['layouts'] == 'masonry' ) : ?> works-masonry-items<?php endif; ?> row<?php echo esc_html( $item_classes ); ?>">
  			<?php while ( $q->have_posts() ) : $q->the_post();
  				get_template_part( 'template-parts/content', $temp );
  			endwhile; ?>
  		</div>
      <?php endif; ?>

      <?php if ( $settings['pagination'] == 'loadmore' ) :
        $infinite_scrolling_data = array(
          'url'   => admin_url( 'admin-ajax.php' ),
					'ajax_nonce' => wp_create_nonce('luique_ajax'),
          'max_num' => $q->max_num_pages,
          'page_id' => $page_id,
          'order_by' => $settings['sort'],
          'order' => $settings['order'],
          'per_page' => $settings['limit'],
          'source' => $settings['source'],
          'temp' => $temp,
          'cat_ids' => $cat_ids
        );

        wp_enqueue_script( 'luique-portfolio-load-more-el', get_template_directory_uri() . '/assets/js/portfolio-load-more-el.js', array( 'jquery' ), '1.0', true );
        wp_localize_script( 'luique-portfolio-load-more-el', 'ajax_portfolio_infinite_scroll_data', $infinite_scrolling_data );
      ?>
			<?php if ( $settings['load_more_btn_txt'] ) : ?>
      <div class="load-more">
        <a href="#" class="btn scrolla-element-anim-1 scroll-animate" data-animate="active">
					<span><?php echo esc_html( $settings['load_more_btn_txt'] ); ?></span>
				</a>
      </div>
      <?php endif; ?>
			<?php endif; ?>
  		<?php if ( $settings['pagination'] == 'button' ) : ?>
			<?php if ( $settings['more_text'] ) : ?>
      <div class="load-more-link">
      	<?php if ( $settings['more_text'] ) : ?>
  			<a<?php if ( $settings['more_link'] ) : ?><?php if ( $settings['more_link']['is_external'] ) : ?> target="_blank"<?php endif; ?><?php if ( $settings['more_link']['nofollow'] ) : ?> rel="nofollow"<?php endif; ?> href="<?php echo esc_url( $settings['more_link']['url'] ); ?>"<?php endif; ?> class="btn scrolla-element-anim-1 scroll-animate" data-animate="active">
  				<span><?php echo esc_html( $settings['more_text'] ); ?></span>
  			</a>
  			<?php endif; ?>
  		</div>
			<?php endif; ?>
      <?php endif; ?>

		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Luique_Portfolio_Module_Widget() );
