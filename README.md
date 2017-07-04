yii2 url alias
==============
like opencart seo url

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require --prefer-dist caijq4ever/yii2-urlalias "dev-master"
```

or add

```
"caijq4ever/yii2-urlalias": "dev-master"
```

to the require section of your `composer.json` file.


Usage
-----

1.Edit `config/web.php` file
```php
'components' => [
    ...
    'urlManager' => [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'rules' => [
            [
                'class' => 'junqi\urlalias\UrlRule',
            ],
        ],
    ],
    ...
],
```

2.Install migrations `yii migrate/up --migrationPath=@vendor/caijq4ever/yii2-urlalias/migrations`

3.Insert fake data
```SQL
INSERT INTO `url_alias` (`id`, `alias`, `route`, `params`, `status`) VALUES
(1, 'hello', 'site/index', 'a:0:{}', 1),
(2, 'world', 'site/about', 'a:0:{}', 1);
```

4.Run `http://path/to/your/project/hello` on your browser


TODO
----
- Cache
- ...
