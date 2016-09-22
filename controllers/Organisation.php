<?php

class Organisation_Controller {

    public static function getAllOrganisation() {
        $orgs = new Organisation_Model();
        return $orgs->getAllOrganisation();
    }

    public static function getAllOrganisationWithQue() {
        $orgs = new Organisation_Model();
        return $orgs->getAllOrganisationWithQue();
    }

    public static function getOrganisationInfo($org_id) {
        $org = new Organisation_Model();
        return $org->getOrganisationInfo($org_id);
    }

}