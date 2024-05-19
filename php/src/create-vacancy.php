<?php
include_once dirname(__FILE__) . '/app/main.php';

$employerGuard->canActivate();

include_once dirname(__FILE__) . '/app/pages/layouts/with-header/layout.php';