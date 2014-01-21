<?php

// Start some constants
define("ROOT_DIR", realpath(__DIR__ . '/../') . '/');
define("PUBLIC_DIR", ROOT_DIR . 'public/');
define("APP_DIR", realpath(__DIR__ . '/../app') . '/');
define("CONTROLLER_DIR", APP_DIR . 'controller/');
define("SERVICE_DIR", APP_DIR . 'service/');
define("LIB_DIR", APP_DIR . 'lib/');
define("IMAGE_DIR", PUBLIC_DIR . 'img');
define("UPLOAD_DIR", PUBLIC_DIR . 'uploads');

// Used for pagination
define("DEFAULT_LIMITS_PER_PAGE", 20);
