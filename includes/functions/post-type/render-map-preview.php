<?php

function render_map_preview_metabox($post) {
    // Verifica se o post já foi salvo
    if (!$post->ID) {
        echo '<p>Salve o post primeiro para ver o preview do mapa.</p>';
        return;
    }

    // Exibe o shortcode para referência
    echo '<style>
    
    .brazil-map {
    --state-stroke-width: 0.5;
    --map-scale: 1.5!important;
    }
    
    
    </style><div style="margin-bottom: 10px;">';
    echo '<p><strong>Shortcode:</strong></p>';
    echo '<code>[interactive_map post_id="' . $post->ID . '"]</code>';
    echo '</div>';

    // Adiciona uma divisória
    echo '<hr style="margin: 15px 0;">';

    // Exibe o preview do mapa
    echo '<div style="margin-top: 10px;">';
    echo '<p><strong>Preview:</strong></p>';
    echo '<div style="max-width: 100%; overflow: auto;">';
    echo do_shortcode('[interactive_map post_id="' . $post->ID . '"]');
    echo '</div>';
    echo '</div>';
}