<?php

/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 9/21/15
 * Time: 7:32 PM
 */

namespace app\application\library;

use application\model\DbConnection;
use application\controller\dataController;

class commonFunctions {

    private $dbh;

    public function __construct() {
        $this->dbh = DbConnection::getInstance();
    }

    public function generateRandomPassword() {
        $length = 8;
        $pass = "";

        // possible password chars.
        $chars = array("a", "A", "b", "B", "c", "C", "d", "D", "e", "E", "f", "F", "g", "G", "h", "H", "i", "I", "j", "J",
            "k", "K", "l", "L", "m", "M", "n", "N", "o", "O", "p", "P", "q", "Q", "r", "R", "s", "S", "t", "T",
            "u", "U", "v", "V", "w", "W", "x", "X", "y", "Y", "z", "Z", "1", "2", "3", "4", "5", "6", "7", "8", "9");

        for ($i = 0; $i < $length; $i++) {
            $pass .= $chars[mt_rand(0, count($chars) - 1)];
        }

        return $pass;
    }

    public function formatMoney($number, $fractional = false) {
        if ($fractional) {
            $number = sprintf('%.2f', $number);
        }
        while (true) {
            $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
            if ($replaced != $number) {
                $number = $replaced;
            } else {
                break;
            }
        }
        return $number;
    }

    function prepareUrl($url, $key = "Your secret salt thingie") {
        $url = explode("?", $url, 2);
        if (sizeof($url) <= 1)
            return $url;
        else
            return $url[0] . "?params=" . SELF::encryptStringArray($url[1], $key);
    }

    public function encryptStringArray($stringArray, $key = "1234567890") {
        $s = strtr(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), serialize($stringArray), MCRYPT_MODE_CBC, md5(md5($key)))), '+/=', '-_,');
        return $s;
    }

    public function decryptStringArray($stringArray, $key = "1234567890") {
        $s = unserialize(rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode(strtr($stringArray, '-_,', '+/=')), MCRYPT_MODE_CBC, md5(md5($key))), "\0"));
        return $s;
    }

    public function sanitize($input) {
        $invalid_characters = array("$", "=", "!", "%", "#", "<", ">", "[", "]", "{", "}", "/", "'", ";", ",", "|");
        if (is_array($input)) {
            foreach ($input as $var => $val) {
                $output[$var] = self::sanitize($val);
                /* $method = __FUNCTION__;
                  $output[$var] = $method($val); */
            }
        } else {
            if (get_magic_quotes_gpc()) {
                $input = stripslashes($input);
            }
            $input = $this->cleanInputs($input);

            $output = str_ireplace($invalid_characters, '', $input);
        }
        return $output;
    }

    public function cleanInputs($input) {
        $search = array(
            // Strip out javascript
            '@<script[^>]*?>.*?</script>@si',
            // Strip out HTML tags
            '@<[\/\!]*?[^<>]*?>@si',
            // Strip style tags properly
            '@<style[^>]*?>.*?</style>@siU',
            // Strip multi-line comments
            '@<![\s\S]*?--[ \t\n\r]*>@'
        );

        $output = preg_replace($search, '', $input);
        return $output;
    }

    public function sanitizer($input) {
        if (is_array($input)) {
            foreach ($input as $var => $val) {
                $output[$var] = sanitizer($val);
            }
        } else {
            if (filter_var_array($input)) {
                $input = stripslashes($input);
            }
            $input = $this->cleanInput($input);
            $output = addslashes($input);
        }
        return $output;
    }

    public function GuId() {
        $s = strtoupper(md5(uniqid(rand(), true)));
        $guidText = substr($s, 8, 4);
        return $guidText;
    }

    public static function value_date() {
        $now = time();
        $next_working_date_ts = $now;
        $holidays = array();

        $dt_ctl = new dataController();
        $hols_data = $dt_ctl->getHolidays();
        foreach ($hols_data as $holys) {
            $holidays[] = $holys->HDATE;
        }

        $cut_off_time = $dt_ctl->getCutOff();

        $week_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
        $weekend_days = array('Saturday', 'Sunday');

        if (date('Hi', $now) < $cut_off_time && in_array(date('l'), $week_days)) {
            $next_working_date_ts += 86400;
        } else if (date('Hi', $now) > $cut_off_time && in_array(date('l'), $week_days)) {
            $next_working_date_ts += 172800;
        } else {
            
        }
        while (in_array(strtoupper(date('d-M-y', $next_working_date_ts)), $holidays) || in_array(date('l', $next_working_date_ts), $weekend_days)) {
            $next_working_date_ts += 86400;
            if (!in_array(strtoupper(date('d-M-y', $next_working_date_ts)), $holidays) && !in_array(date('l', $next_working_date_ts), $weekend_days)) {
                //$next_working_date_ts += 86400;
                break;
            }
        }
        return date('d-M-y', $next_working_date_ts);
    }

    function calculateAge($dateOfBirth) {
        $birthday = new DateTime($dateOfBirth);
        $interval = $birthday->diff(new DateTime);
        return $interval->y;
    }
    public function generate_ref_no()
    {
        for ($i = 0; $i <= 9; $i++) {
            $goUpper = (rand(0, 1) == 1);
            $char = rand(0, 9);

            $ref_no .= $char;
        }
        return $ref_no;
    }
}
