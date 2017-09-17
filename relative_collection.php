<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 9/17/2017
 * Time: 4:32 PM
 */

require_once 'base_collection.php';
require_once 'relative_model.php';
require_once 'base_model.php';

class relative_collection extends base_collection {
    public function create_model($data): base_model {
        $model = new relative_model();
        $model->populate($data);
        return $model;
    }
}