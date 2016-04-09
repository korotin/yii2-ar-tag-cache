<?php
/**
 * Yii2 AR Tag Cache.
 *
 * This file contains behavior class.
 *
 * @author  Aleksei Korotin <herr.offizier@gmail.com>
 */
namespace herroffizier\yii2artc;

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
     * Get tag dependency for current ActiveRecord class.
     *
     * @return Dependency
     */
    public function getTagDependency()
    {
        $tags = $this->getCacheTags();

        return new TagDependency(['tags' => $tags]);
    }
}
