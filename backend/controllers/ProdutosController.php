<?php

namespace backend\controllers;

use Yii;
use backend\models\Produtos;
use backend\models\ProdutosSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProdutosController implements the CRUD actions for Produtos model.
 */
class ProdutosController extends Controller
{


    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'exibir', 'incluir', 'atualizar', 'excluir'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Lists all Produtos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProdutosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Produtos model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionExibir($id)
    {
        return $this->render('exibir', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Produtos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws \yii\base\Exception
     * @throws \Throwable
     */
    public function actionIncluir()
    {
        $model = new Produtos();

        $model->scenario = 'inclusao';

        if ($model->load(Yii::$app->request->post())) {


            $foto1 = UploadedFile::getInstanceByName('foto1');
            $foto2 = UploadedFile::getInstanceByName('foto2');
            $foto3 = UploadedFile::getInstanceByName('foto3');
            $foto4 = UploadedFile::getInstanceByName('foto4');
            $foto5 = UploadedFile::getInstanceByName('foto5');

            $model->foto1 = $foto1->name;

            if (!$model->validate()) {


                if (!$model->foto1) {
                    Yii::$app->session->setFlash('error', 'Insira ao menos uma Foto');
                    $model->addError('foto1', 'Insira ao menos uma Foto');
                }

                return $this->render('incluir', [
                    'model' => $model,
                ]);

            }
            $model->save(false);

            $caminho = $model->localSalvarImagens();

            if (!file_exists($caminho)) {// se não existir o diretório, crio ele
                $dir = new \yii\helpers\FileHelper();
                $dir->createDirectory($caminho, 0775, true);
            }


            if ($foto1) {
                $arq = 'foto1_' . time() . '.' . $foto1->getExtension();
                $model->foto1 = $arq;
                $foto1->saveAs($caminho . '/'.$arq);
            }
            if ($foto2) {
                $arq = 'foto2_' . time() . '.' . $foto2->getExtension();
                $model->foto2 = $arq;
                $foto2->saveAs($caminho . '/'.$arq);
            }
            if ($foto3) {
                $arq = 'foto3_' . time() . '.' . $foto3->getExtension();
                $model->foto3 = $arq;
                $foto3->saveAs($caminho . '/'.$arq);
            }
            if ($foto4) {
                $arq = 'foto4_' . time() . '.' . $foto4->getExtension();
                $model->foto4 = $arq;
                $foto4->saveAs($caminho . '/'.$arq);
            }
            if ($foto5) {
                $arq = 'foto5_' . time() . '.' . $foto5->getExtension();
                $model->foto5 = $arq;
                $foto5->saveAs($caminho . '/'.$arq);
            }

            $model->update(false);
            return $this->redirect(['exibir', 'id' => $model->id]);
        }

        return $this->render('incluir', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Produtos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionAtualizar($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {


            $foto1 = UploadedFile::getInstanceByName('foto1');
            $foto2 = UploadedFile::getInstanceByName('foto2');
            $foto3 = UploadedFile::getInstanceByName('foto3');
            $foto4 = UploadedFile::getInstanceByName('foto4');
            $foto5 = UploadedFile::getInstanceByName('foto5');

//            dd( Yii::$app->request->post(), $foto1, $model);

            $model->save();

            $caminho = $model->localSalvarImagens();

            if ($foto1 && Yii::$app->request->post('atualiza_foto1') == 'on') {
                @unlink($caminho . '/' . $model->foto1);
                $arq = 'foto1_' . time() . '.' . $foto1->getExtension();
                $model->foto1 = $arq;
                $foto1->saveAs($caminho . '/'.$arq);
            }
            if (Yii::$app->request->post('atualiza_foto2') == 'on') {
                if ($foto2) {
                    @unlink($caminho . '/' . $model->foto2);
                    $arq = 'foto2_' . time() . '.' . $foto2->getExtension();
                    $model->foto2 = $arq;
                    $foto2->saveAs($caminho . '/' . $arq);
                } else
                    $model->foto2 = null;
            }
            if (Yii::$app->request->post('atualiza_foto3') == 'on') {
                if ($foto3) {
                    @unlink($caminho . '/' . $model->foto3);
                    $arq = 'foto3_' . time() . '.' . $foto3->getExtension();
                    $model->foto3 = $arq;
                    $foto3->saveAs($caminho . '/' . $arq);
                } else
                    $model->foto3 = null;
            }
            if (Yii::$app->request->post('atualiza_foto4') == 'on') {
                if ($foto4) {
                    @unlink($caminho . '/' . $model->foto4);
                    $arq = 'foto4_' . time() . '.' . $foto4->getExtension();
                    $model->foto4 = $arq;
                    $foto4->saveAs($caminho . '/' . $arq);
                } else
                    $model->foto4 = null;
            }
            if (Yii::$app->request->post('atualiza_foto5') == 'on') {
                if ($foto5) {
                    @unlink($caminho . '/' . $model->foto5);
                    $arq = 'foto5_' . time() . '.' . $foto5->getExtension();
                    $model->foto5 = $arq;
                    $foto5->saveAs($caminho . '/' . $arq);
                } else
                    $model->foto5 = null;
            }

            $model->update(false);


            return $this->redirect(['exibir', 'id' => $model->id]);
        }

        return $this->render('atualizar', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Produtos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionExcluir($id)
    {
        $model = $this->findModel($id);

        self::deleteDir($model->localSalvarImagens() . '/' . $model->id);

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Produtos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Produtos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Produtos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    protected function deleteDir($dirPath) {
        if (! is_dir($dirPath)) {
            throw new \InvalidArgumentException("$dirPath deve ser um diretório!");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }
}
