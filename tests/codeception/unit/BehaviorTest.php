<?php
/**
 * Yii2 AR Tag Cache.
 *
 * This file contains behavior test class.
 *
 * @author  Aleksei Korotin <herr.offizier@gmail.com>
 */
namespace herroffizier\yii2artc\tests\codeception\unit;

use Yii;
use yii\codeception\TestCase;
use herroffizier\yii2artc\tests\codeception\_helpers\Model1;

class BehaviorTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        Yii::$app->cache->flush();
    }

    public function tearDown()
    {
        Yii::$app->cache->flush();

        parent::tearDown();
    }

    public function testCreateModel()
    {
        $model = new Model1();

        $tagDependency = $model->tagDependency;

        $cacheWithDependencyId = md5(rand());
        $cacheWithoutDependencyId = md5(rand());
        $cache = Yii::$app->cache;

        $this->assertFalse($cache->get($cacheWithDependencyId));
        $this->assertFalse($cache->get($cacheWithoutDependencyId));
        $cache->set($cacheWithDependencyId, 'test', 0, $tagDependency);
        $cache->set($cacheWithoutDependencyId, 'test', 0);
        $this->assertEquals('test', $cache->get($cacheWithDependencyId));
        $this->assertEquals('test', $cache->get($cacheWithoutDependencyId));

        $this->assertTrue($model->save());

        $this->assertFalse($cache->get($cacheWithDependencyId));
        $this->assertEquals('test', $cache->get($cacheWithoutDependencyId));
    }

    public function testUpdateModel()
    {
        $model = new Model1();

        $this->assertTrue($model->save());

        $tagDependency = $model->tagDependency;

        $cacheWithDependencyId = md5(rand());
        $cacheWithoutDependencyId = md5(rand());
        $cache = Yii::$app->cache;

        $this->assertFalse($cache->get($cacheWithDependencyId));
        $this->assertFalse($cache->get($cacheWithoutDependencyId));
        $cache->set($cacheWithDependencyId, 'test', 0, $tagDependency);
        $cache->set($cacheWithoutDependencyId, 'test', 0);
        $this->assertEquals('test', $cache->get($cacheWithDependencyId));
        $this->assertEquals('test', $cache->get($cacheWithoutDependencyId));

        $this->assertTrue($model->save());

        $this->assertFalse($cache->get($cacheWithDependencyId));
        $this->assertEquals('test', $cache->get($cacheWithoutDependencyId));
    }

    public function testDeleteModel()
    {
        $model = new Model1();

        $this->assertTrue($model->save());

        $tagDependency = $model->tagDependency;

        $cacheWithDependencyId = md5(rand());
        $cacheWithoutDependencyId = md5(rand());
        $cache = Yii::$app->cache;

        $this->assertFalse($cache->get($cacheWithDependencyId));
        $this->assertFalse($cache->get($cacheWithoutDependencyId));
        $cache->set($cacheWithDependencyId, 'test', 0, $tagDependency);
        $cache->set($cacheWithoutDependencyId, 'test', 0);
        $this->assertEquals('test', $cache->get($cacheWithDependencyId));
        $this->assertEquals('test', $cache->get($cacheWithoutDependencyId));

        $this->assertEquals(1, $model->delete());

        $this->assertFalse($cache->get($cacheWithDependencyId));
        $this->assertEquals('test', $cache->get($cacheWithoutDependencyId));
    }
}
