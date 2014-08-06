<?php  

define('THEME_NAME', 'hugo');

// Enable Features
	add_theme_support( 'post-thumbnails' );
	add_theme_support('editor_style');
	register_nav_menus(array(
		'header_menu' => 'Main Header Menu',
		'overlay_menu_l' => 'Overlay Menu Left',
		'overlay_menu_r' => 'Overlay Menu Right')
	);

// Add Actions
	add_action( 'init', 'add_editor_styles' );
	add_action( 'init', 'create_post_type' );
	add_action( 'init', 'album_category' );
	add_action( 'wp_enqueue_scripts', 'custom_styles', 30 );
	add_action( 'wp_enqueue_scripts', 'custom_scripts', 30 );

// Image sizes
	add_image_size( 'grid-item', 300, 9999, false );
	add_image_size( 'massive-image', 1800, 1100, false );
	add_image_size( 'desktop', 1000, 650, false );
	add_image_size( 'tablet', 650, 550, false );
	add_image_size( 'mobile', 250, 250, false );

// Functions
function add_editor_styles() {
    add_editor_style('/css/editor-styles.css');
}

function custom_styles(){
	wp_enqueue_style('googlefonts', 'http://fonts.googleapis.com/css?family=Fanwood+Text:400italic|Open+Sans:400,600');
	wp_enqueue_style('main', get_template_directory_uri() . '/css/main.css');
}

function custom_scripts(){
	wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/plugins/modernizr.js', array('jquery'), '');
	wp_enqueue_script('center', get_template_directory_uri() . '/js/plugins/jquery.center.js', array('jquery'), '');
	wp_enqueue_script('matchheight', get_template_directory_uri() . '/js/plugins/matchheight.js', array('jquery'), '');
	wp_enqueue_script('lazyload', get_template_directory_uri() . '/js/plugins/jquery.lazyload.js', array('jquery'), '', true);
	wp_enqueue_script('flexslider', get_template_directory_uri() . '/js/plugins/jquery.flexslider.js', array('jquery'), '', true);
	wp_enqueue_script('cookie', get_template_directory_uri() . '/js/plugins/jquery.cookie.js', array('jquery'), '', true);
	wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', array('jquery'), '', true);
}

// Custom Post Type
function create_post_type() {
	register_post_type( 'albums',
		array(
			'labels' => array(
				'name' => __( 'Albums' ),
				'singular_name' => __( 'Album' ),
				'add_new' => __('Add Album'),
				'search_items' => __('Search Albums'),
				'not_found' => __('No Albums Found')
			),
		'public' => true,
		'hierarchical' => true,
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
			'page-attributes'
			)
		)
	);
}

// Register Taxonomy
function album_category() {

	$labels = array(
		'name'					=> _x( 'Album Categories', 'Taxonomy plural name', 'text-domain' ),
		'singular_name'			=> _x( 'Album Category', 'Taxonomy singular name', 'text-domain' ),
		'search_items'			=> __( 'Search Album Categories', 'text-domain' ),
		'popular_items'			=> __( 'PopularAlbum Categories', 'text-domain' ),
		'all_items'				=> __( 'All Album Categories', 'text-domain' ),
		'parent_item'			=> __( 'Parent Album Category', 'text-domain' ),
		'parent_item_colon'		=> __( 'Parent Album Category', 'text-domain' ),
		'edit_item'				=> __( 'Edit Album Category', 'text-domain' ),
		'update_item'			=> __( 'Update Album Category', 'text-domain' ),
		'add_new_item'			=> __( 'Add New Album Category', 'text-domain' ),
		'new_item_name'			=> __( 'New Album Category', 'text-domain' ),
		'add_or_remove_items'	=> __( 'Add or remove Album Category', 'text-domain' ),
		'choose_from_most_used'	=> __( 'Choose from most used Album Categories', 'text-domain' ),
		'menu_name'				=> __( 'Album Category', 'text-domain' ),
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_admin_column' => true,
		'hierarchical'      => false,
		'show_tagcloud'     => true,
		'show_ui'           => true,
		'query_var'         => true,
		'rewrite'           => true,
		'query_var'         => true,
		'capabilities'      => array(),
	);

	register_taxonomy( 'album-category', array( 'albums' ), $args );
}

// REMOVE MENU ITEMS
add_action( 'admin_menu', 'my_remove_menu_pages',999 );

function my_remove_menu_pages() {
    $admins = array( 
        'admin', 
    );

    $current_user = wp_get_current_user();

    if( !in_array( $current_user->user_login, $admins ) ){
    
	    remove_menu_page('edit.php');
	    remove_menu_page('edit-comments.php');
	    remove_menu_page('plugins.php');
	    remove_menu_page('tools.php');
	    remove_menu_page('edit.php?post_type=acf');
	}
}


// MISC FUNCTIONS
function gallery_meta(){
	global $post;

	$categories = get_the_terms($post->ID, 'album-category' );

	foreach ($categories as $category) {
		$catname = $category->name;
	}

 	$output = $catname;
 	$output .= ' / ' . get_the_title();
 	echo ucwords($output);
}

function lightbox_images(){
	global $lightbox_images;

	//check if cookie exists with no query variable
	if(isset($_COOKIE["lightbox"]) && !isset($_GET['id'])){
		$lightbox_images = explode(',', $_COOKIE["lightbox"]);
	} 
	//if query exists
	else if(isset($_GET['id'])){
		$lightbox_images = explode(',', $_GET['id']);
	}

	if(sizeof($lightbox_images) >= 1){
		unset($lightbox_images[0]);
	}

	return $lightbox_images;
}

?>