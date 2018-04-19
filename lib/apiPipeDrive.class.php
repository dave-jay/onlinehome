<?php

include_once 'apiCore.class.php';

class apiPipeDrive extends apiCore {

    public $apiEndpoint = '';
    public $apiURL = 'https://api.pipedrive.com/v1/';
    public $key = '2e803e20dd85ca1026d45878a88934f956ffa6d9';
    public $params = array();

    public function __construct($key='') {
        $this->params['api_token'] = !empty($key)?$key:$this->key;
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
    public function createNote($data) {
        $this->apiEndpoint = "notes";
        return $this->doCall($this->prepareApiUrl(), $data, "POST");
    }
    public function modifyDeal($deal_id, $dealFields=array()){
        $this->apiEndpoint = "deals/".$deal_id;
        return $this->doCall($this->prepareApiUrl(), $dealFields, 'PUT');
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
    public function getActivityInfo($act_id){
        $this->apiEndpoint = "activities/{$act_id}";
        return $this->doCall($this->prepareApiUrl(), array(), 'GET');
    }
    public function getOrganizationInfo($org_id){
        $this->apiEndpoint = "organizations/{$org_id}";
        return $this->doCall($this->prepareApiUrl(), array(), 'GET');
    }    
    
    public function getAgentByDealSource($source_id,$tenant_id){
        if(empty($source_id)){
            $phones = q("select * from pd_users where phone!='' AND tenant_id='{$tenant_id}'");
            $phones_data = array();
            foreach($phones as $each_phone){
                $phones_data[] = $each_phone['phone'];
            }
            $phones_data = array_filter($phones_data);
            return ($phones_data);
        }
        $data = qs("select * from call_list_by_source where pd_source_id = '{$source_id}' AND tenant_id='{$tenant_id}' ");
        $agents = $data['pd_user_id'];
        
        if($agents){
            $agents = json_decode($agents,true);
            $agents_condition = "'".implode("','",$agents) . "'";
            $phones = q("select * from pd_users where pd_id in ({$agents_condition}) AND tenant_id='{$tenant_id}' ");
            $phones_data = array();
            foreach($phones as $each_phone){
                $phones_data[] = $each_phone['phone'];
            }
            $phones_data = array_filter($phones_data);
            return ($phones_data);
        }
        return array();
        
    }
    
    public function createActivity($activityFields=array()){
        $this->apiEndpoint = "activities";
        return $this->doCall($this->prepareApiUrl(), $activityFields, 'POST');
    }
    public function modifyActivity($activity_id, $activityFields=array()){
        $this->apiEndpoint = "activities/".$activity_id;
        return $this->doCall($this->prepareApiUrl(), $activityFields, 'PUT');
    }
    
    public function getAllActivityType(){
        $this->apiEndpoint = "activityTypes";
        return $this->doCall($this->prepareApiUrl(), array(), 'GET');
    }
    
    public function assignPerson($person_id, $owner_id) {
        $data = array();
        $data['owner_id'] = $owner_id;
        $this->apiEndpoint = "persons/{$person_id}";
        return $this->doCall($this->prepareApiUrl(), $data, 'PUT');
    }
    
    public function assignOrganization($organization_id, $owner_id) {
        $data = array();
        $data['owner_id'] = $owner_id;
        $this->apiEndpoint = "organizations/{$organization_id}";
        return $this->doCall($this->prepareApiUrl(), $data, 'PUT');
    }
    
    public function getFilterDeals($filter_id,$start,$limit = 100) {
        $this->apiEndpoint = "deals";
        $this->params["filter_id"] = $filter_id;
        $this->params["start"] = $start;
        $this->params["limit"] = $limit;
        return $this->doCall($this->prepareApiUrl(), array(), 'GET');
    }
    public function getAllStage($pipeline_id = 1){
        $this->apiEndpoint = "stages";
        $this->params["pipeline_id"] = $pipeline_id;
        return $this->doCall($this->prepareApiUrl(), array(), 'GET');
    }
    
}
