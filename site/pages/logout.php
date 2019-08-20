<?php
require_once '../private/initialize.php';
$root_url = BASE_URL;
$root_url = str_replace('site','',$root_url);
session_destroy();
header('Location: '.$root_url);