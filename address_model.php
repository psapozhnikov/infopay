<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 9/17/2017
 * Time: 3:05 PM
 */

require_once 'base_model.php';

class address_model extends base_model {

    /**
     * @var string
     */
    public $city;

    /**
     * @var string
     */
    public $state;

    /**
     * @var string
     */
    public $zip;

    /**
     * @return array
     */
    public function to_array(): array {
        return [
            'city'  => $this->city,
            'state' => $this->state,
            'zip'   => $this->zip,
        ];
    }
}