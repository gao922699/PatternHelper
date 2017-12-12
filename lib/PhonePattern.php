<?php
/**
 * Created by PhpStorm.
 * User: gaoqing
 * Date: 2017/12/12
 * Time: 13:16
 */

namespace gao922699\PatternHelper;

class PhonePattern
{
    /**
     * 验证手机号格式合法性
     * @param $phone
     * @return bool
     */
    public static function validateLegality($phone)
    {
        return self::checkFormat($phone);
    }

    /**
     * 隐藏部分字符
     * @param int $phone 手机号
     * @param int $start 从第几位开始，0为第一位
     * @param int $length 隐藏几位
     * @return string
     * @throws \Exception
     */
    public static function hidePart($phone, $start = 3, $length = 5)
    {
        if (!self::checkFormat($phone)) {
            throw new \Exception("错误的手机号格式");
        }
        if ($start < 0 || $start > 11 || $length > (11 - $start)) {
            throw new \Exception("start或length参数有误");
        }
        $replaceStr = str_pad('', $length, '*');
        return substr_replace($phone, $replaceStr, $start, $length);
    }

    /**
     * 私有方法：检查手机号格式
     * @param $phone
     * @return bool
     */
    private static function checkFormat($phone)
    {
        $pattern = "/^1[345789][0-9]{9}$/";
        if (preg_match($pattern, $phone)) {
            return true;
        }
        return false;
    }
}