<?php

// unused

// CLASSES
require_once 'classess/state.php';
require_once 'classess/widget.php';
require_once 'etc/default_states.php';
require_once 'etc/state_codes.php';

// FUNCTIONS
require_once 'functions/state-proccess.php';
require_once 'functions/widget-proccess.php';
require_once 'functions/render-widgets.php';

// START
stateProccess();
widgetProccess($widgets);
renderAllWidgets();