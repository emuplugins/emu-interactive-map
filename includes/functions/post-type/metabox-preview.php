<?php

function render_metabox_preview($post) {

    $widgets = get_post_meta($post->ID, 'widgets', true);
    
    if(empty($widgets)) {
        $widgets = array();
    }

?>
<style>
    .brazil-map {
        width: 500px!important;
        height: 100%!important;
    }
    #postbox-container-1{
        display: none!important;
    }
    #post-body-content{
        overflow: hidden!important;
    }
</style>
<tr class="emu-tr-wrapper" style="display: flex; width: auto; max-width: 100%;">
    <td class="emu-td-wrapper" style="width: 100%; display: flex; padding: 0px!important;">
        <div class="emu-box-wrapper" data-post-id="<?php echo esc_attr($post->ID); ?>">
            <label class="emu-field-label">
                Adicionar Widget:
            </label>
            <div class="emu-group emu-group-11-columns" style="margin-bottom: 0px!important;">
                <?php 
                require_once EMU_PLUGIN_DIR . 'includes/functions/post-type/fields/widget-fields.php';
                require_once EMU_PLUGIN_DIR . 'includes/functions/post-type/fields/fields-generator.php';
                generate_fields($add_widget_fields);
                ?>
                <p id="widget-status" class="emu-message emu-success-message emu-row-item emu-row-item-2-columns"><?php _e('Widget adicionado!', 'my_domain'); ?></p>
            </div>
        </div>
        <div class="emu-box-wrapper">
            <label for="" class="emu-field-label">
                Widgets cadastrados:
            </label>
            <div id="widgets-list" class="emu-list-wrapper">
                <?php
                if (!is_array($widgets)) {
                    $widgets = array();
                }
                foreach ($widgets as $index => $widget) :
                ?>
                    <?php $remove_widget_fields = get_widgets_index($widget, $index); ?>
                    <div class="emu-group emu-group-11-columns" style="margin-bottom: 0px!important;" data-widget-index="<?php echo esc_attr($index); ?>">
                        <?php generate_fields($remove_widget_fields, $widget, $index); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="emu-box-wrapper">
            <label for="" class="emu-field-label">
                Preview do mapa:
                <div class="brazil-map"><?php echo do_shortcode('[interactive_map post_id="'.$post->ID.'"]'); ?></div>
            </label>
        </div>

    </td>
</tr>


<?php

}

add_action('edit_form_after_title', 'render_metabox_preview');

// ============================== ADICIONAR WIDGET ==============================
function emu_add_widget() {
    // Verifica permissão
    if (!current_user_can('edit_posts')) {
        wp_send_json_error(array('message' => __('Permissão negada.', 'my_domain')));
        return;
    }

    // Verifica se o ID do post e o nome do widget foram enviados
    if (!isset($_POST['post_id']) || empty($_POST['post_id']) || !isset($_POST['widget_name']) || empty($_POST['widget_name'])) {
        wp_send_json_error(array('message' => __('Dados inválidos.', 'my_domain')));
        return;
    }

    $post_id = intval($_POST['post_id']);
    $widget_name = sanitize_text_field($_POST['widget_name']);
    $widget_type = sanitize_text_field($_POST['widget_type']);
    $widget_options = sanitize_text_field($_POST['widget_options']);
    $widget_link = sanitize_text_field($_POST['widget_link']);
    $widget_pos_x = sanitize_text_field($_POST['widget_pos_x']);
    $widget_pos_y = sanitize_text_field($_POST['widget_pos_y']);
    $widget_weight = sanitize_text_field($_POST['widget_weight']);
    $widget_color = sanitize_text_field($_POST['widget_color']);
    $widget_state_code = sanitize_text_field($_POST['widget_state_code']);
    $widget_custom_class = sanitize_text_field($_POST['widget_custom_class']);
    

    // Recupera widgets existentes
    $widgets = get_post_meta($post_id, 'widgets', true);
    if (!is_array($widgets)) {
        $widgets = array();
    }

    // Verifica se o widget já existe
    foreach ($widgets as $widget) {
        if ($widget['0'] === $widget_name) {
            wp_send_json_error(array('message' => __('Este widget já foi adicionado.', 'my_domain')));
            return;
        }
    }

    // Adiciona o novo widget como um array com índices contínuos
    $new_widget = array(
        $widget_name,         // 0 => widget_name
        $widget_type,         // 1 => widget_type
        $widget_options,      // 2 => widget_options
        $widget_link,         // 3 => widget_link
        $widget_pos_x,   // 4 => widget_position_x
        $widget_pos_y,   // 5 => widget_position_y
        $widget_weight,       // 6 => widget_weight
        $widget_color,        // 7 => widget_color
        $widget_state_code,   // 8 => widget_state_code
        $widget_custom_class  // 9 => widget_custom_class
    );

    $widgets[] = $new_widget;  // Adiciona o widget ao array

    // Atualiza o post meta com o array de widgets
    $update_result = update_post_meta($post_id, 'widgets', $widgets);
    
    if (!$update_result) {
        wp_send_json_error(array('message' => __('Erro ao salvar widget.', 'my_domain')));
        return;
    }

    // Retorna o índice do widget adicionado
    $widget_index = count($widgets) - 1;

    wp_send_json_success(array(
        'message' => __('Widget adicionado com sucesso!', 'my_domain'),
        'widget' => $new_widget,
        'widget_index' => $widget_index
    ));
}
add_action('wp_ajax_emu_add_widget', 'emu_add_widget');


