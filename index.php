 <?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT');
header("Content-Type: application/json; charset=UTF-8");
// get method 
$method = (string) $_SERVER['REQUEST_METHOD'];

// get url 
$request_uri = $_SERVER['REQUEST_URI'];


// dismantling url and push it in array $url
$url = rtrim($request_uri, '/');
$url = filter_var($request_uri, FILTER_SANITIZE_URL);
$url = explode('/', $url);


$tableName = (string) $url[2];

if (!empty($url[3])) {
    $id = (int) $url[3];
    
} else {
    $id = null;
}


if($tableName == 'food'){
    require_once './api/food.php';

}



