<?php
/**
 * Yii2 AR Tag Cache.
 *
 * This file contains AR cache behavior test class.
 *
 * @author  Aleksei Korotin <herr.offizier@gmail.com>
 */
namespace herroffizier\yii2artc\tests\codeception\unit;

use yii\codeception\TestCase;
use herroffizier\yii2artc\TagBuilder;
use herroffizier\yii2artc\tests\codeception\_helpers\Model1;
use herroffizier\yii2artc\tests\codeception\_helpers\Model2;

class TagBuilderTest extends TestCase
{
    public function testSingleScalar()
    {
        $this->assertEquals(
            ['herroffizier\yii2artc\tests\codeception\_helpers\Model1'],
            TagBuilder::buildTags(Model1::className())
        );
    }

    public function testSingleInstance()
    {
        $this->assertEquals(
            ['herroffizier\yii2artc\tests\codeception\_helpers\Model1'],
            TagBuilder::buildTags(new Model1())
        );
    }

    /**
     * @expectedException \yii\base\InvalidConfigException
     */
    public function testSingleIncorrect()
    {
        $this->assertEquals(
            ['herroffizier\yii2artc\tests\codeception\_helpers\Model1'],
            TagBuilder::buildTags(null)
        );
    }

    public function testArrayScalar()
    {
        $this->assertEquals(
            [
                'herroffizier\yii2artc\tests\codeception\_helpers\Model1',
                'herroffizier\yii2artc\tests\codeception\_helpers\Model2',
            ],
            TagBuilder::buildTags([Model1::className(), Model2::className()])
        );
    }

    public function testArrayInstance()
    {
        $this->assertEquals(
            [
                'herroffizier\yii2artc\tests\codeception\_helpers\Model1',
                'herroffizier\yii2artc\tests\codeception\_helpers\Model2',
            ],
            TagBuilder::buildTags([Model1::className(), Model2::className()])
        );
    }
}
