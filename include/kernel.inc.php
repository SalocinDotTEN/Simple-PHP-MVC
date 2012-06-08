<?php

/*
  Based on Cassandra Cluster Admin by Sébastien Giroux
 */
require('include/lang/english.php');

require('conf.inc.php');

error_reporting(E_ALL);

session_start();

/*
  Get the specified view and replace the php variables
 */

function getHTML($filename, $php_params = array()) {
    if (!file_exists('views/' . $filename))
        die('The view ' . $filename . ' doesn\'t exist');

    // If we got some params to be treated in php
    extract($php_params);

    ob_start();
    include('views/' . $filename);
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}

/*
  Return a human readable file format from a number of bytes
 */

function formatBytes($bytes) {
    if ($bytes < 1024)
        return $bytes . ' B';
    elseif ($bytes < 1048576)
        return round($bytes / 1024, 2) . ' KB';
    elseif ($bytes < 1073741824)
        return round($bytes / 1048576, 2) . ' MB';
    elseif ($bytes < 1099511627776)
        return round($bytes / 1073741824, 2) . ' GB';
    else
        return round($bytes / 1099511627776, 2) . ' TB';
}

/*
  Redirect the user to the specified URL
 */

function redirect($url) {
    header('Location: ' . $url);
    exit();
}

/*
  Return the text for the index in the current language the user is using
 */

function getLang($index, $params) {
    global $lang;

    $output = $lang[$index];

    foreach ($params as $key => $value) {
        $output = str_replace('%' . $key . '%', $value, $output);
    }

    return $output;
}

/*
  Return a message for a form success
 */

function displaySuccessMessage($index, $params = array()) {
    global $lang;

    return '<div class="alert alert-success">' . getLang('form_success_' . $index, $params) . '</div>';
}

/*
  Return a message for a form info
 */

function displayInfoMessage($index, $params = array()) {
    global $lang;

    return '<div class="alert alert-info">' . getLang('form_info_' . $index, $params) . '</div>';
}

/*
  Return a message for a form error
 */

function displayErrorMessage($index, $params = array()) {
    global $lang;

    $message = nl2br(getLang('form_error_' . $index, $params));

    if ($index == 'something_wrong_happened' && isset($params['message'])) {
        $message .= ' ' . getErrorMessage($params['message']);
    }

    return '<div class="alert alert-error">' . $message . '</div>';
}

$current_page_title = 'My App'; //Set your own app title here! Shows at top of browser.

/*
  Get the currrent page title for the HTML page
 */

function getPageTitle() {
    global $current_page_title;

    return $current_page_title;
}

/*
  Return true if a keyspace is read-only, false otherwise
 */

function isReadOnlyKeyspace($keyspace_name) {
    return in_array($keyspace_name, explode(',', READ_ONLY_KEYSPACES));
}

/*
  Return the number of seconds elapsed between the time start and time end
 */

function getQueryTime($time_start, $time_end) {
    return round($time_end - $time_start, 4) . 'sec';
}

/*
  Return the column family definition in a user-readable format
 */

function displayOneCfDef($key) {
    return ucwords(str_replace('_', ' ', $key));
}

//Do a preg match on the error message then do a case switch on the type of meessages to return or vice versa...
//Anything you want! At default it returns nothing, but try to do something here so it shows a polite error message :)
function getErrorMessage($exception_message) {
    return '';
}

function escapeNameForJs($name) {
    return str_replace('\'', '\\\'', $name);
}

function escapeValueForJs($value) {
    return str_replace(array('\'', "\r\n", "\n"), array('\\\'', '\r\n', '\n'), $value);
}

?>