<?php

/**
 * Created by PhpStorm.
 * User: gaoqing
 * Date: 2017/12/12
 * Time: 10:01
 */

namespace gao922699\PatternHelper;

class RichTxtPattern
{
    /**
     * 获取富文本中的纯文字
     * @param $content string 副文本
     * @param $limit int|null 返回字数，默认无限制
     * @return mixed
     */
    public static function getText($content, $limit = null)
    {
        $pattern = "/<.*?>/i";
        $text = preg_replace($pattern, '', $content);
        if ($limit) {
            if (mb_strlen($text, 'utf-8') > $limit) {
                return mb_substr($text, 0, $limit, 'utf-8') . '...';
            }
        }
        return $text;
    }

    /**
     * 获取富文本中img标签内的图片地址
     * @param $content string 副文本
     * @param $limit int|null 返回个数，默认返回全部
     * @return array
     */
    public static function getImages($content, $limit = null)
    {
        $pattern = "/<img.*?src=\"(.+?)\".*?>/i";
        preg_match_all($pattern, $content, $matches);
        if ($limit) {
            $images = array_slice($matches[1], 0, $limit);
        } else {
            $images = $matches[1];
        }
        $result = [];
        foreach ($images as $image) {
            if (!preg_match('/(_thumb.gif)$/', $image)) {
                $result[] = $image;
            }
        }
        return $result;

    }
}