<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "drone".
 *
 * @property integer $id_drone
 * @property string $title
 * @property double $lat
 * @property double $lng
 * @property integer $mph
 */
class Drone extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'drone';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lat', 'lng'], 'number'],
            [['mph'], 'integer'],
            [['title'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_drone' => 'Id Drone',
            'title' => 'Title',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'mph' => 'Mph',
        ];
    }
}
