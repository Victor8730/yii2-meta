<?php
declare(strict_types=1);

/**
 * Project: yii2-blog
 * Author: Victor8730
 * Copyright (c) 2021.
 */

namespace common\widgets;

use Yii;
use yii\base\Widget;

/**
 * Create meta data
 * Example use:
 * echo Meta::widget(['meta'=>[
 * 'description'=> 'description text',
 * 'image'=> 'http://site.com/image.png',
 * 'author'=> 'Author site',
 * 'robots'=> 'follow',
 * ]])
 *
 * Class Meta
 * @package app\widgets
 */
class Meta extends Widget
{
    public array $meta = [];
    public array $link = [];
    public bool $og = true;
    public bool $tw = true;
    private array $stdMeta = ['author', 'description', 'keywords', 'robots'];

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        if (!empty($this->meta)) {
            foreach ($this->meta as $key => $meta) {
                if (in_array($key, $this->stdMeta)) {
                    Yii::$app->view->registerMetaTag([
                        'name' => $key,
                        'content' => $meta,
                    ]);
                }
            }

            if ($this->og) {
                $this->og();
            }

            if ($this->tw) {
                $this->tw();
            }

            $this->alternate();
            $this->canonical();
        }
    }

    /**
     * create opengraph meta data
     */
    private function og(): void
    {
        if ($this->meta['description']) {
            Yii::$app->view->registerMetaTag([
                'property' => 'og:description',
                'content' => $this->meta['description'],
            ]);
        }

        if ($this->meta['title']) {
            Yii::$app->view->registerMetaTag([
                'property' => 'og:title',
                'content' => $this->meta['title'],
            ]);
        }

        if ($this->meta['image']) {
            Yii::$app->view->registerMetaTag([
                'property' => 'og:image',
                'content' => $this->meta['image'],
            ]);
        }

        Yii::$app->view->registerMetaTag([
            'property' => 'og:locale',
            'content' => Yii::$app->language,
        ]);

        Yii::$app->view->registerMetaTag([
            'property' => 'og:type',
            'content' => 'article',
        ]);

        Yii::$app->view->registerMetaTag([
            'property' => 'og:site_name',
            'content' => Yii::$app->name,
        ]);
    }

    /**
     * create twitter meta data
     */
    private function tw(): void
    {
        if ($this->meta['description']) {
            Yii::$app->view->registerMetaTag([
                'name' => 'twitter:description',
                'content' => $this->meta['description'],
            ]);
        }

        if ($this->meta['title']) {
            Yii::$app->view->registerMetaTag([
                'name' => 'twitter:title',
                'content' => $this->meta['title'],
            ]);
        }

        if ($this->meta['image']) {
            Yii::$app->view->registerMetaTag([
                'name' => 'twitter:image',
                'content' => $this->meta['image'],
            ]);
        }

        if ($this->meta['url']) {
            Yii::$app->view->registerMetaTag([
                'name' => 'twitter:url',
                'content' => $this->meta['url'],
            ]);
        }

        Yii::$app->view->registerMetaTag([
            'name' => 'twitter:type',
            'content' => 'article',
        ]);

        Yii::$app->view->registerMetaTag([
            'name' => 'twitter:card',
            'content' => 'summary',
        ]);
    }

    private function alternate(): void
    {
        if (!empty($this->link['alternate'])) {
            foreach ($this->link['alternate'] as $key => $link)
                Yii::$app->view->registerLinkTag([
                    'rel' => 'alternate',
                    'hreflang' => $key,
                    'href' => $link,
                ]);
        }
    }

    private function canonical(): void
    {
        if (!empty($this->link['canonical'])) {
            Yii::$app->view->registerLinkTag([
                'rel' => 'canonical',
                'href' => $this->link['canonical']]);
        }
    }
}
