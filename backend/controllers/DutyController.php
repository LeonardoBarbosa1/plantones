<?php

namespace backend\controllers;

use backend\models\DutyActivitiesSearch;
use common\models\User;
use DateTime;
use Yii;
use common\models\Duty;
use backend\models\DutySearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DutyController implements the CRUD actions for Duty model.
 */
class DutyController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            'create',
                            'update',
                            'delete',
                            'view',
                            'swap',
                            'activate',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Duty models.
     * @return mixed
     */
    public function actionIndex()
    {
        /**
         * @var $user User
         */
        $user = Yii::$app->user->identity;

        $modelCount = Duty::find()->whereUser($user->id)->count();

        $model = new Duty();
        if ($model->load(Yii::$app->request->post())) {
            // Definir o usuário e a data inicial
            $model->user_id = $user->id;

            // Convertendo a data recebida em timestamp
            $startDate = strtotime($model->date);

            // Verifica se a data é válida
            if ($startDate === false) {
                Yii::$app->session->setFlash('error', 'Data inválida.');
                return $this->redirect(['index']);
            }

            // Definir a data final como o último dia do ano
            $endDate = strtotime(date('Y-12-31', $startDate)); // Último dia do ano

            // Alternar entre STATUS_DUTY e STATUS_SLACK
            $currentStatus = Duty::STATUS_DUTY;

            // Loop através dos dias até o final do ano
            while ($startDate <= $endDate) {
                // Criar uma nova instância do modelo para cada data
                $dutyModel = new Duty();
                $dutyModel->user_id = $model->user_id;
                $dutyModel->date = $startDate; // Armazena o timestamp
                $dutyModel->status = $currentStatus;

                // Salvar o modelo
                if (!$dutyModel->save()) {
                    // Tratar erro ao salvar (opcional)
                    Yii::error("Erro ao salvar o modelo para a data: " . date('Y-m-d', $startDate));
                    Yii::$app->session->setFlash('error', 'Erro ao salvar: ' . implode(', ', $dutyModel->getErrors()));
                }

                // Alternar o status
                $currentStatus = ($currentStatus == Duty::STATUS_DUTY) ? Duty::STATUS_SLACK : Duty::STATUS_DUTY;

                // Avançar para o próximo dia
                $startDate = strtotime("+1 day", $startDate);
            }

            $lastDayOfYear = (new DateTime('last day of December'))->format('d/m/Y');
            Yii::$app->getSession()->addFlash('success', Yii::t('app', "Plantões até dia $lastDayOfYear cadastrados com sucesso."));

            return $this->redirect(['index', 'id' => $model->id]);
        }

        $searchModel = new DutySearch();
        $searchModel->user_id = $user->id;

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'modelCount' => $modelCount,
            'searchModel' => $searchModel,
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Duty model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Duty model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Duty();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Duty model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Duty model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete()
    {
        /**
         * @var $user User
         */
        $user = Yii::$app->user->identity;

        $models = Duty::find()->whereUser($user->id)->all();

        $deletedCount = 0;

        foreach ($models as $model) {
            if ($model->delete() !== false) {
                $deletedCount++;
            }
        }

        if ($deletedCount === count($models) && count(Duty::find()->whereUser($user->id)->all()) === 0) {
            Yii::$app->getSession()->addFlash('success', Yii::t('app', 'Todos os plantões foram excluídos com sucesso.'));
        } else {
            Yii::$app->getSession()->addFlash('warning', Yii::t('app', 'Alguns plantões não foram excluídos.'));
        }
        return $this->redirect(['index']);
    }

    /**
     * @return string
     */
    public function actionSwap()
    {
        /**
         * @var $user User
         */
        $user = Yii::$app->user->identity;

        $searchModel = new DutySearch();
        $searchModel->user_id = $user->id;

        if (Yii::$app->request->isPost) {
            // Captura os valores enviados pelo formulário
            $dutyToSwapId = Yii::$app->request->post('DutySearch')['duty_to_swap'];
            $dutyToReceiveId = Yii::$app->request->post('DutySearch')['duty_to_receive'];

            // Busca os plantões selecionados
            $dutyToSwap = Duty::find()->whereId($dutyToSwapId)->whereUser($user->id)->one();
            $dutyToReceive = Duty::find()->whereId($dutyToReceiveId)->whereUser($user->id)->one();

            // Validação: Verifica se os plantões existem e se os status são diferentes
            if ($dutyToSwap && $dutyToReceive && $dutyToSwap->status !== $dutyToReceive->status) {

                $tempStatus = $dutyToSwap->status;
                $dutyToSwap->status = $dutyToReceive->status;
                $dutyToReceive->status = $tempStatus;

                // Salva as mudanças no banco de dados
                if ($dutyToSwap->save() && $dutyToReceive->save()) {
                    Yii::$app->session->setFlash('success', 'Troca de plantões realizada com sucesso.');
                } else {
                    Yii::$app->session->setFlash('error', 'Erro ao salvar as mudanças.');
                }

            } else {
                Yii::$app->session->setFlash('error', 'Plantões inválidos ou com status iguais.');
            }

            return $this->refresh(); // Para evitar o reenvio de formulário ao atualizar a página
        }

        return $this->render('swap', [
            'searchModel' => $searchModel
        ]);
    }

    public function actionActivate($id)
    {
        $model = $this->findModel($id);

        $searchModel = new DutyActivitiesSearch();
        $searchModel->duty_id = $model->id;

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('activate', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
     * Finds the Duty model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Duty the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Duty::find()->whereId($id)->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
