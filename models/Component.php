<?php

namespace app\models;

/**
 * This is the model class for table "component".
 *
 * @property integer $id
 * @property string $name
 * @property string $instock
 * @property integer $tractormodel_id
 * @property integer $dependentcomponent
 *
 * @property Tractormodel $tractormodel
 * @property Dependency[] $dependencies
 * @property Dependency[] $dependencies0

 */
class Component extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'component';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['tractormodel_id', 'instock'], 'required'],
            [['tractormodel_id', 'instock'], 'integer'],
            [['name', 'dependentcomponent'], 'string', 'max' => 56],
            [['tractormodel_id', 'instock'], 'exist', 'skipOnError' => true, 'targetClass' => Tractormodel::className(), 'targetAttribute' => ['tractormodel_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Component Name',
            'instock' => 'Inventory Amount',
            'tractormodel_id' => 'Tractor Models',
            'dependentcomponent' => 'Dependent Component',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTractormodel() {
        return $this->hasOne(Tractormodel::className(), ['id' => 'tractormodel_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDependencies() {
        return $this->hasMany(Dependency::className(), ['component_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDependencies0() {
        return $this->hasMany(Dependency::className(), ['dependent_id' => 'id']);
    }
    
   

}
