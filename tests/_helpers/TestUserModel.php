<?php

namespace Yii2Oauth2ServerTests\_helpers;

use rhertogh\Yii2Oauth2Server\interfaces\models\Oauth2UserInterface;
use rhertogh\Yii2Oauth2Server\Oauth2Module;
use rhertogh\Yii2Oauth2Server\traits\models\Oauth2UserIdentityTrait;
use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class TestUserModel extends ActiveRecord implements
    IdentityInterface,
    Oauth2UserInterface
{
    use Oauth2UserIdentityTrait; # Helper trait to pass IdentityInterface methods to Oauth2UserInterface

    /**
     * @inheritDoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritDoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritDoc
     */
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    /**
     * @inheritDoc
     */
    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }

    /**
     * @inheritDoc
     */
    public function fields()
    {
        /** @var Oauth2Module $oauth2Module */
        $oauth2Module = Yii::$app->getModule('oauth2');
        return [
            'id',
            ...($oauth2Module->requestHasScope('user.username.read') ? ['username'] : []),
            ...($oauth2Module->requestHasScope('user.email_address.read') ? ['email_address'] : []),
            ...($oauth2Module->requestHasScope('user.enabled.read') ? ['enabled'] : []),
            ...($oauth2Module->requestHasScope('user.created_at.read') ? ['created_at'] : []),
            ...($oauth2Module->requestHasScope('user.updated_at.read') ? ['updated_at'] : []),
        ];
    }
}
