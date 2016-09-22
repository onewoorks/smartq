<?php

class Verify_Controller extends Common_Controller {

    public function verifyCode(array $values) {
        $verify = new Queue_Model();
        $val = $this->form_array($values);
        $found = $verify->verifyQueue($val);
        if ($found):
            $result = array(
                'status' => 'success',
                'message' => 'Your Pre-Registration is verified, Please have a seat, you will be entertained shortly.'
            );
        else:
            $result = array(
                'status' => "failed",
                'message' => 'Your verification code is not valid, please check and try again.'
            );
        endif;
        return $result;
    }

}