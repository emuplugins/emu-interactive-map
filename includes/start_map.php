<?php

// unused

// CLASSES
require_once 'classess/state.php';
require_once 'classess/widget.php';
require_once 'etc/default-states.php';
require_once 'etc/state-codes.php';

// FUNCTIONS
require_once 'functions/state-proccess.php';
require_once 'functions/widget-proccess.php';
require_once 'functions/render-all-widgets.php';

// START
state_proccess();
widget_proccess($widgets);
render_all_widgets();