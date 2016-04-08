<?php
/**
 * Yii2 AR Cache.
 *
 * This file contains AR cache behavior class.
 *
 * @author  Aleksei Korotin <herr.offizier@gmail.com>
 */

namespace herroffizier\yii2arcache;

use Yii;
use yii\db\ActiveRecord;
use yii\caching\TagDependency;

class Behavior extends \yii\base\Behavior
{
    /**
     * Cache component.
     *
     * @var string
     */
    public $cache = 'cache';

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'invalidateCache',
            ActiveRecord::EVENT_AFTER_UPDATE => 'invalidateCache',
            ActiveRecord::EVENT_AFTER_DELETE => 'invalidateCache',
        ];
    }

    /**
     * Get array of tags for dependency.
     *
     * @return string[]
     */
    protected function getCacheTags()
    {
        $classes = [$this->owner];

        $tags = TagBuilder::buildTags($classes);

        return $tags;
    }

    /**
     * Invalidate cache for current model.
     */
    public function invalidateCache()
    {
        $tags = $this->getCacheTags();

        TagDependency::invalidate(Yii::$app->get($this->cache), $tags);
    }

    /**
     * Get AR cache dependency for current model.
     *
     * @return Dependency
     */
    public function getCacheDependency()
    {
        $tags = $this->getCacheTags();

        return new TagDependency(['tags' => $tags]);
    }
}
