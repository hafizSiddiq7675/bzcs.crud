<?php

ob_start();
session_start();
/*
 * Assign file paths to PHP constants
 * __FILE__ returns the current path to this file
 * dirname() returns the path to the parent directory
 * MAIN_SITE returns the path to the parent WP site
 * ERROR_LOG_PATH returns the path to the error log
 */
define("PRIVATE_PATH", dirname(__FILE__)); // Refactor when ready
define("PROJECT_PATH", dirname(PRIVATE_PATH)); // Refactor when ready

const PUBLIC_PATH = PROJECT_PATH . '/site';
const SHARED_PATH = PRIVATE_PATH . '/site/private/shared';
/*
 * Assign the root URL to a PHP constant
 * Do not need to include the domain
 * Use same document root as web server
 * Can dynamically find everything in URL up to "/site"
 */
$site_end = strpos($_SERVER['SCRIPT_NAME'], '/site') + 5;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $site_end);
define("WWW_ROOT", $doc_root);
$url      = "http://" . $_SERVER['HTTP_HOST'] . WWW_ROOT;
$validURL = str_replace("&", "&amp", $url);
define("BASE_URL", $validURL);
require_once('database_credentials.php');
