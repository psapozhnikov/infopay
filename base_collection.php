<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 9/17/2017
 * Time: 4:06 PM
 */

require_once 'base_model.php';

abstract class base_collection {

    /**
     * @var array
     */
    protected $models;

    public function to_array() : array {
        $collection_array = [];
        foreach ($this->models as $model) {
            $collection_array[] = $model->to_array();
        }
        return $collection_array;
    }

    /**
     * Populate this collection
     *
     * @param $data
     * @return $this|bool
     */
    public function populate($data) : base_collection {
        if (empty($data)) {
            return false;
        }
        foreach ($data as $model_data) {
            $this->models[] = $this->create_model($model_data);
        }
        return $this;
    }

    abstract function create_model($data) : base_model;
}