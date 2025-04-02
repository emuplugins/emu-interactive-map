<?php

/**
 * Plugin Name: Emu Interactive Map
 * Description: Mapa interativo.
 * Version:     1.0.0
 * Author:      Emu Plugins
 * Text Domain: emu-interactive-map
 * Domain Path: /languages
 * License:     GPL-2.0+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */


define('EMU_PLUGIN_FILE', __FILE__);
define('EMU_PLUGIN_URL', plugin_dir_url(__FILE__));
define('EMU_PLUGIN_DIR', plugin_dir_path(__FILE__));

require_once 'update-handler.php';
require_once('brazilClass.php');

// // criando um novo mapa
// $mapaBrasil = new EmuBrazilMap;

// // definindo os dados de um widget
// $widgetText = [
//     'code' => 'SP',
//     'content' => 'Conteúdo exemplo1',
//     'type' => 'text',
//     'options' => [
//         'fontSize' => '1em',
//         'fontWeight' => '600',
//         'color' => '#000',
//         'link' => '#',
//         'class' => 'teste',
//     ],
//     'position' => [
//         'x' => 0,
//         'y' => 0,
//     ]
//     ];

// // adicionando widget no mapa
// $mapaBrasil->addWidget($widgetText);

// // renderizando mapa
// echo $mapaBrasil->renderMap();