// ============================== REMOVER WIDGET ==============================
function emu_remove_widget() {
    // Verifica permissão
    if (!current_user_can('edit_posts')) {
        wp_send_json_error(array('message' => __('Permissão negada.', 'my_domain')));
        return;
    }

    // Verifica se os parâmetros foram enviados
    if (!isset($_POST['post_id']) || empty($_POST['post_id']) || !isset($_POST['widget_index'])) {
        wp_send_json_error(array('message' => __('Dados inválidos.', 'my_domain')));
        return;
    }

    $post_id = intval($_POST['post_id']);
    $widget_index = intval($_POST['widget_index']);
    
    // Recupera widgets existentes
    $widgets = get_post_meta($post_id, 'widgets', true);
    if (!is_array($widgets) || !isset($widgets[$widget_index])) {
        wp_send_json_error(array('message' => __('Widget não encontrado.', 'my_domain')));
        return;
    }

    // Remove o widget específico com o índice fornecido
    array_splice($widgets, $widget_index, 1);

    // Reindexa o array para garantir que os índices sejam contínuos (caso seja necessário)
    $widgets = array_values($widgets);

    // Atualiza o post meta com o array atualizado
    $update_result = update_post_meta($post_id, 'widgets', $widgets);

    if (!$update_result) {
        wp_send_json_error(array('message' => __('Erro ao remover widget.', 'my_domain')));
        return;
    }

    wp_send_json_success(array(
        'message' => __('Widget removido com sucesso!', 'my_domain'),
        'widgets' => $widgets
    ));
}
add_action('wp_ajax_emu_remove_widget', 'emu_remove_widget');


function save_widget_metabox_data($post_id) {
    // Verifique se o post é válido e não está sendo salvo automaticamente
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;

    // Verifique se o usuário tem permissão para salvar os dados
    if (!current_user_can('edit_post', $post_id)) return $post_id;

    // Salve os dados do metabox (substitua os nomes dos campos conforme necessário)
    if (isset($_POST['widgets'][$post_id]['content'])) {
        update_post_meta($post_id, 'widgets', sanitize_text_field($_POST['widgets'][$post_id]['content']));
    }
    // Repita o processo para os outros campos conforme necessário

    return $post_id;
}


add_action('save_post', 'save_widget_metabox_data');

function emu_update_widget() {
    // Verifica permissão
    if (!current_user_can('edit_posts')) {
        wp_send_json_error(array('message' => __('Permissão negada.', 'my_domain'))); // Permissão negada
        return;
    }

    // Verifica se os parâmetros foram enviados
    if (!isset($_POST['post_id']) || empty($_POST['post_id']) || !isset($_POST['widget_index']) || !isset($_POST['field_index']) || !isset($_POST['new_value'])) {
        wp_send_json_error(array('message' => __('Dados inválidos.', 'my_domain'))); // Dados faltando
        return;
    }

    $post_id = intval($_POST['post_id']);
    $widget_index = intval($_POST['widget_index']);
    $field_index = intval($_POST['field_index']); // Agora estamos lidando com o índice do campo
    $new_value = sanitize_text_field($_POST['new_value']);
    
    // Recupera widgets existentes
    $widgets = get_post_meta($post_id, 'widgets', true);

    // Verifica se o 'widgets' é um array e se o widget existe
    if (!is_array($widgets)) {
        wp_send_json_error(array('message' => __('Widgets não encontrados no post.', 'my_domain'))); // Erro na obtenção de widgets
        return;
    }

    if (!isset($widgets[$widget_index])) {
        wp_send_json_error(array('message' => __('Widget não encontrado no índice.', 'my_domain'))); // Índice do widget inválido
        return;
    }

    // Atualiza o valor do campo no widget, usando o índice do campo
    $widgets[$widget_index][$field_index] = $new_value;

    // Atualiza o post meta com o array atualizado
    $update_result = update_post_meta($post_id, 'widgets', $widgets);

    if (!$update_result) {
        wp_send_json_error(array('message' => __('Erro ao salvar widget no banco de dados.', 'my_domain'), 'widgets' => $widgets)); // Detalhes do erro
        return;
    }

    wp_send_json_success(array('message' => __('Alteração salva com sucesso!', 'my_domain'), 'widgets' => $widgets)); // Sucesso
}
add_action('wp_ajax_emu_update_widget', 'emu_update_widget');