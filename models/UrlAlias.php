<?php

namespace junqi\urlalias\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "url_alias".
 *
 * @property integer $id
 * @property string $alias
 * @property string $route
 * @property string $params
 * @property integer $status
 */
class UrlAlias extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_PASSIVE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'url_alias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias', 'route'], 'required'],
            [['status'], 'integer'],
            [['alias', 'route', 'params'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alias' => 'Alias',
            'route' => 'Route',
            'params' => 'Params',
            'status' => 'Status',
        ];
    }

    /**
     * @param string $route
     * @param string $params
     * @return self
     */
    public static function getAliasByRouteWithParams($route, $params, $status = self::STATUS_ACTIVE)
    {
        return self::getDb()->cache(function () use ($route, $params, $status) {
            return self::find()->where(
                'route = :ROUTE AND params = :PARAMS AND status = :STATUS',
                [
                    ':ROUTE' => $route,
                    ':PARAMS' => serialize($params),
                    ':STATUS' => $status,
                ]
            )->one();
        }, 10);
    }

    /**
     * @param string $alias
     * @return self
     */
    public static function getRouteByAlias($alias, $status = self::STATUS_ACTIVE)
    {
        return self::getDb()->cache(function () use ($alias, $status) {
            return self::find()->where(
                'alias = :ALIAS AND status = :STATUS',
                [
                    ':ALIAS' => $alias,
                    ':STATUS' => $status,
                ]
            )->one();
        }, 10);
    }
}
