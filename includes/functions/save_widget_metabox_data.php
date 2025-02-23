<?php

// Função para salvar os dados do metabox
function save_widget_metabox_data($post_id)
{
    if (!isset($_POST['widget']) || !is_array($_POST['widget'])) {
        return;
    }
    $widgets_data = array();
    // Para cada widget, combinamos os campos de options
    foreach ($_POST['widget'] as $index => $data) {
        $options = array(
            'fontSize' => isset($data['fontSize']) ? sanitize_text_field($data['fontSize']) : '',
            'width'    => isset($data['width']) ? sanitize_text_field($data['width']) : '',
            'height'   => isset($data['height']) ? sanitize_text_field($data['height']) : ''
        );
        $widgets_data[$index] = array(
            sanitize_text_field($data['content']), // [0]
            sanitize_text_field($data['type']),    // [1]
            $options,                              // [2] (array de opções)
            sanitize_text_field($data['link']),    // [3]
            intval($data['x']),                    // [4]
            intval($data['y']),                    // [5]
            intval($data['weight']),                // [6]
            sanitize_text_field($data['color']),    // [7]
            sanitize_text_field($data['state_code']), // [8]
            sanitize_text_field($data['customClass']) // [9]
        );
    }
    update_post_meta($post_id, '_widget_data', $widgets_data);
}