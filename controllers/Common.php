<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Common
 *
 * @author irwanibrahim
 */
include_once 'libraries/PasswordHash.php';
define('DEFAULT_WORK_FACTOR', 8);

class Common_Controller {

    function generateRandomString($length = 6) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function sequenceNo($seqno) {
        $len = strlen($seqno);
        $generate = '';
        for ($i = $len; $i <= 4; $i++):
            $generate .='0';
        endfor;
        return $generate . $seqno;
    }

    function cmp($passwd, $hash, $work_factor = 0) {
        if ($work_factor < 4 || $work_factor > 31)
            $work_factor = DEFAULT_WORK_FACTOR;
        $hasher = new PasswordHash($work_factor, FALSE);
        return ($hasher && $hasher->CheckPassword($passwd, $hash));
    }

    function hash($passwd, $work_factor = 0) {
        if ($work_factor < 4 || $work_factor > 31)
            $work_factor = DEFAULT_WORK_FACTOR;
        $hasher = new PasswordHash($work_factor, FALSE);
        return ($hasher && ($hash = $hasher->HashPassword($passwd))) ? $hash : null;
    }

    static function db_input($var, $quote = true) {
        if (is_array($var))
            return array_map('db_input', $var, array_fill(0, count($var), $quote));
        elseif ($var && preg_match("/^(?:\d+\.\d+|[1-9]\d*)$/S", $var))
            return $var;
        return db_real_escape($var, $quote);
    }

    function form_array($arrays) {
        $val = array();
        foreach ($arrays as $v):
            $val[$v['name']] = $v['value'];
        endforeach;
        return $val;
    }

}
