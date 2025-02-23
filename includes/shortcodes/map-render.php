<?php

// CLASSES
require_once dirname(__DIR__) . '/classess/state.php';
require_once dirname(__DIR__) . '/classess/widget.php';
require_once dirname(__DIR__) . '/etc/default-states.php';
require_once dirname(__DIR__) . '/etc/state-codes.php';

// FUNCTIONS
require_once dirname(__DIR__) . '/functions/state-proccess.php';
require_once dirname(__DIR__) . '/functions/widget-proccess.php';
require_once dirname(__DIR__) . '/functions/render-all-widgets.php';

function emu_interactive_map_shortcode($atts)
{

    global $widgets;
    // Extrai o ID do post passado no shortcode, com valor padrão 0 se não for fornecido
    $atts = shortcode_atts(
        array(
            'post_id' => 0,
        ),
        $atts,
        'interactive_map'
    );

    $post_id = $atts['post_id'];

    // Verifica se o ID do post é válido
    if ($post_id == 0) {
        return 'Post ID inválido.';
    }

    // START
    state_proccess();

    // Recupera os widgets armazenados no post meta
    $post_widgets = get_post_meta($post_id, '_widget_data', true);

    // Se não houver widgets no post meta, inicializa um array vazio
    if (!$post_widgets) {
        var_dump($post_widgets);
        $post_widgets = array(); // Inicializa um array vazio se não houver widgets
    }

    // Recupera os widgets já definidos, ou cria um array vazio caso não existam
    $widgets = isset($widgets) && is_array($widgets) ? $widgets : array();

    // Adiciona os widgets do post meta aos widgets existentes, mesclando-os corretamente
    // A ordem de mesclagem importa: widgets existentes vêm primeiro, depois os widgets do post meta
    $widgets = array_merge($widgets, $post_widgets);

    // Passa os widgets para a função widgetProccess
    widget_proccess($widgets);

    render_all_widgets();
    // Chama o template brasil.php
    ob_start(); // Inicia o buffer de saída

    // Corrigir o caminho para o template
    $template_path = plugin_dir_path(__DIR__) . 'templates/brasil.php';

    include $template_path; // Inclui o template

    return ob_get_clean(); // Retorna o conteúdo gerado pelo template
}

add_shortcode('interactive_map', 'emu_interactive_map_shortcode');