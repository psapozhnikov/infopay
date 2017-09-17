<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 9/7/2017
 * Time: 1:43 PM
 */
$response = '';

require_once 'phone_search_collection.php';
require_once 'person_detail_collection.php';

try {
    if (empty($_POST['phone_number'])) {
        throw new \Exception('Phone number is required.');
    }

    if (empty($_POST['first_name']) && empty($_POST['last_name']) || (!empty($_POST['first_name']) && !empty($_POST['last_name']))) {
        throw new \Exception('First name and last name must both be present when searching on a name.');
    }

    $area_code = substr($_POST['phone_number'], strlen($_POST['phone_number']) == 10 ? 0 : 1, 3);
    $phone_number = substr($_POST['phone_number'], strlen($_POST['phone_number']) == 10 ? 3 : 4, strlen($_POST['phone_number']) - 3);
    $params = [
        'areacode' => $area_code,
        'phone'    => $phone_number
    ];

    $search_criteria = [
        0 => ['text' => 'area code', 'value' => $params['areacode']],
        1 => ['text' => 'phone number', 'value' => $params['phone']]
    ];

    $collection = new phone_search_collection();
    $collection->load($params);

    $people_detail_collection = null;
    if (!empty($_POST['first_name']) && !empty($_POST['last_name'])) {
        $params = [
            'firstname' => $_POST['first_name'],
            'lastname'  => $_POST['last_name']
        ];
        $search_criteria[2] = ['text' => 'first name', 'value' => $params['firstname']];
        $search_criteria[3] = ['text' => 'last name', 'value' => $params['lastname']];
        $people_detail_collection = new person_detail_collection();
        $people_detail_collection->load($params);
    }

    $response_array = [
        'is_load'               => false,
        'search_criteria'       => $search_criteria,
        'records'               => $collection->to_array(),
        'people_records_loaded' => false,
    ];
    if (!empty($people_detail_collection)) {
        $response_array['people_records_loaded'] = true;
        $response_array['people_records'] = $people_detail_collection->to_array();
    }
    $response = json_encode($response_array);

    http_response_code(200);
} catch (\Exception $ex) {
    http_response_code(400);
    $response = $ex->getMessage();
} finally {
    header('Content-Type: application/json');
    echo $response;
    flush();
}

