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

include_once 'includes/start_map.php';
include_once 'includes/shortcodes/map_render.php';
require_once 'update-handler.php';

 // Função para registrar o Custom Post Type
function create_emu_interactive_map_post_type() {
    $args = array(
        'labels' => array(
            'name'               => 'Emu Interactive Maps',
            'singular_name'      => 'Emu Interactive Map',
            'add_new'            => 'Adicionar Novo',
            'add_new_item'       => 'Adicionar Novo Mapa Interativo',
            'edit_item'          => 'Editar Mapa Interativo',
            'new_item'           => 'Novo Mapa Interativo',
            'view_item'          => 'Visualizar Mapa Interativo',
            'search_items'       => 'Buscar Mapas Interativos',
            'not_found'          => 'Nenhum mapa encontrado',
            'not_found_in_trash' => 'Nenhum mapa encontrado na lixeira',
            'all_items'          => 'Todos os Mapas Interativos',
            'menu_name'          => 'Mapas Interativos',
        ),
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 5,
        'supports'           => array('title', 'editor', 'custom-fields'),
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'emu-interactive-map'),
    );

    register_post_type('emu_interactive_map', $args);
}

add_action('init', 'create_emu_interactive_map_post_type'); 
