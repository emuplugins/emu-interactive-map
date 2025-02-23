<?php 

function widget_metabox_callback($post)
{
    // Recupera os widgets já salvos (array de widgets)
    $widgets = get_post_meta($post->ID, '_widget_data', true);
    if (!$widgets || !is_array($widgets)) {
        $widgets = array();
    }
?> <style>
        .widget-item {
            display: flex;
            flex-wrap: wrap;
            /* Não permite quebra de linha */
            gap: 10px;
            align-items: center;
            padding: 10px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
            background: #f9f9f9;
        }

        .widget-item h4 {
            margin: 0;
            white-space: nowrap;
            width: 100%;
        }

        .widget-item p {
            margin: 0;
            flex: 1;
            min-width: 120px;
            display: flex;
            flex-direction: column;
        }

        .widget-item label {
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 2px;
        }

        .widget-item input,
        .widget-item select {
            width: 100%;
            padding: 4px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .remove-widget {
            background: red;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
            white-space: nowrap;
        }

        .remove-widget:hover {
            background: darkred;
        }
    </style>
    <div id="widget-data">
        <div id="widget-list">
            <?php if (! empty($widgets)) : ?>
                <?php foreach ($widgets as $index => $widget) : ?>
                    <div class="widget-item" data-index="<?php echo $index; ?>">
                        <h4>Widget <?php echo $index + 1; ?> <button type="button" class="remove-widget">Remover</button></h4>


                        <p>
                            <label for="widget-<?php echo $index; ?>-content"><strong>Content</strong></label><br>
                            <input type="text" id="widget-<?php echo $index; ?>-content" name="widget[<?php echo $index; ?>][content]" value="<?php echo esc_attr($widget[0]); ?>" style="width:100%;" />
                        </p>

                        <p>
                            <label for="widget-<?php echo $index; ?>-type"><strong>Type</strong></label><br>
                            <select id="widget-<?php echo $index; ?>-type" name="widget[<?php echo $index; ?>][type]" style="width:100%;">
                                <option value="text" <?php selected($widget[1], 'text'); ?>>Text</option>
                                <option value="image" <?php selected($widget[1], 'image'); ?>>Image</option>
                            </select>
                        </p>

                        <p>
                            <label for="widget-<?php echo $index; ?>-fontSize"><strong>Font Size</strong></label><br>
                            <input type="text" id="widget-<?php echo $index; ?>-fontSize" name="widget[<?php echo $index; ?>][fontSize]" value="<?php echo isset($widget[2]['fontSize']) ? esc_attr($widget[2]['fontSize']) : ''; ?>" style="width:100%;" />
                        </p>

                        <p>
                            <label for="widget-<?php echo $index; ?>-width"><strong>Image Width</strong></label><br>
                            <input type="text" id="widget-<?php echo $index; ?>-width" name="widget[<?php echo $index; ?>][width]" value="<?php echo isset($widget[2]['width']) ? esc_attr($widget[2]['width']) : ''; ?>" style="width:100%;" />
                        </p>

                        <p>
                            <label for="widget-<?php echo $index; ?>-height"><strong>Image Height</strong></label><br>
                            <input type="text" id="widget-<?php echo $index; ?>-height" name="widget[<?php echo $index; ?>][height]" value="<?php echo isset($widget[2]['height']) ? esc_attr($widget[2]['height']) : ''; ?>" style="width:100%;" />
                        </p>

                        <p>
                            <label for="widget-<?php echo $index; ?>-link"><strong>Link</strong></label><br>
                            <input type="text" id="widget-<?php echo $index; ?>-link" name="widget[<?php echo $index; ?>][link]" value="<?php echo esc_attr($widget[3]); ?>" style="width:100%;" />
                        </p>

                        <p>
                            <label for="widget-<?php echo $index; ?>-x"><strong>X</strong></label><br>
                            <input type="number" id="widget-<?php echo $index; ?>-x" name="widget[<?php echo $index; ?>][x]" value="<?php echo esc_attr($widget[4]); ?>" style="width:100%;" />
                        </p>

                        <p>
                            <label for="widget-<?php echo $index; ?>-y"><strong>Y</strong></label><br>
                            <input type="number" id="widget-<?php echo $index; ?>-y" name="widget[<?php echo $index; ?>][y]" value="<?php echo esc_attr($widget[5]); ?>" style="width:100%;" />
                        </p>

                        <p>
                            <label for="widget-<?php echo $index; ?>-weight"><strong>Weight</strong></label><br>
                            <input type="number" id="widget-<?php echo $index; ?>-weight" name="widget[<?php echo $index; ?>][weight]" value="<?php echo esc_attr($widget[6]); ?>" style="width:100%;" />
                        </p>

                        <p>
                            <label for="widget-<?php echo $index; ?>-color"><strong>Color</strong></label><br>
                            <input type="text" id="widget-<?php echo $index; ?>-color" name="widget[<?php echo $index; ?>][color]" value="<?php echo esc_attr($widget[7]); ?>" style="width:100%;" />
                        </p>

                        <p>
                            <label for="widget-<?php echo $index; ?>-state_code"><strong>State Code</strong></label><br>
                            <input type="text" id="widget-<?php echo $index; ?>-state_code" name="widget[<?php echo $index; ?>][state_code]" value="<?php echo esc_attr($widget[8]); ?>" style="width:100%;" />
                        </p>

                        <p>
                            <label for="widget-<?php echo $index; ?>-customClass"><strong>Custom Class</strong></label><br>
                            <input type="text" id="widget-<?php echo $index; ?>-customClass" name="widget[<?php echo $index; ?>][customClass]" value="<?php echo esc_attr($widget[9]); ?>" style="width:100%;" />
                        </p>

                        </li>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Nenhum widget adicionado.</p>
            <?php endif; ?>
        </div>
        <button type="button" id="add-widget">Adicionar Widget</button>
    </div>
<?php
}
