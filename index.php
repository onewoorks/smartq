<?php
header("Access-Control-Allow-Origin: *");

require 'libraries/drivers/mysql.php';
/*
  API Demo
  This script provides a RESTful API interface for a web application
  Input:
  $_GET['format'] = [ json | html | xml ]
  $_GET['method'] = []
 */

// --- Step 1: Initialize variables and functions

/**
 * Deliver HTTP Response
 * @param string $format The desired HTTP response content type: [json, html, xml]
 * @param string $api_response The desired HTTP response data
 * @return void
 * */
function deliver_response($format, $api_response) {

    // Define HTTP responses
    $http_response_code = array(
        200 => 'OK',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not Found'
    );

    // Set HTTP Response
    header('HTTP/1.1 ' . $api_response['status'] . ' ' . $http_response_code[$api_response['status']]);
    // Process different content types
    switch ($format):
        case 'json':
            header('Content-Type: application/json; charset=utf-8');
            if (is_array($api_response)):
                $json_response = json_encode($api_response['data']);
            endif;
            echo $json_response;
            break;
        case 'xml':
            header('Content-Type: application/xml; charset=utf-8');
            $xml_response = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" .
                    '<response>' . "\n" .
                    "\t" . '<code>' . $api_response['code'] . '</code>' . "\n" .
                    "\t" . '<data>' . $api_response['data'] . '</data>' . "\n" .
                    '</response>';
            echo $xml_response;
            break;
        case 'html':
            header('Content-Type: text/html; charset=utf-8');
            echo $api_response['data'];
            break;

    endswitch;
     
    exit;
     
}

// Define whether an HTTPS connection is required
$HTTPS_required = FALSE;

// Define whether user authentication is required
$authentication_required = FALSE;

// Define API response codes and their related HTTP response
$api_response_code = array(
    0 => array('HTTP Response' => 400, 'Message' => 'Unknown Error'),
    1 => array('HTTP Response' => 200, 'Message' => 'Success'),
    2 => array('HTTP Response' => 403, 'Message' => 'HTTPS Required'),
    3 => array('HTTP Response' => 401, 'Message' => 'Authentication Required'),
    4 => array('HTTP Response' => 401, 'Message' => 'Authentication Failed'),
    5 => array('HTTP Response' => 404, 'Message' => 'Invalid Request'),
    6 => array('HTTP Response' => 400, 'Message' => 'Invalid Response Format')
);

// Set default HTTP response of 'ok'
$response['code'] = 0;
$response['status'] = 404;
$response['data'] = NULL;

// --- Step 2: Authorization
// Optionally require connections to be made via HTTPS
if ($HTTPS_required && $_SERVER['HTTPS'] != 'on') {
    $response['code'] = 2;
    $response['status'] = $api_response_code[$response['code']]['HTTP Response'];
    $response['data'] = $api_response_code[$response['code']]['Message'];

    // Return Response to browser. This will exit the script.
    deliver_response($_GET['format'], $response);
}

// Optionally require user authentication
if ($authentication_required) {

    if (empty($_POST['username']) || empty($_POST['password'])) {
        $response['code'] = 3;
        $response['status'] = $api_response_code[$response['code']]['HTTP Response'];
        $response['data'] = $api_response_code[$response['code']]['Message'];

        // Return Response to browser
        deliver_response($_GET['format'], $response);
    }

    // Return an error response if user fails authentication. This is a very simplistic example
    // that should be modified for security in a production environment
    elseif ($_POST['username'] != 'foo' && $_POST['password'] != 'bar') {
        $response['code'] = 4;
        $response['status'] = $api_response_code[$response['code']]['HTTP Response'];
        $response['data'] = $api_response_code[$response['code']]['Message'];

        // Return Response to browser
        deliver_response($_GET['format'], $response);
    }
}

// --- Step 3: Process Request
// Method A: Say Hello to the API

function __autoload($className) {
    list($suffix, $filename) = preg_split('/_/', strrev($className), 2);
    $filename = strrev($filename);
    $suffix = strrev($suffix);
    switch (strtolower($suffix)) {
        case 'model':
            $folder = 'models/';
            break;
        case 'controller':
            $folder = 'controllers/';
            break;
    }
    $file = $folder . $filename . '.php';

    if (file_exists($file)) {
        include_once($file);
    } else {
        die("File '$filename' containing class '$className' not found in '$folder'.");
    }
}

$param_url = 3;
$params = explode('/', $_SERVER['REQUEST_URI']);
//print_r($params);
$class_target = ((count($params) + 1) == 3) ? $params[$param_url] : $_REQUEST['method'];

$class = ucfirst($class_target) . '_Controller';
$model = ucfirst($class_target) . '_Model';
class_exists($class);
//class_exists($model);

if (strcasecmp($_GET['method'], $_GET['method']) == 0) {
    $paging = new Paging_Controller();
    $paging->className = $class_target;
    $response['code'] = 1;
    $response['status'] = $api_response_code[$response['code']]['HTTP Response'];
    $response['data'] = $paging->renderResult();
}

// Method B : Functional process router
$params = explode('/', $_SERVER['REQUEST_URI']);


// --- Step 4: Deliver Response
// Return Response to browser
$get_format =  (!isset($_GET['format'])) ? 'json' : $_GET['format'] ;
deliver_response($get_format, $response);
?>
			