<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\CalcSettings;
use yii\data\ActiveDataProvider;
use app\modules\admin\components\Controller;
use yii\web\NotFoundHttpException;

/**
 * SettingsController implements the CRUD actions for CalcSettings model.
 */
class SettingsController extends Controller
{

    /**
     * Updates an existing CalcSettings model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionIndex()
    {
        $model = $this->findModel(0);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the CalcSettings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CalcSettings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CalcSettings::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
