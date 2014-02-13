<?php namespace Mitch\Satisfy\Drivers;

use Mitch\Satisfy\AccessToken;

class GithubDriver extends Driver
{
    public function getDriverName()
    {
        return 'Github';
    }

    protected function getAuthorizationBase()
    {
        return 'https://github.com/login/oauth/authorize';
    }

    protected function getAccessTokenBase()
    {
        return 'https://github.com/login/oauth/access_token';
    }

    protected function getApiBase()
    {
        return 'https://api.github.com';
    }

    protected function getDefaultAuthorizationHeaders()
    {
        return ['Accept' => 'application/json'];
    }

    protected function getDefaultApiHeaders()
    {
        return ['Accept' => 'application/vnd.github.v3+json'];
    }

    protected function processAccessTokenResponse($json)
    {
        $items = json_decode($json);
        $scopes = explode(',', $items->scope);
        return new AccessToken($items->access_token, $items->token_type, $scopes, $this->getScopes());
    }
}