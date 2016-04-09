<?php

namespace herroffizier\yii2artc\tests\codeception\_helpers;

use herroffizier\yii2artc\Behavior;

class Model1 extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'model1';
    }

    public function behaviors()
    {
        return [
            'arCache' => [
                'class' => Behavior::className(),
            ],
        ];
    }
}
