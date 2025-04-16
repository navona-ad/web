<?php
/**
 * OceanWP Child Theme Functions
 *
 * When running a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions will be used.
 *
 * Text Domain: oceanwp
 * @link http://codex.wordpress.org/Plugin_API
 *
 */

/**
 * Load the parent style.css file
 *
 * @link http://codex.wordpress.org/Child_Themes
 */
function oceanwp_child_enqueue_parent_style() {

	// Dynamically get version number of the parent stylesheet (lets browsers re-cache your stylesheet when you update the theme).
	$theme   = wp_get_theme( 'OceanWP' );
	$version = $theme->get( 'Version' );

	// Load the stylesheet.
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'oceanwp-style' ), '1.0.0' );
	// Load the script.
    wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/custom.js', array('jquery'), null, true);
	
}

add_action( 'wp_enqueue_scripts', 'oceanwp_child_enqueue_parent_style' );

function social_share_buttons() {
    $current_url = urlencode(get_permalink());
    $site_url = get_site_url();
    ob_start(); ?>
    <div class="social-share">
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $current_url; ?>" target="_blank">
            <img src="<?php echo $site_url; ?>/wp-content/uploads/2025/04/share-fb.svg" alt="Share on Facebook">
        </a>
        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $current_url; ?>" target="_blank">
            <img src="<?php echo $site_url; ?>/wp-content/uploads/2025/04/share-in.svg" alt="Share on LinkedIn">
        </a>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('social_share', 'social_share_buttons');

function filter_area_content() {
    $current_url = urlencode(get_permalink());
    $site_url = get_site_url();
    ob_start();
    ?>
    <div class="d-flex filter-area">
		<div class="d-flex search-area">
            <img src="<?php echo $site_url; ?>/wp-content/uploads/2025/04/search-icon.svg" alt="search icon"/>
            <input type="text" id="search-keyword" name="search_keyword" placeholder="Job title or keywords" >
        </div>
        <?php
        if(is_page('careers')):?>
        <div class="d-flex filter-location-area">
            <img src="<?php echo $site_url; ?>/wp-content/uploads/2025/04/pin-icon.svg" alt="filter icon"/>
            <select id="location" name="location" class="location">
                <option value="">Location</option>
				<option value="ho-chi-minh">Ho Chi Minh</option>
                <option value="ha-noi">Ha Noi</option>
                <option value="da-nang">Da Nang</option>
            </select>
        </div>
        <button class="submit-filter" id="submit-filter">Find it now</button>
        <?php else: ?>
        <button class="submit-filter" id="submit-filter-jobs">Find it now</button>
        <?php endif; ?>
        
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('filter_area', 'filter_area_content');

add_action('elementor/query/jobs_filter_query', function($query) {
    // --- Keyword search ---
    if (!empty($_GET['keyword'])) {
        $keyword = sanitize_text_field($_GET['keyword']);
        $query->set('s', $keyword);

        add_filter('posts_search', 'custom_search_by_title_only', 10, 2);
    }
    // --- Taxonomy filters ---
    $tax_filters = [
        'e-filter-a00064f-location'     => 'location',
        'e-filter-a00064f-job_type'     => 'job_type',
        'e-filter-a00064f-career_level' => 'career_level',
    ];

    $tax_query = ['relation' => 'AND'];

    foreach ($tax_filters as $param => $taxonomy) {
        if (!empty($_GET[$param])) {
            $terms = array_map('sanitize_text_field', (array) $_GET[$param]);

            if (!is_array($terms)) {
                $terms = [$terms];
            }
            $tax_query[] = [
                'taxonomy' => $taxonomy,
                'field'    => 'slug',
                'terms'    => $terms,
            ];
        }
    }

    if (count($tax_query) > 1) {
        $query->set('tax_query', $tax_query);
    }

    add_filter('elementor_pro/posts/query/ids', function($post_ids) use ($query) {
        if (!$query->have_posts()) {
            return [];
        }
        return $post_ids;
    });
});

function custom_search_by_title_only($search, $wp_query) {
    global $wpdb;
    if (empty($search)) return $search;
    $q = $wp_query->query_vars;
    if (!empty($q['s'])) {
        $search = '';
        $search_terms = array_map('esc_sql', explode(' ', $q['s']));
        foreach ($search_terms as $term) {
            if (!empty($term)) {
                $search .= " AND {$wpdb->posts}.post_title LIKE '%{$term}%'";
            }
        }
    }
    return $search;
}

