<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 9/14/2017
 * Time: 2:35 PM
 */

require_once 'phone_search_model.php';

class phone_search_dao {

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $user_name;

    /**
     * @var string
     */
    private $password;

    public function __construct() {
        $this->user_name = 'accucomtest';
        $this->password = 'test104';
        $this->url = 'https://www.infopay.com/phptest_phone_xml.php';
    }

    private function construct_url($params) {
        $this->url .= "?username={$this->user_name}";
        $this->url .= "&password={$this->password}";

        $keys = array_keys($params);
        foreach ($keys as $key) {
            $this->url .= "&{$key}={$params[$key]}";
        }
    }

    public function retrieve_records($params) : array {
        $this->construct_url($params);

        $ch = curl_init($this->url);

        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);

        curl_close($ch);

        if ($result === false) {
            throw new \Exception(curl_error($ch));
        }

        if (empty($result)) {
            //This should never happen but just in case
            throw new \Exception('Empty results.');
        }

        $xml = new SimpleXMLElement($result);
        $number_of_rows = $xml->{'stats'}->{'rows'};

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
}