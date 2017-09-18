<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 9/16/2017
 * Time: 10:15 PM
 */

require_once 'phone_search_model.php';
require_once 'base_collection.php';
require_once 'base_model.php';
require_once 'phone_search_dao.php';

class phone_search_collection extends base_collection {

    /**
     * Creates an instance of model
     *
     * @param $data
     * @return base_model
     */
    public function create_model($data) : base_model {
        $model = new phone_search_model();
        $model->populate($data);
        return $model;
    }

    public function load($params) : phone_search_collection {
        $dao = new phone_search_dao();
        return $this->populate($dao->retrieve_phone_search_records($params));
    }
}