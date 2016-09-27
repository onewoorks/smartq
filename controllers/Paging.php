<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Paging
 *
 * @author irwanibrahim
 */
class Paging_Controller extends Common_Controller {

    public $className;

    function __construct() {
        echo $this->className;
    }

    function renderResult() {
        $apiType = $_SERVER['REQUEST_METHOD'];
        $result = array();
        switch ($this->className):
            case 'queue':
                $class = new Queue_Controller();

                if (isset($_REQUEST['mobile'])):
                    
                    if ($apiType == 'GET'):                    
                        $values = $_REQUEST;                       
                        $result = $class->setQueueNoGet($values);
                    endif;
                else:
                    if ($apiType == 'GET'):
                        $result = $class->getAllActiveQueue();
                    endif;
                    if ($apiType == 'POST'):
                        $values = $_REQUEST['values'];
                        $result = array(
                            'message' => 'Registeration Success, Your Queue Number is',
                            'queue_no' => $this->sequenceNo($class->setQueueNo($values))
                        );
                    endif;
                endif;





                break;
            case 'verify':
                if ($apiType == 'POST'):
                    $class = new Verify_Controller();
                    $values = $_REQUEST['values'];
                    $result = $class->verifyCode($values);
                endif;

                break;
            case 'organisation':
                $class = new Organisation_Controller();
                if (isset($_REQUEST['id'])):
                    $result = Organisation_Controller::getOrganisationInfo($_REQUEST['id']);
                else:
                    $result = $class->getAllOrganisationWithQue();
                endif;

                break;
        endswitch;

        return $result;
    }

}

?>
