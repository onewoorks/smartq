<?php

class Customer_Controller {

    public function getCustomerInfo($identification_no){
        $customer = new Customer_Model();
        return $customer->readCustomer($identification_no);
    }

    public function createNewCustomer(array $values){
        $customer = new Customer_Model();
        return $customer->createCustomer($values);
    }
}