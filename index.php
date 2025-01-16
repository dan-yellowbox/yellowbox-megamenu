<?php
/*
Plugin Name:  Yellow Box Marketing Megamenu
Plugin URI:   https://www.yellowboxmarketing.co.uk
Description:  Yellow Box Marketing Megamenu
Version:      1.0
Author:       Yellow Box Marketing
Author URI:   https://www.yellowboxmarketing.co.uk
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  ymb-megamenu
*/

// Unhook Megamenu
// add_action('wp', 'unhook_megamenu');
// function unhook_megamenu () {
//   remove_action( 'yellowbox_navigation_end', 'yellowbox_hook_megamenu');
// }

// Check for Dependencies
add_action( 'admin_init', 'megamenu_plugin_dependencies' );
function megamenu_plugin_dependencies() {
  if ( is_admin() && current_user_can( 'activate_plugins' ) &&  ( !is_plugin_active( 'acf-plugin/acf.php' ) && !is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) ) {
    add_action( 'admin_notices', 'megamenu_dependencies_notice' );
    deactivate_plugins( plugin_basename( __FILE__ ) );
    if ( isset( $_GET['activate'] ) ) {
      unset( $_GET['activate'] );
    }
  }
}
function megamenu_dependencies_notice(){
  echo '<div class="error"><p>Error: Megamenu plugin requires Advanced Custom Fields Pro.</p></div>';
}


// Register Post Type
function create_posttype_megamenus() {
  $labels = array(
    'name'                => _x( 'Megamenus', 'Post Type General Name', 'yellowbox' ),
    'singular_name'       => _x( 'Megamenu', 'Post Type Singular Name', 'yellowbox' ),
    'menu_name'           => __( 'Megamenus', 'yellowbox' ),
    'parent_item_colon'   => __( 'Parent Megamenu', 'yellowbox' ),
    'all_items'           => __( 'All Megamenus', 'yellowbox' ),
    'view_item'           => __( 'View Megamenu', 'yellowbox' ),
    'add_new_item'        => __( 'Add New Megamenu', 'yellowbox' ),
    'add_new'             => __( 'Add New', 'yellowbox' ),
    'edit_item'           => __( 'Edit Megamenu', 'yellowbox' ),
    'update_item'         => __( 'Update Megamenu', 'yellowbox' ),
    'search_items'        => __( 'Search Megamenu', 'yellowbox' ),
    'not_found'           => __( 'Not Found', 'yellowbox' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'yellowbox' ),
  );

  $args = array(
    'label'               => __( 'megamenus', 'yellowbox' ),
    'description'         => __( 'Megamenus', 'yellowbox' ),
    'labels'              => $labels,
    'supports'            => array( 'title' ),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 30,
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'post',
    'show_in_rest' => true,
    'menu_icon'           => 'dashicons-menu-alt3',
  );

  register_post_type( 'megamenus', $args );
}
add_action( 'init', 'create_posttype_megamenus' );

// Register Custom Fields
function my_acf_add_local_field_groups() {

  // Register Megamenu Fields
	acf_add_local_field_group(array(
		'key' => 'megamenu',
		'title' => 'Megamenu',
		'fields' => array (
      array(
        'key' => 'field_609d1fa65108f',
        'label' => 'Columns',
        'name' => 'columns',
        'type' => 'repeater',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'collapsed' => 'field_609d1fb651090',
        'min' => 1,
        'max' => 5,
        'layout' => 'block',
        'button_label' => 'Add Column',
        'sub_fields' => array(
          array(
            'key' => 'field_611652ef3cdd6',
            'label' => 'Type',
            'name' => 'type',
            'type' => 'select',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'choices' => array(
              'links' => 'Links',
              'card' => 'Card',
            ),
            'default_value' => false,
            'allow_null' => 0,
            'multiple' => 0,
            'ui' => 0,
            'return_format' => 'value',
            'ajax' => 0,
            'placeholder' => '',
          ),
          array(
            'key' => 'field_609d1fb651090',
            'label' => 'Heading',
            'name' => 'heading',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
              array(
                array(
                  'field' => 'field_611652ef3cdd6',
                  'operator' => '==',
                  'value' => 'links',
                ),
              ),
            ),
            'wrapper' => array(
              'width' => '75%',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
          ),
          array(
            'key' => 'field_609d1fb641090',
            'label' => 'Heading Link',
            'name' => 'heading_link',
            'type' => 'link',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
              array(
                array(
                  'field' => 'field_611652ef3cdd6',
                  'operator' => '==',
                  'value' => 'links',
                ),
              ),
            ),
            'wrapper' => array(
              'width' => '25%',
              'class' => '',
              'id' => '',
            ),
            'return_format' => 'array',
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
          ),
          array(
            'key' => 'field_609d1fd251091',
            'label' => 'Links',
            'name' => 'links',
            'type' => 'repeater',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
              array(
                array(
                  'field' => 'field_611652ef3cdd6',
                  'operator' => '==',
                  'value' => 'links',
                ),
              ),
            ),
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'collapsed' => '',
            'min' => 1,
            'max' => 0,
            'layout' => 'table',
            'button_label' => 'Add Link',
            'sub_fields' => array(
              array(
                'key' => 'field_609d1ffa51092',
                'label' => 'Link',
                'name' => 'link',
                'type' => 'link',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => '',
                ),
                'return_format' => 'array',
              ),
            ),
          ),
          array(
            'key' => 'field_611653463cdd8',
            'label' => 'Heading / Link',
            'name' => 'link',
            'type' => 'link',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
              array(
                array(
                  'field' => 'field_611652ef3cdd6',
                  'operator' => '==',
                  'value' => 'card',
                ),
              ),
            ),
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'return_format' => 'array',
          ),
          array(
            'key' => 'field_619b67d6c7ce3',
            'label' => 'Description',
            'name' => 'description',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
              array(
                array(
                  'field' => 'field_611652ef3cdd6',
                  'operator' => '==',
                  'value' => 'card',
                ),
              ),
            ),
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
          ),
          array(
            'key' => 'field_611653303cdd7',
            'label' => 'Image',
            'name' => 'image',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
              array(
                array(
                  'field' => 'field_611652ef3cdd6',
                  'operator' => '==',
                  'value' => 'card',
                ),
              ),
            ),
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'return_format' => 'array',
            'preview_size' => 'acf-thumbnail',
            'library' => 'all',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
          ),
        ),
      ),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'megamenus',
				),
			),
		),
	));


  // Register Menu Item Fields
  acf_add_local_field_group(array(
    'key' => 'megamenu_choice',
    'title' => 'Megamenu',
    'fields' => array (
      array (
        'key' => 'megamenu_choice',
        'label' => 'Megamenu',
        'name' => 'megamenu_choice',
        'type' => 'post_object',
        'post_type' => 'megamenus',
        'taxonomy' => '',
        'allow_null' => 0,
        'multiple' => 0,
        'return_format' => 'id',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'nav_menu_item',
          'operator' => '==',
          'value' => 'location/primary-menu',
        ),
      ),
    ),
  ));
}
add_action('acf/init', 'my_acf_add_local_field_groups');

