<?php

if ( get_template() !== 'bricks' ) return;

/**
 * Register custom elements
 */

add_action( 'init', function() {

\Bricks\Elements::register_element( EIM_PLUGIN_DIR . 'includes/builders/Bricks/widgets/interactive-map/widget.php', );

}, 11 );