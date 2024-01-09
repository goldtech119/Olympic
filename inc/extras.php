<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * @package My_Theme
 */

if ( ! class_exists( 'Theme_Extra' ) ) {
	/**
	 * Custom theme extra class
	 */
	class Theme_Extra {
		/**
		 * Init everything here
		 */
		public function init() {
			$this->add_filters();

			$this->add_actions();

			// Register options page for ACF field
			if ( function_exists( 'acf_add_options_page' ) ) {
				acf_add_options_page(
					array(
						'page_title' => 'Theme General Settings',
						'menu_title' => 'Theme Settings',
						'menu_slug'  => 'theme-general-settings',
						'capability' => 'edit_posts',
						'redirect'   => false,
					)
				);
			}

			// Disable for post types
			// add_filter('use_block_editor_for_post_type', '__return_false', 10);
			// add_action('init', 'my_remove_editor_from_post_type');
			// function my_remove_editor_from_post_type() {
			// remove_post_type_support( 'page', 'editor' );
			// }

			// Disable WordPress Admin Bar for all users
			// add_filter( 'show_admin_bar', '__return_false' );

			// add_post_type_support( 'page', 'excerpt' );
		}

		/**
		 * Add Filters
		 */
		public function add_filters() {
			add_filter( 'body_class', array( $this, 'body_class' ) );
			add_filter( 'use_block_editor_for_post_type', '__return_false', 10 );
		}

		/**
		 * Add actions
		 */
		public function add_actions() {
			add_action( 'wp_head', array( $this, 'add_ajax_url' ) );
			add_action( 'init', array( $this, 'add_categories_to_pages' ) );
			add_action( 'init', array( $this, 'remove_editor_from_post_type' ) );
			add_action( 'login_enqueue_scripts', array( $this, 'login_enqueue_scripts' ) );

			// ajax cpt
			add_action( 'wp_ajax_ajax_cpt', array( $this, 'ajax_cpt' ) );
			add_action( 'wp_ajax_nopriv_ajax_cpt', array( $this, 'ajax_cpt' ) );
			// If ACF is installed load acf fields from local json
			if ( class_exists( 'ACF' ) ) {
				add_action( 'acf/init', array( $this, 'acf_init' ) );
			}
		}

		/**
		 * Adds custom classes to the array of body classes.
		 *
		 * @param array $classes Classes for the body element.
		 * @return array
		 */
		public function body_class( $classes ) {
			// Adds a class of group-blog to blogs with more than 1 published author.
			if ( is_multi_author() ) {
				$classes[] = 'group-blog';
			}

			// Adds a class of hfeed to non-singular pages.
			if ( ! is_singular() ) {
				$classes[] = 'hfeed';
			}

			// Add acf custom body class
			if ( class_exists( 'ACF' ) ) {
				$body_class = get_field( 'body_class', get_queried_object_id() );
				if ( $body_class ) {
					$body_class = esc_attr( trim( $body_class ) );
					$classes[]  = $body_class;
				}
			}
			return $classes;
		}

		/**
		 * Styling login form
		 */
		public function login_enqueue_scripts() {
			wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/assets/css/style-login.css', array(), '1.0' );
			// wp_enqueue_script( 'custom-login', get_stylesheet_directory_uri() . '/style-login.js' );
		}

		/**
		 * Add categories and tages for pages
		 */
		public function add_categories_to_pages() {
			register_taxonomy_for_object_type( 'category', 'page' );
		}

		/**
		 * Init ACF plugin settings
		 */
		public function acf_init() {
			acf_update_setting( 'show_updates', true );
			acf_update_setting( 'google_api_key', '' );
		}
		/**
		 * Add AJAX URL in <head></head>
		 */
		public function add_ajax_url() {
			$url = wp_parse_url( home_url() );
			if ( 'https' === $url['scheme'] ) {
				$protocol = 'https';
			} else {
				$protocol = 'http';
			}
			?>
			<script type="text/javascript">
				var ajaxurl = '<?php echo esc_url( admin_url( 'admin-ajax.php', $protocol ) ); ?>';
			</script>
			<?php
		}
		// Disable for post types
		public function remove_editor_from_post_type() {
			// remove_post_type_support( 'page', 'editor' );
		}
		/**
		 * Ajax CPT
		 */

		public function ajax_cpt() {
			ob_start();
			$paged          = $_POST['paged'] ? $_POST['paged'] : 1;
			$cat            = explode(' ', $_POST['cat'] ? $_POST['cat'] : '');
			$posts_per_page = $_POST['posts_per_page'] ? $_POST['posts_per_page'] : 3;
			$post_type      = $_POST['post_type'] ? $_POST['post_type'] : 'post';
			$search         = $_POST['search'] ? $_POST['search'] : '';
			$sort           = $_POST['sort'] ? $_POST['sort'] : 'date';

			if ( $sort == 'ASC' || $sort == 'DESC' ) {
				$order = 'title';
			} elseif ( $sort == 'date' ) {
				$order = 'date';
				$sort  = 'ASC';
				if ( $post_type == 'post' ) {
					$sort = 'DESC';
				}
			}
			$args = array(
				'post_type'      => $post_type,
				'paged'          => $paged,
				'posts_per_page' => $posts_per_page,
				'orderby'        => $order,
				'order'          => $sort,
				's'              => $search,
			);
			if ( $cat ) :
				$taxonomy   = $post_type == 'post' ? 'category' : $post_type . '_cat';
				$taxqueries = [];
				foreach ( $cat as $ind => $item ) {
					$taxqueries[$ind] = array(
						'taxonomy' => $taxonomy,
						'field'    => 'slug',
						'terms'    => $item
					);
				}
				array_shift($taxqueries);
				$args['tax_query'] = $taxqueries;
			endif;
			if ( $search ) :
				$args['s'] = $search;
			endif;
			$query = new WP_Query( $args );
			$total_posts = $query->found_posts;
			if ( $query->have_posts() ) :

				while ( $query->have_posts() ) :
					$query->the_post();
					if ( $post_type == 'post' ) {
						get_template_part( 'inc/ajax/cpt', $post_type, array('total_posts' => $total_posts) );
					}
					else {
						get_template_part( 'inc/ajax/cpt', $post_type );
					}
				endwhile;
			else :
				echo '<h4 class="no-results">Nothing found.</h4>';
			endif;
			$res         = new \stdClass();
			$res->output = ob_get_clean();
			// $res->max_num_pages = $query->max_num_pages;
			// if ( $query->max_num_pages > 1 ) :
			// $res->pagination = paginate_links(
			// array(
			// 'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
			// 'format'    => '?paged=%#%',
			// 'current'   => max( 1, $paged ),
			// 'prev_next' => false,
			// 'total'     => $query->max_num_pages,
			// )
			// );
			// endif;
			wp_reset_postdata();
			echo wp_json_encode( $res );
			wp_die();
		}
	}

	$extra = new Theme_Extra();
	$extra->init();
}


