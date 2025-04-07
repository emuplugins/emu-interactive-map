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


define('EIM_PLUGIN_FILE', __FILE__);
define('EIM_PLUGIN_URL', plugin_dir_url(__FILE__));
define('EIM_PLUGIN_DIR', plugin_dir_path(__FILE__));

require_once(EIM_PLUGIN_DIR . 'update-handler.php');

require_once(EIM_PLUGIN_DIR . 'includes/builders/Elementor/core.php');
require_once(EIM_PLUGIN_DIR . 'includes/builders/Bricks/core.php');