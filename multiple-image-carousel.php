<?php
/*
Plugin name: Multiple Image Carousel
Description: plugin for create Multiple Image Carousel.
Version: 0.1.0
Author: Webgensis Team
*/
/*************** add css and js file ****************/
function mic_scripts(){
   wp_enqueue_script('jquery');
   wp_enqueue_script('slider-script', plugin_dir_url( __FILE__ ) . '/js/owl.carousel.min.js');
   wp_enqueue_style('slider-style', plugin_dir_url( __FILE__ ) . '/css/owl.carousel.min.css');
}
add_action( 'wp_enqueue_scripts', 'mic_scripts' );
/*********** Register Post Type for Slider ***********/
add_action('init', 'mic_init');
function mic_init() {
	   $labels = array(
		'name'               => _x( 'Multiple Carousels'),
		'singular_name'      => _x( 'Multiple Carousel'),
		'menu_name'          => _x( 'Multiple Carousels'),
		'name_admin_bar'     => _x( 'Multiple Carousel'),
		'add_new'            => _x( 'Add New', 'Carousel'),
		'add_new_item'       => __( 'Add New Carousel'),
		'new_item'           => __( 'New Carousel'),
		'edit_item'          => __( 'Edit Carousel'),
		'all_items'          => __( 'All Carousels'),
		'search_items'       => __( 'Search Carousel'),
		'not_found'          => __( 'No Carousel found.'),
		'not_found_in_trash' => __( 'No Carousel found in Trash.')
	);

    $args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'multiplecarousel' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title')
	);
    
	register_post_type( 'multiplecarousel', $args );
  }
/********************* Integrate CMB2 For Meta Box ********************/
 if (file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}
