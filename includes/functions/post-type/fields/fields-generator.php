<?php

if (!defined('ABSPATH')) exit;

function generate_fields($fields, $widget = [], $index = null) { 
    
    $widgetIndex = 0;
    foreach ($fields as $field) : 
        // Se $index estiver definido, ajuste o ID e o nome do campo
        if (!is_null($index)) {
            $field['id'] = str_replace('_index_', '_' . $index . '_', $field['id']);
            $field['name'] = str_replace('_index_', '_' . $index . '_', $field['name']);
        }

        

        // Se $widget estiver definido, use os valores do widget
        if (!empty($widget)) {
            $field['value'] = $widget[$widgetIndex] ?? '';
        }
        ?>
        <div class="emu-row-item">
            <label for="<?php echo esc_attr($field['id']); ?>"><?php echo esc_html($field['label']); ?></label>



            <?php if ($field['type'] === 'select') : ?>
                <select id="<?php echo esc_attr($field['id']); ?>" name="<?php echo esc_attr($field['name']); ?>">
                    <?php foreach ($field['options'] as $value => $label) : ?>
                        <option value="<?php echo esc_attr($value); ?>" <?php selected($field['value'], $value); ?>><?php echo esc_html($label); ?></option>
                    <?php endforeach; ?>
                </select>   

            <?php elseif ($field['type'] === 'color') : ?>
                <input type="color" id="<?php echo esc_attr($field['id']); ?>" name="<?php echo esc_attr($field['name']); ?>" value="<?php echo esc_attr($field['value']); ?>" />

            <?php elseif ($field['type'] === 'number') : ?>
                <input type="number" id="<?php echo esc_attr($field['id']); ?>" name="<?php echo esc_attr($field['name']); ?>" value="<?php echo esc_attr($field['value']); ?>" />

            <?php elseif ($field['type'] === 'text') : ?>
                
                <input type="text" id="<?php echo esc_attr($field['id']); ?>" name="<?php echo esc_attr($field['name']); ?>" value="<?php echo esc_attr($field['value']); ?>" placeholder="<?php echo esc_attr($field['placeholder']); ?>" />

            <?php elseif ($field['type'] === 'textarea') : ?>
                <textarea id="<?php echo esc_attr($field['id']); ?>" name="<?php echo esc_attr($field['name']); ?>" placeholder="<?php echo esc_attr($field['placeholder']); ?>"><?php echo esc_textarea($field['value']); ?></textarea>

            <?php elseif ($field['type'] === 'button') : ?>
                <button type="button" id="<?php echo esc_attr($field['id']); ?>" class="<?php echo esc_attr($field['class']); ?>" data-widget-index="<?php echo esc_attr($index); ?>"><?php echo esc_html($field['placeholder']); ?></button>

            <?php elseif ($field['type'] === 'image') : ?>
                <input type="file" id="<?php echo esc_attr($field['id']); ?>" name="<?php echo esc_attr($field['name']); ?>" />
            <?php endif; ?>

            <?php $widgetIndex++; ?>
        </div>
    <?php endforeach;
}