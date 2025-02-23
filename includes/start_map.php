<?php

// CLASSES
require_once 'classess/state.php';
require_once 'classess/widget.php';
require_once 'etc/default_states.php';
require_once 'etc/state_codes.php';
require_once 'shortcodes/map_render.php';

// FUNCTIONS
require_once 'functions/state_proccess.php';
require_once 'functions/widget_proccess.php';
require_once 'functions/render_all_widgets.php';

// START
stateProccess();
widgetProccess($widgets);
renderAllWidgets();