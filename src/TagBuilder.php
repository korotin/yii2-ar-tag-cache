<?php
/**
 * Yii2 AR Cache.
 *
 * This file contains helper class for tag building.
 *
 * @author  Aleksei Korotin <herr.offizier@gmail.com>
 */

namespace herroffizier\yii2arcache;

use yii\base\InvalidConfigException;

class TagBuilder
{
    public static function buildTags($classes)
    {
        if (!is_array($classes)) {
            $classes = [$classes];
        }

        $tags = [];

        foreach ($classes as $class) {
            if (is_string($class)) {
                $tags[] = $class;
            } elseif (is_object($class)) {
                $tags[] = $class::className();
            } else {
                throw new InvalidConfigException('Cannot build tags from anything other than objects or class names');
            }
        }

        return $tags;
    }
}
