<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 9/14/2017
 * Time: 2:44 PM
 */

class phone_search_model {

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

    const FIRST_NAME = 'first_name';

    const LAST_NAME = 'last_name';

    const MIDDLE_NAME = 'middle_name';

    const PHONE_NUMBER = 'phone_number';

    const ADDRESS_A = 'address_a';

    const ADDRESS_B = 'address_b';

    const STATE = 'state';

    const AGE = 'age';

    public static $xml_to_model_map = [
        'firstname'  => self::FIRST_NAME,
        'lastname'   => self::LAST_NAME,
        'middlename' => self::MIDDLE_NAME,
        'phone'      => self::PHONE_NUMBER,
        'addressA'   => self::ADDRESS_A,
        'addressB'   => self::ADDRESS_B
    ];

    public function populate($data) {
        $keys = array_keys($data);
        foreach ($keys as $key) {
            if (property_exists($this, $key)) {
                $this->{"{$key}"} = $data[$key];
            }
        }
        return $this;
    }

    /**
     * @return array
     */
    public function to_array() {
        return [
          self::FIRST_NAME  => $this->first_name,
          self::MIDDLE_NAME => $this->middle_name,
          self::LAST_NAME   => $this->last_name,
          self::ADDRESS_A   => $this->address_a,
          self::ADDRESS_B   => $this->address_b,
          self::STATE       => $this->state,
          self::AGE         => $this->age
        ];
    }
}