StaticPages
===========

[![Build Status](https://secure.travis-ci.org/daxslab/yii2-staticpages-module.png)](http://travis-ci.org/daxslab/yii2-staticpages-module)
[![Latest Stable Version](https://poser.pugx.org/daxslab/yii2-staticpages-module/v/stable.svg)](https://packagist.org/packages/daxslab/yii2-staticpages-module)
[![Total Downloads](https://poser.pugx.org/daxslab/yii2-staticpages-module/downloads)](https://packagist.org/packages/daxslab/yii2-staticpages-module)
[![Latest Unstable Version](https://poser.pugx.org/daxslab/yii2-staticpages-module/v/unstable.svg)](https://packagist.org/packages/daxslab/yii2-staticpages-module)
[![License](https://poser.pugx.org/daxslab/yii2-staticpages-module/license.svg)](https://packagist.org/packages/daxslab/yii2-staticpages-module)

Module to manage static pages in a Yii2 application

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist daxslab/daxslab/yii2-staticpages-module "*"
```

or add

```
"daxslab/daxslab/yii2-staticpages-module": "*"
```

to the require section of your `composer.json` file.

Database Migration
------------------

```
./yii migrate --migration-path="@daxslab/staticpages/migrations"
```

Configuration
-------------

In the backend configure the Page module by the following:

```php
'modules' => [
    //...   
    'staticpages' => [
        'class' => daxslab\staticpages\Module::class,
        'controllerNamespace' => 'daxslab\staticpages\controllers\backend',
        // you can setup any InputWidget subclass as text editor
        'editorConfig' => [
            'class' => yii2mod\markdown\MarkdownEditor\MarkdownEditor::class,
        ];
    ],
    //...
]
```

And in frontend:

```php
'modules' => [
    //...   
    'staticpages' => [
            'class' => daxslab\staticpages\Module::class,
            'controllerNamespace' => 'daxslab\staticpages\controllers\frontend',
            // you can specify a different view path for better matching your style
            'viewPath' => '@frontend/views/',
        ],
    //...
]
```

Proudly made by [Daxslab](http://daxslab.com).