add_action( 'cmb2_admin_init', 'mic_metaboxes');
function mic_metaboxes() {
	$cmb = new_cmb2_box( array(
       'id'            => 'mic_setting_metabox',
       'title'         => __( 'Carousel Setting', 'cmb2' ),
       'object_types'  => array( 'multiplecarousel', ),
       'context'       => 'normal',
       'priority'      => 'high',
       'show_names'    => true, 
      ) );	
	
	$cmb->add_field( array(
	'name'    => 'Loop',
	'id'      => 'mic_loop',
	'type'    => 'radio_inline',
	'options' => array(
		'standard' => __( 'true', 'cmb2' ),
		'custom'   => __( 'false', 'cmb2' ),
	 ),
	'default' => 'standard',
    ) );
	
	$cmb->add_field( array(
	'name'    => 'Auto Play',
	'id'      => 'mic_autoplay',
	'type'    => 'radio_inline',
	'options' => array(
		'standard' => __( 'true', 'cmb2' ),
		'custom'   => __( 'false', 'cmb2' ),
	 ),
	'default' => 'standard',
     ) ); 
	
	 $cmb->add_field( array(
	'name'    => 'Show Dots',
	'id'      => 'mic_dots',
	'type'    => 'radio_inline',
	'options' => array(
		'standard' => __( 'true', 'cmb2' ),
		'custom'   => __( 'false', 'cmb2' ),
	 ),
	'default' => 'standard',
    ) ); 
	
	$cmb->add_field( array(
	'name'    => 'Show Arrow',
	'id'      => 'mic_arrow',
	'type'    => 'radio_inline',
	'options' => array(
		'standard' => __( 'true', 'cmb2' ),
		'custom'   => __( 'false', 'cmb2' ),
	 ),
	'default' => 'standard',
     ) );
	  
	 $cmb->add_field( array(
	'name'    => 'Canter Mode',
	'id'      => 'mic_centermode',
	'type'    => 'radio_inline',
	'options' => array(
		'standard' => __( 'true', 'cmb2' ),
		'custom'   => __( 'false', 'cmb2' ),
	 ),
	'default' => 'custom',
     ) );  
	 
	  $cmb->add_field( array(
	'name'    => 'Right To Left Direction',
	'id'      => 'mic_direction',
	'type'    => 'radio_inline',
	'options' => array(
		'standard' => __( 'true', 'cmb2' ),
		'custom'   => __( 'false', 'cmb2' ),
	 ),
	'default' => 'custom',
     ) );  
	 
	 $cmb->add_field( array(
	'name'    => 'Autoplay Pause on Hover',
	'id'      => 'mic_hover',
	'type'    => 'radio_inline',
	'options' => array(
		'standard' => __( 'true', 'cmb2' ),
		'custom'   => __( 'false', 'cmb2' ),
	 ),
	'default' => 'custom',
     ) ); 
	 
	 $cmb->add_field( array(
	'name'    => 'Touch Drag',
	'id'      => 'mic_touch',
	'type'    => 'radio_inline',
	'options' => array(
		'standard' => __( 'true', 'cmb2' ),
		'custom'   => __( 'false', 'cmb2' ),
	 ),
	'default' => 'standard',
     ) );
	 
	 $cmb->add_field( array(
	'name'    => 'Mouse Drag',
	'id'      => 'mic_mouse',
	'type'    => 'radio_inline',
	'options' => array(
		'standard' => __( 'true', 'cmb2' ),
		'custom'   => __( 'false', 'cmb2' ),
	 ),
	'default' => 'standard',
     ) );
	 
	$cmb->add_field( array(
	'name'    => 'Number Of Item You Want To Show',
	'desc'    => 'please enter numeric value ',
	'id'      => 'mic_itemnumber',
	'type'    => 'text_small'
     ) ); 
	 
	$cmb->add_field( array(
	'name'    => 'Margin',
	'desc'    => 'please enter numeric value without px',
	'id'      => 'mic_margin',
	'type'    => 'text_small'
     ) ); 
	 
    $cmb->add_field( array(
	'name'    => 'Stage Padding',
	'desc'    => 'please enter numeric value without px',
	'id'      => 'mic_padding',
	'type'    => 'text_small'
     ) );
	 
	 $cmb->add_field( array(
	'name'    => 'Start Position',
	'desc'    => 'please enter numeric value without',
	'id'      => 'mic_position',
	'type'    => 'text_small'
     ) ); 
	 
	 $cmb->add_field( array(
	'name'    => 'Autoplay Speed',
	'desc'    => 'please enter numeric value(1000 = 1s)',
	'id'      => 'mic_speed',
	'type'    => 'text_small'
     ) ); 
	 
	 $cmb->add_field( array(
	'name'    => 'Slide By',
	'desc'    => 'please enter numeric value',
	'id'      => 'mic_slideby',
	'type'    => 'text_small'
     ) ); 
	 
	$cmb->add_field( array(
	'name' => 'Responsive Option',
	'type' => 'title',
	'id'   => 'mic_responsive'
    ) );
	 
	$cmb->add_field( array(
	'name'    => 'How Many Items Show between 1000 to 600 screen',
	'desc'    => 'please enter numeric value',
	'id'      => 'mic_600width',
	'type'    => 'text_small'
     ) );
	 
	$cmb->add_field( array(
	'name'    => 'How Many Items Show On After 600 screen',
	'desc'    => 'please enter numeric value',
	'id'      => 'mic_600afterwidth',
	'type'    => 'text_small'
     ) );
	 	  
	$cmb1 = new_cmb2_box( array(
        'id'            => 'mic_content_metabox',
        'title'         => __( 'Carousel Images', 'cmb2' ),
        'object_types'  => array( 'multiplecarousel', ),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, 
      ) );      
	
	$group_field_id = $cmb1->add_field( array(
    'id'          => 'mic_repeat',
    'type'        => 'group',
    'options'     => array(
        'group_title'   => __( 'Image {#}', 'cmb2' ), 
        'add_button'    => __( 'Add Another Image', 'cmb2' ),
        'remove_button' => __( 'Remove Image', 'cmb2' ),
        'sortable'      => true,   
     ),
    ) );
    $cmb1->add_group_field( $group_field_id, array(
    'name' => 'Image',
    'id'   => 'mic_image',
    'type' => 'file',
    ) );	
  } 
