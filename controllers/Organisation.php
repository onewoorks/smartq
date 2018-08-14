<?php

require_once('Common.php');

class Organisation_Controller extends Common_Controller {

    public static $requestMethod;
    private $response;
    private $data;
    private $array_data;

    public function __construct($data = false) {
        if ($data):
            $callMethod = array_keys($data['url']);
            $request_method = (isset($callMethod[2])) ? $data['method'] . $this->defineClassName($callMethod[2]) : $data['method'] . 'AllOrganisation';
            $this->data = $data;
            $this->array_data = array_keys($data);
            $this->response = $this->$request_method();
        endif;
    }
    

    public function finalResponse() {
        return $this->response;
    }

    protected function postAddid($data) {
        $org = new Organisation_Model();
        return $org->getOrganisationInfoAdd($data['url']['addid']);
    }

    protected function getAllOrganisation($type = false) {
        $orgs = new Organisation_Model();
        return $orgs->getAllOrganisation($type);
    }

    protected function getAllOrganisationWithQue() {
        $orgs = new Organisation_Model();
        return $orgs->getAllOrganisationWithQue();
    }

    protected function getId() {
        $org = new Organisation_Model();
        return $org->getOrganisationInfo($this->data['url']['id']);
    }
    
//    protected function getOrganisationInfo($org_id) {
//        $org = new Organisation_Model();
//        return $org->getOrganisationInfo($org_id);
//    }

    protected function updateQue($org_id) {
        $org = new Organisation_Model();
        return $org->getOrganisationInfoAdd($org_id);
    }

    protected function getAllOrganisationByDistance() {
        $org = new Organisation_Model();
        return $org->getAllOrganisationByDistance();
    }

    protected function getAllOrganisationByQueSort() {
        $org = new Organisation_Model();
        return $org->getAllOrganisationByQueSort();
    }

    public function getAllOrganisationByAlphaSort() {
        $org = new Organisation_Model();
        $origin = $org->getAllOrganisationByAlphaSort();

        $newList = array();
        foreach ($origin as $o):
            $newList[] = array(
                'id' => $o['id'],
                'name' => $o['name'],
                'alamat' => $o['alamat'],
                'daerah' => $o['daerah'],
                'negeri' => $o['negeri'],
                'alpha' => $this->firstString($this->replaceString($o['name']))
            );
        endforeach;
        $alphaSort = $this->array_msort($newList, array('alpha' => SORT_DESC));
        return $alphaSort;
    }
    
    protected function getImiAllImigresen(){
        $imi = new Imigresen_Model();
        return $imi->getAllOrganisation(true);
    }
    
    protected function getImiAllOrganisationWithQue(){
        $imi = new Imigresen_Model();
        return $imi->getAllOrganisationWithQue();
    }
    
    protected function getImiOrganisationId(){
        $id = array_keys($this->data['url'])[2];
        $imi = new Imigresen_Model();
        return $imi->getOrganisation($this->data['url'][$id]);
    }

}
