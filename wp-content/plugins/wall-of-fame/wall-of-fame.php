<?php
/*
Plugin Name: Wall of Fame
Description: A custom WordPress plugin that adds a new dashboard menu for inputting a list of comma-separated names and provides a shortcode for displaying the list in a modal.
Version: 1.0
Author: Your Name
*/

// Add a new dashboard menu
add_action('admin_menu', 'wof_add_menu_page');
function wof_add_menu_page() {
    add_menu_page('Wall of Fame', 'Wall of Fame', 'manage_options', 'wall-of-fame', 'wof_render_menu_page');
}

// Enqueue the plugin stylesheet and scripts
add_action('wp_enqueue_scripts', 'wof_enqueues');
function wof_enqueues() {
    wp_enqueue_style('wof-styles', plugin_dir_url(__FILE__) . '/css/wall-of-fame-styles.css');
    wp_enqueue_script('wof-scripts', plugin_dir_url(__FILE__) . '/js/wall-of-fame-scripts.js', array(), false, true);
}



// Render the dashboard menu page
function wof_render_menu_page() {
    // Check if the form has been submitted
    if (isset($_POST['wof_names'])) {
        // Update the list of names in the database
        update_option('wof_names', sanitize_textarea_field($_POST['wof_names']));
    }

    // Get the current list of names from the database
    $names = get_option('wof_names', '');

    // Render the input form
    echo '<h1>Wall of Fame</h1>';
    echo '<form method="post">';
    echo '<p><label for="wof_names">Enter a list of comma separated names:</label></p>';
    echo '<p><textarea id="wof_names" name="wof_names" rows="30" cols="100">' . esc_textarea($names) . '</textarea></p>';
    echo '<p><input type="submit" value="Save"></p>';
    echo '</form>';
}


// Create a shortcode for displaying the list of names in a modal
add_shortcode('wall_of_fame', 'wof_render_shortcode');
function wof_render_shortcode() {
   
    // Get the current list of names from the database
    $names = get_option('wof_names', '');

    // Split the list of names by commas
    $names_array = explode(',', $names);

    // Split the names array into two halves
    $names_left = array_slice($names_array, 0, ceil(count($names_array) / 2));
    $names_right = array_slice($names_array, ceil(count($names_array) / 2));

    // Generate the button and modal HTML
    $html = '<button id="wof_button">Show Wall of Fame</button>';
    $html .= '<div id="wof_modal" style="display:none;">';
    $html .= '<div id="wof_modal_content">';
    $html .= '<span id="wof_close">&times;</span>';
    $html .= '<h2>Wall of Fame</h2>';
    $html .= '<div>';
    $html .= '<div style="flex:1;">';
    $html .= '<ul>';
    foreach ($names_left as $name) {
        $html .= '<li>' . esc_html(trim($name)) . '</li>';
    }
    $html .= '</ul>';
    $html .= '</div>';
    $html .= '<div style="flex:1;">';
    $html .= '<ul>';
    foreach ($names_right as $name) {
        $html .= '<li>' . esc_html(trim($name)) . '</li>';
    }
    $html .= '</ul>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';

    return $html; 
}
