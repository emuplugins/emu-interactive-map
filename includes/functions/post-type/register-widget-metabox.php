<?php

function register_widget_metabox()
{
    add_meta_box(
        'widget_metabox',             // ID do metabox
        'Widgets',                    // Título do metabox
        'render_metabox',            // Alterado para corresponder ao nome da função existente
        'emu_interactive_map',        // Post type onde o metabox aparecerá
        'normal',                     // Localização no editor
        'high'                        // Prioridade do metabox
    );
}