<?php

namespace daxslab\staticpages\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;

/**
 * This is the model class for table "page".
 *
 * @property int $id
 * @property string $language
 * @property string $title
 * @property string $slug
 * @property string $abstract
 * @property string $body
 * @property string $image
 * @property string $keywords
 * @property int $parent_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Page $parent
 * @property Page[] $pages
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language', 'title', 'body'], 'required'],
            [['abstract', 'body'], 'string'],
            [['parent_id'], 'integer'],
            [['image'], 'default'],
            [['language', 'title', 'image', 'keywords'], 'string', 'max' => 255],
            [
                ['parent_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Page::className(),
                'targetAttribute' => ['parent_id' => 'id']
            ],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
                'ensureUnique' => true,
            ],
            TimestampBehavior::class,
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('staticpages', 'ID'),
            'language' => Yii::t('staticpages', 'Language'),
            'title' => Yii::t('staticpages', 'Title'),
            'slug' => Yii::t('staticpages', 'Slug'),
            'abstract' => Yii::t('staticpages', 'Abstract'),
            'body' => Yii::t('staticpages', 'Body'),
            'image' => Yii::t('staticpages', 'Image'),
            'keywords' => Yii::t('staticpages', 'Keywords'),
            'parent_id' => Yii::t('staticpages', 'Parent ID'),
            'created_at' => Yii::t('staticpages', 'Created At'),
            'updated_at' => Yii::t('staticpages', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Page::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Page::className(), ['parent_id' => 'id']);
    }

    public function getFullSlug(){
        $parentFullSlug = $this->parent ? "{$this->parent->fullSlug}/" : '';
        return $parentFullSlug . $this->slug;
    }

    public function getUrl($schema = false){
        return urldecode(Url::toRoute(['view', 'slug' => $this->getFullSlug()]));
    }

    /**
     * @inheritdoc
     * @return PageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PageQuery(get_called_class());
    }
}
