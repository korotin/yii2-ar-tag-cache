# Yii2 AR Tag Cache

[![Build Status](https://travis-ci.org/herroffizier/yii2-ar-tag-cache.svg?branch=develop)](https://travis-ci.org/herroffizier/yii2-ar-tag-cache) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/herroffizier/yii2-ar-tag-cache/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/herroffizier/yii2-ar-tag-cache/?branch=develop) [![Code Coverage](https://scrutinizer-ci.com/g/herroffizier/yii2-ar-tag-cache/badges/coverage.png?b=develop)](https://scrutinizer-ci.com/g/herroffizier/yii2-ar-tag-cache/?branch=develop)

Yii2 AR Tag Cache automatically invalidates tagged cache when ActiveRecord changes.

In fact it is a simple wrapper over Yii2's ```TagDependency```. It creates special tag for ActiveRecord class and invalidates all cache marked by that tag when any of that class instances is being created, updated or deleted.

## Installation

Install extension with Composer:

```bash
composer require "herroffizier/yii2-ar-tag-cache:@stable"
```

Attach behavior to AR model:

```php
public function behaviors()
{
    return [
        'arCache' => [
            'class' => \herroffizier\yii2artc\Behavior::className(),
        ],
    ];
}
```

## Usage

```php
// Get tag dependency:
$dependency = $model->tagDependency;

// Attach dependency to cache:
Yii::$app->cache->set('cache', 'test', 0, $dependency);

// Now if you call save() or delete() for any instance of $model's class, cache will be invalidated.
// Also you may force cache invalidation without modifying models:
$model->invalidateCache();
```