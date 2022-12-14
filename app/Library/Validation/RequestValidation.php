<?php

namespace App\Library\Validation;

use mysql_xdevapi\Exception;
use Symfony\Component\HttpFoundation\Request;

trait RequestValidation
{
    protected $errorMessages = [];

    protected function prepareRequestDataForValidation(Request $request){
        $keyValue = [];
        try {
            $allRules = static::$rules;
        }catch (Exception|\Error $exception){
            $allRules = [];
        }
        $applyRules = match ($request->getMethod()) {
            'POST', 'PUT', 'post' => [],
            default => array_keys($request->all()),
        };

/*        if(empty($applyRules)){
            foreach ($allRules as $key => $rule){
                if (in_array($key, $applyRules)){
                    if ()
                }
            }
        }*/
    }

    /**
     * @param $str
     * @return bool
     */
    public static function required($str): bool
    {
        if (!is_array($str)) {
            return !((trim($str) == ''));
        } else {
            return (!empty($str));
        }
    }

    /**
     * @param $str
     * @param $val
     * @return bool
     */
    public static function min_length($str, $val): bool
    {
        if (preg_match("/[^0-9]/", $val)) {
            return FALSE;
        }

        return !((mb_strlen($str) < $val));
    }

    /**
     * @param $str
     * @param $val
     * @return bool
     */
    public static function max_length($str, $val): bool
    {
        if (preg_match("/[^0-9]/", $val)) {
            return FALSE;
        }

        return !((mb_strlen($str) > $val));
    }

    public static function minimum_one_uppercase($str)
    {

        return preg_match('@[A-Z]@', $str);
    }

    /**
     * @param $str
     * @return bool
     */
    public static function numeric($str): bool
    {
        return (bool)preg_match('/^[\-+]?[0-9]*\.?[0-9]+$/', $str);
    }

    /**
     * @param $str
     * @return bool
     */
    public static function is_numeric($str): bool
    {
        return !(($str && !is_numeric($str)));
    }

    /**
     * @param $str
     * @return bool
     */
    public static function integer($str): bool
    {
        return (bool)preg_match('/^[\-+]?[0-9]+$/', $str);
    }

    /**
     *  Is a Natural number  (0,1,2,3, etc.)
     * @param $str
     * @return bool
     */
    public static function is_natural($str): bool
    {
        return (bool)preg_match('/^[0-9]+$/', $str);
    }

    /**
     * @param $str
     * @param $min
     * @return bool
     */
    public static function greater_than($str, $min): bool
    {
        if (!is_numeric($str)) {
            return FALSE;
        }

        return $str > $min;
    }

    /**
     * @param $str
     * @param $max
     * @return bool
     */
    public static function less_than($str, $max): bool
    {
        if (!is_numeric($str)) {
            return FALSE;
        }

        return $str < $max;
    }

    /**
     * @param $str
     * @param $regex
     * @return bool
     */
    public static function regex_match($str, $regex): bool
    {
        if (!preg_match($regex, $str)) {
            return FALSE;
        }

        return TRUE;
    }

    /**
     * Valid EMAILS
     *
     * @access    public
     * @param string $str
     * @return    bool
     */
    public static function valid_emails(string $str): bool
    {
        if (!str_contains($str, ',')) {
            return static::valid_email(trim($str));
        }

        foreach (explode(',', $str) as $email) {
            if (trim($email) != '' && static::valid_email(trim($email)) === FALSE) {
                return FALSE;
            }
        }

        return TRUE;
    }

    /**
     * Valid EMAIL
     *
     * @access    public
     * @param string $str
     * @return    bool
     */
    public static function valid_email(string $str): bool
    {
        return (bool)filter_var(trim($str), FILTER_VALIDATE_EMAIL);
    }

    /**
     * @param $str
     * @return bool
     */
    public static function valid_ips($str): bool
    {
        if ($str) {
            if (!str_contains($str, ',')) {
                return static::valid_ip(trim($str));
            }

            foreach (explode(',', $str) as $ip) {
                if (trim($ip) != '' && static::valid_ip(trim($ip)) === FALSE) {
                    return FALSE;
                }
            }
        }

        return TRUE;
    }

    /**
     * Validate IP Address
     * @param $str
     * @return bool
     */
    public static function valid_ip($str): bool
    {
        return (bool)filter_var($str, FILTER_VALIDATE_IP);
    }


}