/********************* Add Shortcode *******************/
function mic_shortcode($atts)
 { 
  extract(shortcode_atts(array(
  'slider_id' => '',
  'post_type' => 'multiplecarousel',
   ) , $atts));
  $args = array(
  'post_type' =>'multiplecarousel',
   'p' => $slider_id,
  );
  $query = new WP_Query($args);
  if ($query->have_posts()):
  while ($query->have_posts()):
  $query->the_post();
  $mic_repeat = get_post_meta( get_the_ID(), 'mic_repeat', true );   
  $mic_loop = get_post_meta( get_the_ID(), 'mic_loop', true );
  $mic_autoplay = get_post_meta( get_the_ID(), 'mic_autoplay', true );
  $mic_dots = get_post_meta( get_the_ID(), 'mic_dots', true );
  $mic_arrow = get_post_meta( get_the_ID(), 'mic_arrow', true );
  $mic_centermode = get_post_meta( get_the_ID(), 'mic_centermode', true );
  $mic_direction = get_post_meta( get_the_ID(), 'mic_direction', true );
  $mic_hover = get_post_meta( get_the_ID(), 'mic_hover', true );
  $mic_touch = get_post_meta( get_the_ID(), 'mic_touch', true );
  $mic_mouse = get_post_meta( get_the_ID(), 'mic_mouse', true );
  $mic_itemnumber = get_post_meta( get_the_ID(), 'mic_itemnumber', true );
  $mic_margin = get_post_meta( get_the_ID(), 'mic_margin', true );
  $mic_padding = get_post_meta( get_the_ID(), 'mic_padding', true );
  $mic_position = get_post_meta( get_the_ID(), 'mic_position', true );
  $mic_speed = get_post_meta( get_the_ID(), 'mic_speed', true );
  $mic_slideby = get_post_meta( get_the_ID(), 'mic_slideby', true );
  $mic_600width = get_post_meta( get_the_ID(), 'mic_600width', true );
  $mic_600afterwidth = get_post_meta( get_the_ID(), 'mic_600afterwidth', true );
  ?>
   <script>
    jQuery(document).ready(function(){
    jQuery('.owl-carousel').owlCarousel({
    loop:<?php if($mic_loop == 'standard'){echo "true"; }else{ echo "false"; }?>,
	autoplay:<?php if($mic_autoplay == 'standard'){echo "true"; }else{ echo "false"; }?>,
	dots:<?php if($mic_dots == 'standard'){echo "true"; }else{ echo "false"; }?>,
	nav:<?php if($mic_arrow == 'standard'){echo "true"; }else{ echo "false"; }?>,
	center:<?php if($mic_centermode == 'standard'){echo "true"; }else{ echo "false"; }?>,
	rtl:<?php if($mic_direction == 'standard'){echo "true"; }else{ echo "false"; }?>,
	autoplayHoverPause:<?php if($mic_hover == 'standard'){echo "true"; }else{ echo "false"; }?>,
	touchDrag:<?php if($mic_touch == 'standard'){echo "true"; }else{ echo "false"; }?>,
	mouseDrag:<?php if($mic_mouse == 'standard'){echo "true"; }else{ echo "false"; }?>,
    margin:<?php if(!empty($mic_margin)){ echo $mic_margin; }else{ echo 10; }?>,
    stagePadding:<?php if(!empty($mic_padding)){ echo $mic_padding; }else{ echo 0; }?>,
	startPosition:<?php if(!empty($mic_position)){ echo $mic_position; }else{ echo 0; }?>,
	autoplaySpeed:<?php if(!empty($mic_speed)){ echo $mic_speed; }else{ echo 5000; }?>,
	slideBy:<?php if(!empty($mic_slideby)){ echo $mic_slideby; }else{ echo 1; }?>,  
    responsive:{
        0:{
            items:<?php if(!empty($mic_600afterwidth)){ echo $mic_600afterwidth; }else{ echo 1; }?>
        },
        600:{
            items:<?php if(!empty($mic_600width)){ echo $mic_600width; }else{ echo 2; }?>
        },
		1000:{
            items:<?php if(!empty($mic_itemnumber)){ echo $mic_itemnumber; }else{ echo 4; }?>
        },
      }
     })
    });  
   </script>   
    <div class="owl-carousel owl-theme">
    <?php 
	 foreach ( $mic_repeat as $key => $mic_repeats ) {
     $mic_image=$mic_repeats['mic_image'];
     ?>
     <div class="item"><img src="<?php echo $mic_image; ?>"  /></div>
    <?php } ?>
   </div>
  <?php
  endwhile;
  wp_reset_postdata();
  endif;
  }
 add_shortcode('mic', 'mic_shortcode');
/*********************** Show Short code ******************/
add_filter('manage_multiplecarousel_posts_columns', 'mic_head_multiplecarousel', 10);
add_action('manage_multiplecarousel_posts_custom_column', 'mic_only_multiplecarousel', 10, 2);
function mic_head_multiplecarousel($defaults) {
    $defaults['shortcode_name'] = 'Shortcode';
    return $defaults;
	}
function mic_only_multiplecarousel($column_name, $post_ID) {
    if ($column_name == 'shortcode_name') {
        echo "[mic slider_id=". $post_ID. "]";
    }
}