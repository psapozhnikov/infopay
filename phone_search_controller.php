<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 9/7/2017
 * Time: 1:43 PM
 */
$response = '';

require_once 'phone_search_dao.php';
require_once 'phone_search_collection.php';

try {
    if (empty($_POST['phone_number'])) {
        throw new \Exception('The phone number is required');
    }

    $area_code = substr($_POST['phone_number'], 0, 3);
    $phone_number = substr($_POST['phone_number'], 3, strlen($_POST['phone_number']) - 3);

    $params = [
      'areacode' => 386,
      'phone'    => 7540455
    ];

    $collection = new phone_search_collection();
    $collection->load($params);
    $response = json_encode($collection->to_array());

    http_response_code(200);
} catch (\Exception $ex) {
    http_response_code(400);
    $response = $ex->getMessage();
} finally {
    header('Content-Type: application/json');
    echo $response;
    flush();
}