/**
 * Like get_template_part() put lets you pass args to the template file
 * Args are available in the tempalte as $template_args array
 *
 * @param string $file template file url
 * @param mixed  $template_args style argument list
 * @param mixed  $cache_args cache args
 *  https://wordpress.stackexchange.com/questions/176804/passing-a-variable-to-get-template-part
 */
function get_template_part_args( $file, $template_args = array(), $cache_args = array() ) {
	$template_args = wp_parse_args( $template_args );
	$cache_args    = wp_parse_args( $cache_args );
	if ( $cache_args ) {
		foreach ( $template_args as $key => $value ) {
			if ( is_scalar( $value ) || is_array( $value ) ) {
				$cache_args[ $key ] = $value;
			} elseif ( is_object( $value ) && method_exists( $value, 'get_id' ) ) {
				$cache_args[ $key ] = call_user_func( 'get_id', $value );
			}
		}
		// phpcs:disabled WordPress.PHP.DiscouragedPHPFunctions.serialize_serialize
		$cache = wp_cache_get( $file, serialize( $cache_args ) );
		if ( false !== $cache ) {
			if ( ! empty( $template_args['return'] ) ) {
				return $cache;
			}
			// phpcs:disabled WordPress.Security.EscapeOutput.OutputNotEscaped
			echo $cache;
			return;
		}
	}
	$file_handle = $file;
	do_action( 'start_operation', 'hm_template_part::' . $file_handle );
	if ( file_exists( get_stylesheet_directory() . '/' . $file . '.php' ) ) {
		$file = get_stylesheet_directory() . '/' . $file . '.php';
	} elseif ( file_exists( get_template_directory() . '/' . $file . '.php' ) ) {
		$file = get_template_directory() . '/' . $file . '.php';
	}
	ob_start();
	$return = require $file;
	$data   = ob_get_clean();
	do_action( 'end_operation', 'hm_template_part::' . $file_handle );
	if ( $cache_args ) {
		wp_cache_set( $file, $data, serialize( $cache_args ), 3600 );
	}
	if ( ! empty( $template_args['return'] ) ) {
		if ( false === $return ) {
			return false;
		} else {
			return $data;
		}
	}
	echo $data;
}



