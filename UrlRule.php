<?php

namespace junqi\urlalias;

use yii\web\UrlRule as BaseUrlRule;
use junqi\urlalias\models\UrlAlias;

/**
 * custom url rule
 */
class UrlRule extends BaseUrlRule
{
    /** @var string $pattern */
    public $pattern = '';

    /** @var string $route */
    public $route = '';

    /**
     * @inheritdoc
     * @param \yii\web\UrlManager $manager
     * @param \yii\web\Request $request
     * @return array|bool
     */
    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
        $urlAlias = UrlAlias::getRouteByAlias($pathInfo);
        if (is_object($urlAlias)) {
            return [$urlAlias->attributes['route'], unserialize($urlAlias->attributes['params'])];
        }

        return parent::parseRequest($manager, $request);
    }

    /**
     * @inheritdoc
     * @param \yii\web\UrlManager $manager
     * @param string $route
     * @param array $params
     * @return string|bool
     */
    public function createUrl($manager, $route, $params)
    {
        $urlAlias = UrlAlias::getAliasByRouteWithParams($route, $params);
        if (is_object($urlAlias)) {
            return $urlAlias->attributes['alias'];
        }

        return parent::createUrl($manager, $route, $params);
    }
}
