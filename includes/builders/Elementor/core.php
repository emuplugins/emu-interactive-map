<?php


// widget do elementor

function register_hello_world_widget( $widgets_manager ) {
	
    require_once('widgets/interactive-map/widget.php' );

	$widgets_manager->register( new \EmuInteractiveMap_Elementor() );

}

add_action( 'elementor/widgets/register', 'register_hello_world_widget' );