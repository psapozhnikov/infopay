<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 9/17/2017
 * Time: 2:51 PM
 */

require_once 'base_model.php';

class relative_model extends base_model {
    /**
     * @var string
     */
    public $first_name;

    /**
     * @var string
     */
    public $middle_name;

    /**
     * @var string
     */
    public $last_name;

    /**
     * @var int
     */
    public $age;

    /**
     * Convert this model to array
     *
     * @return array
     */
    public function to_array() : array {
        return [
          'first_name'  => $this->first_name,
          'middle_name' => $this->middle_name,
          'last_name'   => $this->last_name,
          'age'         => $this->age,
        ];
    }
}