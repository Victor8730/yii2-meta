# Wps YII2 Widget Meta
- Contributors: webpagestudio.com
- Tags: meta data for yii2
- Stable tag: 1.0.0

## Use
```
Meta::widget([
    'meta' => [
        'description' => $post->meta_description,
        'keywords' => $post->keywords,
        'image' => $post->image,
        'title' => $post->title,
        'author' => $post->user->nickname,
        'url' => $post->getAbsoluteUrl(),
        'robots' => 'follow',
    ], 
    'link' => [
        'alternate' => $post->getAlternateUrls(),
        'canonical' => $post->getAbsoluteUrl(),
    ]
]);
```

## Description
Widget create metadata

## Installation
- Upload `yii2-meta` to directory with your widget

## Changelog
- 1.0.0
  - first release