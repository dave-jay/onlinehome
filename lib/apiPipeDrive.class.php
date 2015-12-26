<?php

include_once 'apiCore.class.php';

class apiPipeDrive extends apiCore {

    public $apiEndpoint = '';
    public $apiURL = 'https://api.pipedrive.com/v1/';
    public $key = '2e803e20dd85ca1026d45878a88934f956ffa6d9';
    public $params = array();

    public function __construct() {
        $this->params['api_token'] = $this->key;
    }

    public function createPerson($data) {
        $this->apiEndpoint = "persons";
        return $this->doCall($this->prepareApiUrl(), $data);
    }

    public function createOrganization($data) {
        $this->apiEndpoint = "organizations";
        return $this->doCall($this->prepareApiUrl(), $data);
    }

    public function createDeal($data) {
        $this->apiEndpoint = "deals";
        return $this->doCall($this->prepareApiUrl(), $data);
    }

    public function getPersonInfo($id) {
        $this->apiEndpoint = "persons/{$id}";
        return $this->doCall($this->prepareApiUrl(), $id);
    }

    public function getAllDealFields() {
        $this->apiEndpoint = "dealFields";
        return $this->doCall($this->prepareApiUrl(), array(), 'GET');
    }

    public function getDealField($id) {
        $this->apiEndpoint = "dealFields/{$id}";
        return $this->doCall($this->prepareApiUrl(), array(), 'GET');
    }

    public function getAllUsers() {
        $this->apiEndpoint = "users";
        return $this->doCall($this->prepareApiUrl(), array(), 'GET');
    }

    public function assignDeal($deal_id, $user_id) {
        $data = array();
        $data['user_id'] = $user_id;
        $this->apiEndpoint = "deals/{$deal_id}";
        return $this->doCall($this->prepareApiUrl(), $data, 'PUT');
    }
    
    public function getDealInfo($deal_id){
        $this->apiEndpoint = "deals/{$deal_id}";
        return $this->doCall($this->prepareApiUrl(), array(), 'GET');
    }

}
