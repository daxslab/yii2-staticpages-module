<?php

namespace daxslab\staticpages\components;

use Yii;

class Utils
{
    public static function breadcrumbsForPage($page)
    {
        $links = [];
        $current = $page;
        while ($current) {
            $links[] = [
                'label' => $current->title,
                'url' => ['page/update', 'id' => $current->id],
            ];
            $current = $current->parent;
        }

        $links[] = [
            'label' => Yii::t('app', 'Pages'),
            'url' => ['page/index'],
        ];

        unset($links[0]['url']);
        return array_reverse($links);
    }
}