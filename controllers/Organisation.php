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

    protected function postAddid() {
        $org = new Organisation_Model();
        return $org->getOrganisationInfoAdd($this->data['url']['addid']);
    }

    protected function getAllOrganisation($type = false) {
        $orgs = new Organisation_Model();
        $orglist = $orgs->getAllOrganisation($type);
        $finalInfo = array();
        $nearest = array();
        foreach ($orglist as $org):
            $distance = $this->getLocationDistance(3.062230, 101.593691, $org['latitude'], $org['longitude']);
            $finalInfo = $org;
            $finalInfo['distance'] = $distance;
            $nearest[] = array('id' => $distance);
        endforeach;
        asort($finalInfo);
        return $finalInfo;
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
    
    public function getAllImiOrganisationByAlphaSort() {
        $org = new Imigresen_Model();
        $origin = $org->getAllOrganisationByAlphaSort();

        $newList = array();
        foreach ($origin as $o):
            $newList[] = array(
                'id' => $o['id'],
                'name' => $o['name'],
                'alamat' => $o['address_1'],
                'daerah' => $o['town'],
                'negeri' => $o['state'],
                'alpha' => $this->firstString($this->replaceString($o['name']))
            );
        endforeach;
        $alphaSort = $this->array_msort($newList, array('alpha' => SORT_DESC));
        return $alphaSort;
    }

    protected function getImiAllImigresen($lat, $long) {
        $imi = new Imigresen_Model();
        $orglist = $imi->getAllOrganisation(true);
        $finalInfo = array();
        $nearest = array();
        foreach ($orglist as $org):
            $distance = $this->getLocationDistance($lat, $long, $org['latitude'], $org['longitude']);
            $org['distance'] = $distance;
            $finalInfo[$org['id']] = $org;
            $nearest[$org['id']] = $distance;
        endforeach;
        return $this->sortingList($nearest, $finalInfo);
    }

    private function sortingList($orderList, $referList) {
        asort($orderList);
        $sortList = array();
        foreach ($orderList as $key => $list):
            $sortList[] = $referList[$key];
        endforeach;
        return $sortList;
    }

    protected function getImiAllOrganisationWithQue() {
        $imi = new Imigresen_Model();
        return $imi->getAllOrganisationWithQue();
    }

    protected function getImiOrganisationId() {
        $id = array_keys($this->data['url'])[2];
        $imi = new Imigresen_Model();
        return $imi->getOrganisation($this->data['url'][$id]);
    }

    protected function getQuesort() {
        $org = new Organisation_Model();
        return $org->getAllOrganisationByQueSort();
    }
    
    protected function getQuesortImi() {
//        $org = new Organisation_Model();
//        return $org->getAllOrganisationByQueSort();
        return $this->getImiAllOrganisationWithQue();
    }

    protected function getDistance() {
        $lat = $this->data['url']['lat'];
        $long = $this->data['url']['long'];
        return $this->getImiAllImigresen($lat, $long);
    }

    protected function getImiAlphabet() {
        return $this->getAllImiOrganisationByAlphaSort();
    }
    
    protected function getImiInfo(){
        $imi = new Imigresen_Model();
        return $imi->getOrganisation($this->data['url']['imi-info']);
    }

}