/**
 *
 */

function get_nav_menu_item_children( $parent_id, $nav_menu_items, $depth = true ) {
	$nav_menu_item_list = array();
	foreach ( (array) $nav_menu_items as $nav_menu_item ) {
		if ( $nav_menu_item->menu_item_parent == $parent_id ) {
			$nav_menu_item_list[] = $nav_menu_item;
			if ( $depth ) {
				if ( $children = get_nav_menu_item_children( $nav_menu_item->ID, $nav_menu_items ) ) {
					$nav_menu_item_list = array_merge( $nav_menu_item_list, $children );
				}
			}
		}
	}
	return $nav_menu_item_list;
}

/**
 *
 */
function clean_header_menu( $theme_location ) {
	if ( ( $theme_location ) && ( $locations = get_nav_menu_locations() ) && isset( $locations[ $theme_location ] ) ) {
		$menu_list = '<ul class="header-menu--main">' . "\n";
		$post_id   = get_the_ID();

		$menu       = get_term( $locations[ $theme_location ], 'nav_menu' );
		$menu_items = wp_get_nav_menu_items( $menu->term_id );

		foreach ( $menu_items as $menu_item ) {
			$id = get_post_meta( $menu_item->ID, '_menu_item_object_id', true );

			if ( ! $menu_item->menu_item_parent ) {
				$curr_id     = $menu_item->ID;
				$menu_items2 = get_nav_menu_item_children( $curr_id, $menu_items );

				if ( $menu_items2 ) {
					$menu_list .= '<li class="menu-item' . ( ( $id == $post_id ) ? ' current-item ' : ' ' ) . 'menu-item-has-children">' . "\n";
				} else {
					$menu_list .= '<li class="' . ( ( $id == $post_id ) ? 'menu-item current-item ' : 'menu-item' ) . '">' . "\n";
				}

				$menu_list .= '<a href="' . $menu_item->url . '" class="menu-item-link">' . $menu_item->title . '</a>' . "\n";

				if ( $menu_items2 ) {
					$menu_list .= '<ul class="sub-menu">' . "\n";

					foreach ( $menu_items2 as $menu_item2 ) {
						if ( $menu_item2->menu_item_parent == $curr_id ) {
							$curr_id2 = $menu_item2->ID;

							$is_title   = get_field( 'is_title', $curr_id2 );
							$menu_list .= '<li class="sub-menu-item">';
							if ( $is_title ) :
								$menu_list .= '<span class="sub-menu__title">' . $menu_item2->title . '</span>';
							else :
								$menu_list .= '<a href="' . $menu_item2->url . '">' . $menu_item2->title . '</a>';
							endif;

							$menu_items3 = get_nav_menu_item_children( $curr_id2, $menu_items );

							if ( $menu_items3 ) {
								$menu_list .= '<ul>';

								foreach ( $menu_items3 as $menu_item3 ) {
									$menu_icon  = get_field( 'icon', $menu_item3->ID );
									$menu_list .= '<li>';
									$menu_list .= '<a href="' . $menu_item3->url . '">';
									if ( $menu_icon ) :
										$menu_list .= '<span class="menu-icon"><img src="' . $menu_icon['url'] . '" alt="' . $menu_icon['alt'] . '"></span>';
									endif;
									$menu_list .= '<div class="sub-menu-item__content"><p class="sub-menu-item__title">' . $menu_item3->title . '</p><p class="menu-item__desc">' . $menu_item3->description . '</p></div>';
									$menu_list .= '</a>';

									$menu_list .= '</li>';
								}

								$menu_list .= '</ul>';
							}

							$menu_list .= '</li>' . "\n";
						}
					}
					$menu_list .= '</ul>';
				}
				$menu_list .= '</li>' . "\n";
			}
		}
		$menu_list .= '</ul>' . "\n";
		echo $menu_list;
	}
}
