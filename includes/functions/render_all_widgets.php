<?php

function renderAllWidgets() {
    global $states;
    return array_reduce(array_keys($states), function ($output, $code) use ($states) {
        return $output . $states[$code]->renderWidgets();
    }, '');
}