// Hook into Theme
function yellowbox_hook_megamenu() {
  $megamenus = array();
  $menu_locations = get_nav_menu_locations();
  $menu_id = $menu_locations['primary-menu'];
  $primary_menu = wp_get_nav_menu_items($menu_id);

  foreach ( $primary_menu as $nav_item ) {
    if( $megamenu_id = get_field('megamenu_choice', $nav_item->ID) ) {
      $megamenus[] = $megamenu_id;
    }
  }

  $args = array(
    'post_type' => 'megamenus',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'post__in' => $megamenus,
  );

  $loop = new WP_Query( $args );

  while ( $loop->have_posts() ) : $loop->the_post();
    echo '<section id="megamenu-' . get_the_ID() . '" class="megamenu bg-white py-5 shadow-lg">';
      echo '<div class="container">';
        echo '<div class="row">';
          if( $columns = get_field('columns') ) {
            foreach( $columns as $column ) {
              if( $column['type'] == 'links' ) {
                echo '<div class="col">';
                  if( $column['heading_link'] ) {
                    echo '<h5 class="fs-6 border-bottom pb-3 mb-4 subheading"><a href="' . $column['heading_link']['url'] . '" target="' . $column['heading_link']['target'] . '" class="text-decoration-none">' . $column['heading'] . '</a></h5>';
                  } else {
                    echo '<h5 class="fs-6 border-bottom pb-3 mb-4 subheading">' . $column['heading'] . '</h5>';
                  }
                  echo '<ul class="list-unstyled mb-0">';
                    if( $column['links'] ) {
                      foreach( $column['links'] as $link) {
                        echo '<li>';
                          echo '<a href="' . $link['link']['url'] . '" target="' . $link['link']['target'] . '" class="text-decoration-none">' . $link['link']['title'] . '</a>';
                        echo '</li>';
                      }
                    }
                  echo '</ul>';
                echo '</div>';
              } elseif ( $column['type'] == 'card' ) {
                echo '<div class="col-4 megamenu-card">';
                  echo  '<a href="' . $column['link']['url'] . '" target="' . $column['link']['target'] . '" class="text-decoration-none text-gray">';
                    echo  wp_get_attachment_image($column['image']['ID'], 'medium', '', array('class'=>'mb-3 w-100'));
                    echo '<h5 class="fs-6 subheading">' . $column['link']['title'] . '</h5>';
                    echo ( $column['description'] ? '<p class="small mt-2">' . $column['description'] . '</h5>' : '');
                  echo '</a>';
                echo '</div>';
              }
            }
          }
        echo '</div>';
      echo '</div>';
    echo '</section>';
  endwhile;
  wp_reset_postdata();
}
add_action('yellowbox_navigation_end', 'yellowbox_hook_megamenu');

function yellowbox_megamenu_style() {
  echo "<style>
    .megamenu {
      position: absolute;
      left: 0;
      right: 0;
      display: none;
      z-index: 50;
      top: 100%;
    }
  </style>";
}
add_action('wp_head', 'yellowbox_megamenu_style');

function yellowbox_megamenu_scripts() {
  echo "<script>
  jQuery('#navigationDesktop .nav-item > .nav-link').on('mouseenter', function() {
    var id = jQuery(this).data('megamenu');
    jQuery('.megamenu.show').hide().removeClass('hide');
    jQuery('#' + id).show().addClass('show');
  });
  jQuery('.megamenu').on('mouseleave', function() {
    jQuery(this).hide().removeClass('show');
  });
  </script>";
}
add_action('wp_footer', 'yellowbox_megamenu_scripts');
