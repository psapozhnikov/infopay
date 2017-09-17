<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 9/14/2017
 * Time: 2:44 PM
 */

require_once 'base_model.php';

class phone_search_model extends base_model {

    /**
     * @var int
     */
    public $record_id;

    /**
     * @var string
     */
    public $phone_number;

    /**
     * @var string
     */
    public $first_name;

    /**
     * @var string
     */
    public $last_name;

    /**
     * @var string
     */
    public $middle_name;

    /**
     * @var string
     */
    public $address_a;

    /**
     * @var string
     */
    public $address_b;

    /**
     * @var string
     */
    public $state;

    /**
     * @var int
     */
    public $age;

    /**
     * @var int
     */
    public $info;

    const FIRST_NAME = 'first_name';

    const LAST_NAME = 'last_name';

    const MIDDLE_NAME = 'middle_name';

    const PHONE_NUMBER = 'phone_number';

    const ADDRESS_A = 'address_a';

    const ADDRESS_B = 'address_b';

    const STATE = 'state';

    const AGE = 'age';

    const RECORD_ID = 'record_id';

    const INFO = 'info';

    public static $xml_to_model_map = [
        'firstname'  => self::FIRST_NAME,
        'lastname'   => self::LAST_NAME,
        'middlename' => self::MIDDLE_NAME,
        'phone'      => self::PHONE_NUMBER,
        'addressA'   => self::ADDRESS_A,
        'addressB'   => self::ADDRESS_B
    ];

    /**
     * @return array
     */
    public function to_array() : array {
        return [
          self::RECORD_ID   => $this->record_id,
          self::FIRST_NAME  => $this->first_name,
          self::MIDDLE_NAME => $this->middle_name,
          self::LAST_NAME   => $this->last_name,
          self::ADDRESS_A   => $this->address_a,
          self::ADDRESS_B   => $this->address_b,
          self::STATE       => $this->state,
          self::AGE         => $this->age,
          self::INFO        => $this->info
        ];
    }
}