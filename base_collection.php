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
    public $models;

    public function to_array() : array {
        if (empty($this->models)) {
            return [];
        }
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
    public function populate($data) {
        if (empty($data)) {
            return $this;
        }
        foreach ($data as $model_data) {
            $this->models[] = $this->create_model($model_data);
        }
        return $this;
    }

    abstract function create_model($data) : base_model;
}