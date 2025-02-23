<?php

function render_all_widgets() {
    global $states;
    return array_reduce(array_keys($states), function ($output, $code) use ($states) {
        return $output . $states[$code]->render_widgets();
    }, '');
}