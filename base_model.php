<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 9/17/2017
 * Time: 2:21 PM
 */

abstract class base_model {
    abstract function to_array() : array;

    public function populate($data) {
        $keys = array_keys($data);
        foreach ($keys as $key) {
            if (property_exists($this, $key)) {
                $this->{"{$key}"} = $data[$key];
            }
        }
        return $this;
    }
}