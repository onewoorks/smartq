<?php

class Queue_Controller extends Common_Controller {

    public function getAllActiveQueue() {
        $que = new Queue_Model();
        return $que->readAllActiveQueue();
    }

    public function setQueueNo(array $values){
        $val = $this->form_array($values);
        //check existed customer if any
        $customer = new Customer_Controller();
        $customer_info = $customer->getCustomerInfo($val['identification_no']);
        if($customer_info):
            $customer_id = $customer_info['id'];
        else:
            $customer_id = $customer->createNewCustomer($val);
        endif;
        $val['customer_id'] = $customer_id;
        $val['code_authorize'] = $this->generateRandomString();
        $que = new Queue_Model();
        $result = $que->createQueue($val);
        return array('queue_no'=>$this->sequenceNo($result));
    }



}