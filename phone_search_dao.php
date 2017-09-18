<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 9/14/2017
 * Time: 2:35 PM
 */

require_once 'phone_search_model.php';
require_once 'base_dao.php';

class phone_search_dao extends base_dao {

    /**
     * Retrieve phone search records
     *
     * @param $params
     * @return array
     */
    public function retrieve_phone_search_records($params) : array {
        $xml = $this->retrieve_xml($params);

        $number_of_rows = (string)$xml->{'stats'}->{'rows'};

        if ($number_of_rows == 0) {
            return [];
        }

        $result = [];
        $row_number = 0;
        /**
         * @var SimpleXMLElement $record
         * @var SimpleXMLElement $child
         */
        foreach ($xml->{'record'} as $record) {
            $temp_record = [];
            $row_number++;
            foreach ($record->children() as $child) {
                $name = $child->getName();
                $temp_record[phone_search_model::$xml_to_model_map[$name] ?? $name] = (string)$record->{$name};
            }
            $temp_record['record_id'] = $row_number;
            $result[] = $temp_record;
        }

        return $result;
    }

    /**
     * Retrieve people details records
     *
     * @param $params
     * @return array
     */
    public function retrieve_people_details_records($params) : array {
        $xml = $this->retrieve_xml($params);

        $number_of_rows = (string)$xml->{'total_rows'};

        if ($number_of_rows == 0) {
            return [];
        }

        $result = [];
        $row_number = 0;
        $recordset = $xml->{'recordset'};
        /**
         * @var SimpleXMLElement $record
         * @var SimpleXMLElement $child
         * @var SimpleXMLElement $relatives
         * @var SimpleXMLElement $relative_child
         * @var SimpleXMLElement $previous_addresses
         * @var SimpleXMLElement $address_child
         */
        foreach ($recordset->{'record'} as $record) {
            $temp_record = [];
            $row_number++;
            foreach ($record->children() as $child) {
                if ($child->children()->count() == 0) {
                    $name = $child->getName();
                    $temp_record[phone_search_model::$xml_to_model_map[$name] ?? $name] = (string)$record->{$name};
                }
            }
            $relatives = $record->{'relatives'};
            $relatives_array = [];
            foreach ($relatives->{'relative'} as $relative) {
                $relative_entry = [];
                foreach ($relative->children() as $relative_child) {
                    $name = $relative_child->getName();
                    $relative_entry[$name] = (string)$relative->{$name};
                }
                $relatives_array[] = $relative_entry;
            }
            $temp_record['relatives'] = $relatives_array;

            $addresses_array = [];
            $previous_addresses = $record->{'previous_addresses'};
            foreach ($previous_addresses->{'previous_address'} as $previous_address) {
                $address_entry = [];
                foreach ($previous_address->children() as $address_child) {
                    $name = $address_child->getName();
                    $address_entry[$name] = (string)$address_child->{$name};
                }
                $addresses_array[] = $address_entry;
            }
            $temp_record['previous_addresses'] = $addresses_array;
            $temp_record['record_id'] = $row_number;
            $result[] = $temp_record;
        }
        return $result;
    }
}