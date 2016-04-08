# Yii2 AR Cache

[![Build Status](https://travis-ci.org/herroffizier/yii2-ar-cache.svg?branch=develop)](https://travis-ci.org/herroffizier/yii2-ar-cache) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/herroffizier/yii2-ar-cache/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/herroffizier/yii2-ar-cache/?branch=develop) [![Code Coverage](https://scrutinizer-ci.com/g/herroffizier/yii2-ar-cache/badges/coverage.png?b=develop)](https://scrutinizer-ci.com/g/herroffizier/yii2-ar-cache/?branch=develop)

Yii2 AR Cache automatically invalidates tagged cache on ActiveRecord model changes.

In fact it is a simple wrapper over Yii2's ```TagDependency```. It creates special tag for ActiveRecord class and invalidates all cache marked by that tag when any of ActiveRecord models is being created, updated or deleted.

## Installation

Install extension with Composer:

```bash
composer require "herroffizier/yii2-ar-cache:@stable"
```

Attach behavior to AR model:

```php
public function behaviors()
{
    return [
        'arCache' => [
            'class' => \herroffizier\yii2arcache\Behavior::className(),
        ],
    ];
}
```

AR Cache is ready to use.

## Usage

```php
// Get AR Cache dependency:
$dependency = $model->cacheDependency;

// Attach dependency to cache:
Yii::$app->cache->set('cache', 'test', 0, $dependency);

// Now if you call save() or delete() for any instance of $model's class, cache will be invalidated.
// Also you may force cache invalidation without modifying models:
$model->invalidateCache();
```