<?php

namespace app\controllers;

use Yii;
use app\models\Component;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Tractormodel;
use app\models\Dependency;

/**
 * ComponentController implements the CRUD actions for Component model.
 */
class ComponentController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Component models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Component::find()->with("dependencies"),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Component model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {

        $tractorModels = ArrayHelper::map(Tractormodel::find()->all(), 'id', 'model');

        $dataProvider = new ActiveDataProvider([
            'query' => Component::find()->with("dependencies"),
        ]);

        return $this->render('view', [
                    'model' => $this->findModel($id), 'tractorModels' => $tractorModels, 'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Component model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Component();

        $tractorModels = ArrayHelper::map(Tractormodel::find()->all(), 'id', 'model');

        $components = Component::findBySql(" SELECT c.* FROM component c WHERE c.id NOT IN (SELECT component_id FROM dependency d) ")->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $dependendComponents = Yii::$app->request->bodyParams['ids'];
            foreach ($dependendComponents as $dComp) {

                $dependencyModel = new Dependency();
                $dependencyModel->setAttributes([
                    'count' => $dComp['quantity'],
                    'component_id' => $model->id,
                    'dependent_id' => $dComp['id']
                ]);
                $dependencyModel->save();
            }

            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('create', ['model' => $model, 'tractorModels' => $tractorModels, 'components' => $components,
            ]);
        }
    }

    /**
     * Updates an existing Component model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {

        $model = Component::find()->where(['id' => $id])->one();

        $tractorModels = ArrayHelper::map(Tractormodel::find()->all(), 'id', 'model');

        $sql = "SELECT c.* FROM component c WHERE c.id NOT IN (SELECT component_id FROM dependency d) AND id != :currentComponent ";

        $components = Component::findBySql($sql, ['currentComponent' => $id])->all();

        $depModels = Dependency::find()->where(['component_id' => $id])->all();

        $deletedIDs = Yii::$app->request->post("deletedIds");

        if ($deletedIDs && is_array($deletedIDs)) {
            Dependency::deleteAll(['IN', 'id', $deletedIDs]);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $dependendComponents = Yii::$app->request->bodyParams['ids'];

            foreach ($dependendComponents as $dComp) {
                $dependencyModel = new Dependency();
                $dependencyModel->setAttributes([
                    'count' => $dComp['quantity'],
                    'component_id' => $model->id,
                    'dependent_id' => $dComp['id']
                ]);
                $dependencyModel->save();
            }
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model, 'tractorModels' => $tractorModels,
                        'components' => $components, 'depModels' => $depModels,
            ]);
        }
    }

    /**
     * Deletes an existing Component model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Component model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Component the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Component::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
