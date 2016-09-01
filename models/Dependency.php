<?php

namespace app\models;

/**
 * This is the model class for table "dependency".
 *
 * @property integer $id
 * @property integer $count
 * @property integer $component_id
 * @property integer $dependent_id
 *
 * @property Component $component
 * @property Component $dependent
 */
class Dependency extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'dependency';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['count', 'component_id', 'dependent_id'], 'integer'],
            [['component_id', 'dependent_id'], 'required'],
            [['component_id'], 'exist', 'skipOnError' => true, 'targetClass' => Component::className(), 'targetAttribute' => ['component_id' => 'id']],
            [['dependent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Component::className(), 'targetAttribute' => ['dependent_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'count' => 'Count',
            'component_id' => 'Component ID',
            'dependent_id' => 'Dependent ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComponent() {
        return $this->hasOne(Component::className(), ['id' => 'component_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDependent() {
        return $this->hasOne(Component::className(), ['id' => 'dependent_id']);
    }

}
