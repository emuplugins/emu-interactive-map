<?php

if (!isset($stateCodes)) {
    $stateCodes = [];
};

function widget_proccess() {
    global $states, $widgets, $stateCodes;
    
    if (!isset($states)) {
        $states = [];
    }
    
    foreach ($widgets as $widget) {
        $stateCode = $widget[8]; // código do estado
        
        if (isset($states[$stateCode])) {
            $newWidget = new Widget(
                $widget[0],  // content
                $widget[1],  // type
                $widget[2],  // options
                $widget[3],  // link
                $widget[4],  // x
                $widget[5],  // y
                $widget[6],  // weight
                $widget[7],  // color
                $widget[9]   // classe personalizada
            );
            $states[$stateCode]->add_widget($newWidget);
        }
    }
}