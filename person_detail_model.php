<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 9/17/2017
 * Time: 2:57 PM
 */
require_once 'base_model.php';
require_once 'address_collection.php';
require_once 'relative_collection.php';
require_once 'phone_search_model.php';

class person_detail_model extends phone_search_model {

    /**
     * @var string
     */
    public $address;

    /**
     * @var string
     */
    public $city;

    /**
     * @var string
     */
    public $zip;

    /**
     * @var relative_collection
     */
    public $relatives;

    /**
     * @var bool
     */
    public $is_home_owner;

    /**
     * @var address_collection
     */
    public $previous_addresses;

    /**
     * @var string
     */
    public $date_of_birth;

    const DATE_OF_BIRTH = 'date_of_birth';

    public static $xml_to_model_map = [
        'firstname'  => self::FIRST_NAME,
        'lastname'   => self::LAST_NAME,
        'middlename' => self::MIDDLE_NAME,
        'phone'      => self::PHONE_NUMBER,
        'dob'        => self::DATE_OF_BIRTH,
    ];

    public function populate($data) : base_model {
        parent::populate($data);

        $address_collection = new address_collection();
        $address_collection->populate($data['previous_addresses']);
        $this->previous_addresses = $address_collection;

        $relative_collection = new relative_collection();
        $relative_collection->populate($data['relatives']);
        $this->relatives = $relative_collection;

        return $this;
    }

    /**
     * @return array
     */
    public function to_array(): array {
        return [
            self::RECORD_ID      => $this->record_id,
            self::FIRST_NAME     => $this->first_name,
            self::LAST_NAME      => $this->last_name,
            self::MIDDLE_NAME    => $this->middle_name,
            self::DATE_OF_BIRTH  => $this->date_of_birth,
            self::AGE            => $this->age,
            'address'            => $this->address,
            'city'               => $this->city,
            'state'              => $this->state,
            'zip'                => $this->zip,
            self::PHONE_NUMBER   => $this->phone_number,
            'relatives'          => $this->relatives->to_array(),
            'previous_addresses' => $this->previous_addresses->to_array(),
        ];
    }
}