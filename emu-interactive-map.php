<?php

/**
 * Plugin Name: Emu Interactive Map
 * Plugin URI:  https://seusite.com/emu-interactive-map
 * Description: Um plugin para adicionar um mapa interativo em seu site, permitindo a personalização de áreas e interatividade com o usuário.
 * Version:     1.0.0
 * Author:      Seu Nome ou Nome da Empresa
 * Author URI:  https://seusite.com
 * Text Domain: emu-interactive-map
 * Domain Path: /languages
 * License:     GPL-2.0+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Requires PHP: 7.0
 * Requires WP: 5.0
 * Tested up to: 6.0
 * WC tested up to: 5.0
 */

require_once 'includes/shortcodes/map-render.php';
require_once 'update-handler.php';
require_once 'includes/functions/save-widgets.php';
require_once 'includes/functions/post-type/create-map-post-type.php';
require_once 'includes/functions/post-type/register-widget-metabox.php';
require_once 'includes/functions/post-type/render-metabox.php';
require_once 'includes/functions/post-type/render-map-preview.php';

// Função para registrar o Custom Post Type
add_action('init', 'create_map_post_type');

// Registrar o metabox para os widgets
add_action('add_meta_boxes', 'register_widget_metabox');

// SAVE METABOX FUNCTION
add_action('save_post', 'save_widget_metabox_data');

// ENQEUE SCRIPTS
function enqueue_widget_metabox_script()
{
    wp_enqueue_script('widget-metabox-script', plugin_dir_url(__FILE__) . '/assets/js/widget-metabox.js', array(), null, true);
}

add_action('admin_enqueue_scripts', 'enqueue_widget_metabox_script');