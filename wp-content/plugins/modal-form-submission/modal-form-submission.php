<?php
/*
Plugin Name: Custom Modal Form
Description: A plugin that creates a shortcode to display a button that opens a modal with a custom form.
*/

// Create custom database table on plugin activation
function custom_modal_form_activation() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'custom_modal_form';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        artist_name varchar(255) NOT NULL,
        title_of_work varchar(255) NOT NULL,
        instagram_handle varchar(255) NOT NULL,
        email varchar(255) NOT NULL,
        image_file varchar(255) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'custom_modal_form_activation');

// Enqueue JavaScript for AJAX form submission
function custom_modal_form_enqueue_scripts() {
    wp_enqueue_script('custom-modal-form', plugin_dir_url(__FILE__) . 'js/custom-modal-form.js', array(), false, true);
    wp_localize_script('custom-modal-form', 'custom_modal_form_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('custom_modal_form_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'custom_modal_form_enqueue_scripts');

// Handle AJAX form submission
function custom_modal_form_submit() {
    check_ajax_referer('custom_modal_form_nonce');

    global $wpdb;
    $table_name = $wpdb->prefix . 'custom_modal_form';

    $artist_name = sanitize_text_field($_POST['artist_name']);
    $title_of_work = sanitize_text_field($_POST['title_of_work']);
    $instagram_handle = sanitize_text_field($_POST['instagram_handle']);
    $email = sanitize_email($_POST['email']);
    $image_file = sanitize_text_field($_POST['image_file']);

    $wpdb->insert($table_name, array(
        'artist_name' => $artist_name,
        'title_of_work' => $title_of_work,
        'instagram_handle' => $instagram_handle,
        'email' => $email,
        'image_file' => $image_file
    ));

    wp_die();
}
add_action('wp_ajax_custom_modal_form_submit', 'custom_modal_form_submit');
add_action('wp_ajax_nopriv_custom_modal_form_submit', 'custom_modal_form_submit');

// Create shortcode for button and modal
function custom_modal_form_shortcode() {
    ob_start();
    ?>

    <style>

      /* Add styles for modal overlay */
      #custom-modal-form-overlay {
          position: fixed;
          backdrop-filter: blur(10px);
          top: 0;
          left: 0;
          width: 100%;
          max-width: 100%;
          height: 100%;
          background-color: rgba(3, 69, 173, 0.5);
          z-index: 9999;
          display: none;
      }

      /* Add styles for modal */
      #custom-modal-form-modal {
          position: fixed;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          background-color: #fff;
          padding: 2% 2% 2% 4%;
          z-index: 10000;
          display: none;
      }

      #custom-modal-form-button {
        border: none;
        padding: 1% 2%;
        cursor: pointer;
      }

      #modal-close {
        position: absolute;
        top: 5vh;
        right: 5vw;
        cursor: pointer;
      }

      .one-half-column {
        width: 50%;
      }

      .display-flex {
        display: flex;
      }

      .flex-wrap {
        flex-wrap: wrap;
      }

      .flex-column {
        flex-direction: column;
      }

      input {
        width: 80%;
        padding: 2%
      }

      .full-column {
        width: 100%;
      }
    </style>

    <button id="custom-modal-form-button" class="motd-media-button white size-medium">SUBMIT HERE</button>
    <div id="custom-modal-form-overlay"></div>
    <div id="custom-modal-form-modal" style="display:none;">

        <span id="modal-close">X</span>

        <div class="center" style="padding: 0 10% 2% 8%;">
            <h2>Submit Your Art</h2>
            <p>To submit your artwork into our contest, please fill out the information below and upload your artwork:</p>
        </div>



        <form id="custom-modal-form" class="display-flex flex-wrap">

            <div class="one-half-column display-flex flex-column">
                <label for="artist-name">Artist Name:</label>
                <input type="text" id="artist-name" name="artist-name"><br><br>
                <label for="instagram-handle">Instagram Handle:</label>
                <input type="text" id="instagram-handle" name="instagram-handle"><br><br>
            </div>

            <div class="one-half-column display-flex flex-column">
                <label for="title-of-work">Title of Work:</label>
                <input type="text" id="title-of-work" name="title-of-work"><br><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email"><br><br>
            </div>
            
            <div class="display-flex flex-column full-column">
                <label for="url">Url link to image:</label>
                <input type="url" id="image-file" name="image-file" style="width: 88%;"><br><br>

                <input type="submit" value="Submit" style="margin-top: 3%;width: 92%;background-color: #0345ad;color: #fff;">
            </div>

            

        </form>

    </div>

    <?php
    return ob_get_clean();
}
add_shortcode('custom_modal_form', 'custom_modal_form_shortcode');


// Create custom admin page to display submitted data
function custom_modal_form_admin_menu() {
    add_menu_page(
        'Custom Modal Form',
        'Custom Modal Form',
        'manage_options',
        'custom-modal-form',
        'custom_modal_form_admin_page'
    );
}
add_action('admin_menu', 'custom_modal_form_admin_menu');

function custom_modal_form_admin_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'custom_modal_form';

    $results = $wpdb->get_results("SELECT * FROM $table_name");

    echo '<h1>Custom Modal Form</h1>';
    echo '<table>';
    echo '<tr>';
    echo '<th>Artist Name</th>';
    echo '<th>Title of Work</th>';
    echo '<th>Instagram Handle</th>';
    echo '<th>Email</th>';
    echo '<th>Image File</th>';
    echo '</tr>';

    foreach ($results as $result) {
        echo '<tr>';
        echo '<td>' . esc_html($result->artist_name) . '</td>';
        echo '<td>' . esc_html($result->title_of_work) . '</td>';
        echo '<td>' . esc_html($result->instagram_handle) . '</td>';
        echo '<td>' . esc_html($result->email) . '</td>';
        echo '<td>' . esc_html($result->image_file) . '</td>';
        echo '</tr>';
    }

    echo '</table>';
}
