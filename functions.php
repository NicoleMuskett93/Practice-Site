<?php

/**
 * Theme setup.
 */
function football_setup() {
	add_theme_support( 'title-tag' );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'tailpress' ),
            'mobile' => __( 'Mobile Menu', 'tailpress')
		)
	);

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

    add_theme_support( 'custom-logo' );
	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );

	add_theme_support( 'editor-styles' );
	add_editor_style( 'css/editor-style.css' );
}

add_action( 'after_setup_theme', 'football_setup' );

/**
 * Enqueue theme assets.
 */
function football_enqueue_scripts() {
	$theme = wp_get_theme();

	wp_enqueue_style( 'tailpress', football_asset( 'css/app.css' ), array(), $theme->get( 'Version' ) );
	wp_enqueue_script( 'tailpress', football_asset( 'js/app.js' ), array(), $theme->get( 'Version' ) );
}

add_action( 'wp_enqueue_scripts', 'football_enqueue_scripts' );

/**
 * Get asset path.
 *
 * @param string  $path Path to asset.
 *
 * @return string
 */
function football_asset( $path ) {
	if ( wp_get_environment_type() === 'production' ) {
		return get_stylesheet_directory_uri() . '/' . $path;
	}

	return add_query_arg( 'time', time(),  get_stylesheet_directory_uri() . '/' . $path );
}

/**
 * Adds option 'li_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param mixed   $item The current item.
 * @param WP_Term $args Holds the nav menu arguments.
 *
 * @return array
 */
function football_nav_menu_add_li_class( $classes, $item, $args, $depth ) {
	if ( isset( $args->li_class ) ) {
		$classes[] = $args->li_class;
	}

	if ( isset( $args->{"li_class_$depth"} ) ) {
		$classes[] = $args->{"li_class_$depth"};
	}

	return $classes;
}

add_filter( 'nav_menu_css_class', 'football_nav_menu_add_li_class', 10, 4 );

/**
 * Adds option 'submenu_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param mixed   $item The current item.
 * @param WP_Term $args Holds the nav menu arguments.
 *
 * @return array
 */
function football_nav_menu_add_submenu_class( $classes, $args, $depth ) {
	if ( isset( $args->submenu_class ) ) {
		$classes[] = $args->submenu_class;
	}

	if ( isset( $args->{"submenu_class_$depth"} ) ) {
		$classes[] = $args->{"submenu_class_$depth"};
	}

	return $classes;
}

add_filter( 'nav_menu_submenu_css_class', 'football_nav_menu_add_submenu_class', 10, 3 );


add_action('init', 'register_team');
function register_team(){
	register_post_type('team', [
		'label' => 'Teams',
		'public' => true,
		'capability_type' => 'post',
		'supports' => array('title', 'editor', 'thumbnail'), // Add thumbnail support
	]);
}

function get_teams_from_api() {
    $response = wp_remote_get('https://api.squiggle.com.au/?q=teams');

    if (is_wp_error($response)) {
        // Handle error if API request fails
        error_log('API request failed: ' . $response->get_error_message());
        return;
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true); // Decode JSON as an associative array

    if (!$data || !isset($data['teams'])) {
        // Handle invalid or empty API response
        error_log('Invalid or empty API response');
        return;
    }

    foreach ($data['teams'] as $team) {
        $team_name = isset($team['name']) ? sanitize_text_field($team['name']) : '';
        $team_abbrev = isset($team['abbrev']) ? sanitize_text_field($team['abbrev']) : '';
        $team_logo = isset($team['logo']) ? esc_url($team['logo']) : '';
        $team_debut = isset($team['debut']) ? intval($team['debut']) : 0;
        $team_retirement = isset($team['retirement']) ? intval($team['retirement']) : 0;

        if (!empty($team_name)) {
            // Check if team with the same name already exists
            $existing_team = get_page_by_title($team_name, OBJECT, 'team');

            if ($existing_team instanceof WP_Post) {
                // Team already exists, skip insertion
                continue;
            }

            $post_data = array(
                'post_title'    => $team_name,
                'post_type'     => 'team', // Custom post type
                'post_status'   => 'publish',
                'meta_input'    => array(
                    'team_abbrev'   => $team_abbrev,
                    'team_logo'     => $team_logo,
                    'team_debut'    => $team_debut,
                    'team_retirement' => $team_retirement
                )
            );

            // Insert post
            $post_id = wp_insert_post($post_data);

            if (is_wp_error($post_id)) {
                // Handle post insertion error
                error_log('Error inserting post: ' . $post_id->get_error_message());
            } else {
                // Post inserted successfully
                // Now handle the team logo
                if (!empty($team_logo)) {
                    $attachment_id = upload_image_from_url($team_logo, $post_id);

                    if (!is_wp_error($attachment_id)) {
                        set_post_thumbnail($post_id, $attachment_id);
                    } else {
                        error_log('Error uploading image: ' . $attachment_id->get_error_message());
                    }
                }
            }
        } else {
            // Log an error if team name is missing
            error_log('Team name is missing or empty');
        }
    }
}



add_action('init', 'get_teams_from_api');


function enqueue_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://kit.fontawesome.com/fbff19d369.css');
}

add_action('wp_enqueue_scripts', 'enqueue_font_awesome');
