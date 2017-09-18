<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 9/17/2017
 * Time: 3:14 PM
 */

abstract class base_dao {
    /**
     * @var string
     */
    private $url;
    /**
     * @var string
     */
    private $phone_url;

    /**
     * @var string
     */
    private $people_url;

    /**
     * @var string
     */
    private $user_name;

    /**
     * @var string
     */
    private $password;

    /**
     * base_dao constructor.
     */
    public function __construct() {
        $this->user_name = 'accucomtest';
        $this->password = 'test104';
        $this->phone_url = 'https://www.infopay.com/phptest_phone_xml.php';
        $this->people_url = 'https://www.infopay.com/phptest.php';
    }

    private function construct_url($params) {
        if (in_array('firstname', array_keys($params))) {
            $this->url = $this->people_url;
        } else {
            $this->url = $this->phone_url;
        }
        $this->url .= "?username={$this->user_name}";
        $this->url .= "&password={$this->password}";

        $keys = array_keys($params);
        foreach ($keys as $key) {
            $this->url .= "&{$key}={$params[$key]}";
        }
    }

    /**
     * @param $params
     * @return SimpleXMLElement
     * @throws \Exception
     */
    public function retrieve_xml($params) : SimpleXMLElement {
        $this->construct_url($params);

        $ch = curl_init($this->url);

        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);

        if ($result === false) {
            throw new \Exception(curl_error($ch));
        }

        if (empty($result)) {
            //This should never happen but just in case
            throw new \Exception('Empty results.');
        }

        if (!empty(curl_error($ch))) {
            throw new \Exception(curl_error($ch));
        }

        curl_close($ch);

        return new SimpleXMLElement($result);
    }
}