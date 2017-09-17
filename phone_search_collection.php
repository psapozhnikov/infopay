<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 9/16/2017
 * Time: 10:15 PM
 */

require_once 'phone_search_model.php';

class phone_search_collection {

    /**
     * @var array
     */
    public $models;

    /**
     * Creates an instance of model
     *
     * @param $data
     * @return phone_search_model
     */
    private function create_model($data) : phone_search_model {
        $model = new phone_search_model();
        $model->populate($data);
        return $model;
    }

    /**
     * Populate this collection
     *
     * @param $data
     * @return $this|bool
     */
    public function populate($data) {
        if (empty($data)) {
            return false;
        }
        foreach ($data as $model_data) {
            $this->models[] = $this->create_model($model_data);
        }
        return $this;
    }

    public function to_array() : array {
        $collection_array = [];
        foreach ($this->models as $model) {
            $collection_array[] = $model->to_array();
        }
        return $collection_array;
    }

    public function load($params) {
        $dao = new phone_search_dao();
        return $this->populate($dao->retrieve_records($params));
    }
}