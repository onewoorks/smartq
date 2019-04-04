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
//        echo $this->className;
    }

    function renderResult() {
        $apiType = $_SERVER['REQUEST_METHOD'];
        $result = array();
        switch ($this->className):
            case 'callnumber':
                $class = new Callnumber_Controller();
                include 'vendor/pusher/pusher-php-server/lib/Pusher.php';
                $options = array(
                    'encrypted' => true
                );
                $pusher = new Pusher(
                        '20adee38b69a898a51ca', 'a9725da854d7bc6863db', '258710', $options
                );

                $data['message'] = 'Your number is around the corner, Please be available at designated location. Thank you';
                $pusher->trigger('smartqueue', 'my_event', $data);
                break;
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
            case 'organisationa':
                $class = new Organisation_Controller();

                if (isset($_REQUEST['id'])):
                    $result = Organisation_Controller::getOrganisationInfo($_REQUEST['id']);
                else:
                    $result = $class->getAllOrganisationWithQue();
                endif;

                if (isset($_REQUEST['addid'])):
                    $result = $class->updateQue($_REQUEST['addid']);
                endif;

                if (isset($_REQUEST['distance'])):
                    $result = $class->getAllOrganisationByDistance();
                endif;

                if (isset($_REQUEST['quesort'])):
                    $result = $class->getAllOrganisationByQueSort();
                endif;

                if (isset($_REQUEST['alphabet'])):
                    $result = $class->getAllOrganisationByAlphaSort();
                endif;

                break;
            default:
                $classname = ucfirst($this->className) . '_Controller';
                $headers = $this->getAllHttpHeaders();
                $body = file_get_contents('php://input');
                $data = array(
                    'method' => strtolower($apiType),
                    'url' => $_REQUEST,
                    'headers' => $headers,
                    'body' => $body
                );
                $c = new $classname($data);
                $result = $c->finalResponse();
                break;
        endswitch;

        return $result;
    }

}
