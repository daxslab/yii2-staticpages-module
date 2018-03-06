<?php

namespace daxslab\staticpages;

use Yii;
use yii2mod\markdown\MarkdownEditor;

/**
 * staticspages module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'daxslab\staticspages\frontend\controllers';

    public $editorConfig = [
        'class' => MarkdownEditor::class,
    ];

    protected $_isBackend;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if ($this->getIsBackend() === true) {
            $this->setViewPath('@daxslab/staticpages/views/backend');
        } else {
            if ($this->viewPath == Yii::getAlias('@daxslab/staticpages/views')) {
                $this->setViewPath('@daxslab/staticpages/views/frontend');
            }
        }

        $app = Yii::$app;

        if (!isset($app->i18n->translations['staticpages'])) {
            $app->i18n->translations['staticpages'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@daxslab/staticpages/messages',
                'forceTranslation' => true,
                'fileMap' => [
                    'staticpages' => 'staticpages.php',
                ]
            ];
        }

    }

    /**
     * Check if module is used for backend application.
     *
     * @return boolean true if it's used for backend application
     */
    public function getIsBackend()
    {
        if ($this->_isBackend === null) {
            $this->_isBackend = strpos($this->controllerNamespace, 'backend') === false ? false : true;
        }

        return $this->_isBackend;
    }

//    public static function t($message, $params = [], $language = null) {
//        return Yii::t('staticpages', $message, $params, $language);
//    }

}
