<?php

namespace app\models;

/**
 * This is the model class for table "tractormodel".
 *
 * @property string $model
 */
class Tractormodel extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tractormodel';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['model'], 'required'],
            [['model'], 'string', 'max' => 60],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'model' => ' Tractor Models',
        ];
    }

}
