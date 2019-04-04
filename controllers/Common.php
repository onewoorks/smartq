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
include_once 'libraries/PasswordHashLib.php';
define('DEFAULT_WORK_FACTOR', 8);

class Common_Controller {

    function getAllHttpHeaders() {
        $headers = array();
        foreach ($_SERVER as $key => $value) {
            if (strpos($key, 'HTTP_') === 0) {
                $headers[str_replace(' ', '', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))))] = $value;
            }
        }
        return $headers;
    }

    function defineClassName($method_name) {
        $arrayLine = preg_split("/[_,\-]+/", $method_name);
        $cleanName = "";
        foreach ($arrayLine as $line):
            $cleanName .= ucfirst(strtolower($line));
        endforeach;
        return $cleanName;
    }

    function array_msort($array, $cols) {
        $colarr = array();
        foreach ($cols as $col => $order) {
            $colarr[$col] = array();
            foreach ($array as $k => $row) {
                $colarr[$col]['_' . $k] = strtolower($row[$col]);
            }
        }

        $eval = 'array_multisort(';

        foreach ($cols as $col => $order) {
            $eval .= '$colarr[\'' . $col . '\'],' . $order . ',';
        }

        $eval = substr($eval, 0, -1) . ');';
        eval($eval);
        $ret = array();
        foreach ($colarr as $col => $arr) {
            foreach ($arr as $k => $v) {
                $k = substr($k, 1);
                if (!isset($ret[$k]))
                    $ret[$k] = $array[$k];
                $ret[$k][$col] = $array[$k][$col];
            }
        }
        return $ret;
    }

    function SortByKeyValue($data, $sortKey, $sort_flags = SORT_ASC) {
        if (empty($data) or empty($sortKey)):
            return $data;
        endif;

        $ordered = array();
        foreach ($data as $key => $value):
            $ordered[$value[$sortKey]] = $value;
        endforeach;

        ksort($ordered, $sort_flags);
        return array_values($ordered);
    }

    function replaceString($string) {
        $newstring = str_replace('klinik desa', '', trim(strtolower($string)));
        $newstring = str_replace('klinik kesihatan', '', strtolower($newstring));
        return trim($newstring);
    }

    function firstString($string) {
        return strtoupper($string[0]);
    }

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
            $generate .= '0';
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
    
    function getLocationDistance($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'km', $decimals = 2) {
        // Calculate the distance in degrees
        $degrees = rad2deg(acos((sin(deg2rad($point1_lat))*sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat))*cos(deg2rad($point2_lat))*cos(deg2rad($point1_long-$point2_long)))));

        // Convert the distance in degrees to the chosen unit (kilometres, miles or nautical miles)
        switch($unit) {
            case 'km':
                $distance = $degrees * 111.13384; // 1 degree = 111.13384 km, based on the average diameter of the Earth (12,735 km)
                break;
            case 'mi':
                $distance = $degrees * 69.05482; // 1 degree = 69.05482 miles, based on the average diameter of the Earth (7,913.1 miles)
                break;
            case 'nmi':
                $distance =  $degrees * 59.97662; // 1 degree = 59.97662 nautic miles, based on the average diameter of the Earth (6,876.3 nautical miles)
        }
        return round($distance, $decimals);
    }

}
