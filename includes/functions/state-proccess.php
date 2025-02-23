<?php 

if (!isset($stateCodes)) {
    $stateCodes = [];
};

function state_proccess() {
    global $states, $stateCodes;
    
    $states = [];
    foreach ($stateCodes as $code => $name) {
        $states[$code] = new State($name, $code);
    }
}