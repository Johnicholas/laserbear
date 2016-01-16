<?php
/*
Plugin Name: Laserbear
Plugin URI:  http://shinesandjecker.com/laserbear.html
Description: A restful directory.
Version:     1.0
Author:      shines & jecker laboratories
Author URI:  http://shinesandjecker.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

// This is based primarily on http://v2.wp-api.org/extending/adding/

defined('ABSPATH') or die('No script kiddies please!');

add_action('rest_api_init', 'laserbear_rest_api_init');
function laserbear_rest_api_init() {
	register_rest_route('laserbear/v1', '/people', array(
		'methods' => 'GET',
		'callback' => 'laserbear_get_all_people'
	));

	register_rest_route('laserbear/v1', '/people/(?P<id>[\d]+)', array(
		'methods' => 'GET',
		'callback' => 'laserbear_get_one_person'
	));

	// TODO TODO This would be useful for discoverability
	//register_rest_route('laserbear/v1', '/people/schema', array(
	//	'methods' => WP_REST_Server::READABLE,
	//	'callback' => 'laserbear_get_schema'
	//));
	// END TODO TODO
}

function laserbear_get_all_people( $request ) {
	// TODO TODO This is just example data, we actually want to make a db query here
	$data = array( 'sarah', 'jennifer', 'katie', 'johnicholas' );
	// END TODO TODO

	return new WP_REST_Response( $data, 200 );
}

function laserbear_get_one_person( $request ) {
	$id = $request['id'];
	$data = array();

	// TODO TODO This is just example data, we actually want to make a db query here
	switch ($id) {
		case 0:
			$data['first'] = 'sarah';
			$data['last'] = 'hines';
			break;
		case 1:
			$data['first'] = 'jennifer';
			$data['last'] = 'ecker';
			break;
		case 2:
			$data['first'] = 'katie';
			$data['last'] = 'allen';
			break;
		case 3:
			$data['first'] = 'johnicholas';
			$data['last'] = 'hines';
			break;
		default:
			return new WP_Error( 'laserbear_person_not_found', 'Invalid person id', array( 'status' => 404 ) );
			break;
	}
	// END TODO TODO

	return new WP_REST_Response( $data, 200 );
}

add_action('wp_enqueue_scripts', 'laserbear_wp_enqueue_scripts');
function laserbear_wp_enqueue_scripts() {
	wp_register_script( 'laserbear',
		plugins_url( 'js/laserbear.js', __FILE__  ),
		array( 'jquery' )
	);
	wp_enqueue_script( 'laserbear' );
}

// TODO: this should probably go somewhere other than the footer,
// but I don't exactly know where
add_action('wp_footer', 'laserbear_wp_footer');
function laserbear_wp_footer($content) {
	echo '<div id="laserbear">';
	echo '  <ol id="laserbear_people">';
	echo '  </ol>';
	echo '  <div id="laserbear_person">';
	echo '  </div>';
	echo '  <button id="laserbear_refresh">Refresh People</button>';
	echo '</div>';
}


?>
