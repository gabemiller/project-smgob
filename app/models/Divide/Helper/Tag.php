<?php

namespace Divide\Helper;

/**
 * Divide\Helper\Tag
 *
 */
class Tag extends \Eloquent
{

    /**
     *
     * @var type
     */
    protected $table = 'tagging_tags';

    /**
     *
     * @param type $name
     * @return type
     */
    public static function getTagByName(array $names)
    {
        return Tag::whereIn('name', $names)->get(['id', 'name', 'slug']);
    }

    /**
     * @return array
     */
    public static function getArray()
    {
        $arr = array();

        foreach (static::all(['id', 'name']) as $item) {
            $arr[$item->id] = $item->name;
        }

        return $arr;
    }

}
