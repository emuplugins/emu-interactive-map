<?php

function register_widget_metabox()
{
    // Metabox existente para widgets
    add_meta_box(
        'widget_metabox',
        'Widgets',
        'render_metabox',
        'emu_interactive_map',
        'normal',
        'high'
    );

    // Novo metabox para preview
    add_meta_box(
        'map_preview_metabox',
        'Preview do Mapa',
        'render_map_preview_metabox',
        'emu_interactive_map',
        'side',
        'high'
    );
}