<?php
// Manually define the environment constant for PHPUnit
define('ENVIRONMENT', 'testing'); // Set the appropriate environment (development, testing, production)

// Define paths for the application and system
define('BASEPATH', __DIR__ . '/../../system');  // Points to the system folder
define('APPPATH', __DIR__ . '/../../application');  // Points to the application folder

// Include the necessary CodeIgniter files
// This is the correct path to CodeIgniter.php file from your tests folder
require_once BASEPATH . '/core/CodeIgniter.php';
echo BASEPATH;

require_once BASEPATH . '/core/Common.php';  // Correct the path to Common.php

// Load any custom configuration if necessary
require_once APPPATH . '/config/config.php';  // Load your application-specific config (optional)
