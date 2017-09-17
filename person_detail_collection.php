<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 9/17/2017
 * Time: 4:04 PM
 */

require_once 'base_collection.php';
require_once 'person_detail_model.php';
require_once 'base_model.php';

class person_detail_collection extends base_collection {

    public function create_model($data) : base_model {
        $model = new person_detail_model();
        $model->populate($data);
        return $model;
    }

    public function load($params) : person_detail_collection {
        $dao = new phone_search_dao();
        return $this->populate($dao->retrieve_people_details_records($params));
    }
}