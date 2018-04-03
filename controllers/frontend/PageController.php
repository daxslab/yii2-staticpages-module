<?php

namespace daxslab\staticpages\controllers\frontend;

use daxslab\staticpages\Module;
use Yii;
use daxslab\staticpages\models\Page;
use daxslab\staticpages\models\PageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PageController implements the CRUD actions for Page model.
 */
class PageController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
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
     * Lists all Page models.
     * @return mixed
     */
    public function actionIndex($parent_id = null)
    {
        $searchModel = new PageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy('created_at DESC');
        $dataProvider->pagination->pageSize = $this->module->postsPerPage;

        if (!$parent_id) {
            $dataProvider->query->andWhere('parent_id IS NULL');
        } else {
            $parent = $this->findModel($parent_id);
            $dataProvider->query->andWhere([
                'parent_id' => $parent_id
            ]);
        }

        $renderMethod = isset($parent_id) ? 'renderPartial' : 'render';

        return $this->$renderMethod('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'parent_id' => $parent_id,
        ]);
    }

    public function actionView($slug)
    {

        $slug_parts = explode('/', $slug);

        $slugToSearch = array_reverse($slug_parts)[0];

        $model = $this->findModel($slugToSearch);

        if ($model->fullSlug != $slug) {
            throw new NotFoundHttpException(Yii::t('staticpages', 'The requested page does not exist.'));
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($slug)
    {
        if (($model = Page::find()->where(['slug' => $slug])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('staticpages', 'The requested page does not exist.'));
    }
}
