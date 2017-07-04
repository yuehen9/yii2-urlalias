<?php

namespace junqi\urlalias;

use yii\web\UrlRule as BaseUrlRule;
use junqi\urlalias\models\UrlAlias;

/**
 * custom url rule
 */
class UrlRule extends BaseUrlRule
{
    /**
     * @inheritdoc
     */
    public function init() {}

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

        return is_object($urlAlias) ? [$urlAlias->attributes['route'], unserialize($urlAlias->attributes['params']] : false;
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
        $urlAlias= UrlAlias::getAliasByRouteWithParams($route, $params);

        return is_object($urlAlias) ? $urlAlias->attributes['alias'] : false;
    }
}
