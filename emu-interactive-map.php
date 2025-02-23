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
        'supports'           => array('title'),
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'emu-interactive-map'),
    );

    register_post_type('emu_interactive_map', $args);
}

add_action('init', 'create_emu_interactive_map_post_type'); 


function register_widget_metabox() {
    add_meta_box(
        'widget_metabox', // ID do metabox
        'Widgets', // Título do metabox
        'widget_metabox_callback', // Função callback
        'emu-interactive-map', // Tipo de post onde o metabox aparecerá
        'normal', // Localização no editor (normal, side, etc.)
        'high' // Prioridade do metabox
    );
}
add_action('add_meta_boxes', 'register_widget_metabox');

function widget_metabox_callback($post) {
    // Obter o valor atual do post meta
    $widgets = get_post_meta($post->ID, '_widget_data', true);
    
    // Se não houver valor, inicializa como um array vazio
    if (!$widgets) {
        $widgets = array();
    }
    
    // Widget template (estruturas)
    $widget_template = array(
        'content' => '',
        'type' => 'text',
        'options' => array('fontSize' => '5.5'),
        'link' => '',
        'x' => 0,
        'y' => 0,
        'weight' => 600,
        'color' => 'var(--widget-text-color)',
        'customClass' => 'default'
    );

    ?>
    <div id="widget-data">
        <ul>
            <?php
            // Exibir widgets existentes
            foreach ($widgets as $index => $widget) {
                ?>
                <li>
                    <h4>Widget <?php echo $index + 1; ?></h4>
                    <label for="widget-content-<?php echo $index; ?>">Content:</label>
                    <input type="text" name="widget[<?php echo $index; ?>][content]" value="<?php echo esc_attr($widget['content']); ?>" />
                    
                    <label for="widget-type-<?php echo $index; ?>">Type:</label>
                    <input type="text" name="widget[<?php echo $index; ?>][type]" value="<?php echo esc_attr($widget['type']); ?>" />

                    <label for="widget-fontSize-<?php echo $index; ?>">Font Size:</label>
                    <input type="text" name="widget[<?php echo $index; ?>][options][fontSize]" value="<?php echo esc_attr($widget['options']['fontSize']); ?>" />

                    <label for="widget-color-<?php echo $index; ?>">Color:</label>
                    <input type="text" name="widget[<?php echo $index; ?>][color]" value="<?php echo esc_attr($widget['color']); ?>" />

                    <label for="widget-customClass-<?php echo $index; ?>">Custom Class:</label>
                    <input type="text" name="widget[<?php echo $index; ?>][customClass]" value="<?php echo esc_attr($widget['customClass']); ?>" />

                    <button type="button" onclick="removeWidget(<?php echo $index; ?>)">Remove Widget</button>
                </li>
                <?php
            }
            ?>
        </ul>
        <button type="button" onclick="addWidget()">Add Widget</button>
    </div>

    <script type="text/javascript">
        function addWidget() {
            let widgetIndex = document.querySelectorAll("#widget-data ul li").length;
            let newWidgetHTML = `
                <li>
                    <h4>Widget ${widgetIndex + 1}</h4>
                    <label for="widget-content-${widgetIndex}">Content:</label>
                    <input type="text" name="widget[${widgetIndex}][content]" value="" />
                    
                    <label for="widget-type-${widgetIndex}">Type:</label>
                    <input type="text" name="widget[${widgetIndex}][type]" value="text" />

                    <label for="widget-fontSize-${widgetIndex}">Font Size:</label>
                    <input type="text" name="widget[${widgetIndex}][options][fontSize]" value="5.5" />

                    <label for="widget-color-${widgetIndex}">Color:</label>
                    <input type="text" name="widget[${widgetIndex}][color]" value="var(--widget-text-color)" />

                    <label for="widget-customClass-${widgetIndex}">Custom Class:</label>
                    <input type="text" name="widget[${widgetIndex}][customClass]" value="default" />

                    <button type="button" onclick="removeWidget(${widgetIndex})">Remove Widget</button>
                </li>`;
            document.querySelector("#widget-data ul").insertAdjacentHTML('beforeend', newWidgetHTML);
        }

        function removeWidget(index) {
            let widgetsList = document.querySelector("#widget-data ul");
            widgetsList.removeChild(widgetsList.children[index]);
        }
    </script>
    <?php
}

function save_widget_metabox_data($post_id) {
    // Verificar nonce e outras condições antes de salvar
    if (!isset($_POST['widget']) || !is_array($_POST['widget'])) {
        return;
    }

    // Salvar os dados no post_meta
    $widgets_data = $_POST['widget'];
    update_post_meta($post_id, '_widget_data', $widgets_data);
}
add_action('save_post', 'save_widget_metabox_data');
