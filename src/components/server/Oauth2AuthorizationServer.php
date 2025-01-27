<?php

namespace rhertogh\Yii2Oauth2Server\components\server;

use League\OAuth2\Server\AuthorizationServer;
use rhertogh\Yii2Oauth2Server\interfaces\components\server\Oauth2AuthorizationServerInterface;

class Oauth2AuthorizationServer extends AuthorizationServer implements Oauth2AuthorizationServerInterface
{
    public function getEnabledGrantTypes()
    {
        return $this->enabledGrantTypes;
    }
}
