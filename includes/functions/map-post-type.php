<?php

function create_emu_interactive_map_post_type()
{
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

    // Garantir que as regras de reescrita sejam atualizadas
    flush_rewrite_rules();
}
