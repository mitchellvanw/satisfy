<?php namespace Mitch\Satisfy\Drivers;

use Mitch\Satisfy\AccessTokenResponse;

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

    protected function setDefaultAuthorizationHeaders()
    {
        $this->setHeaders(['Accept' => 'application/json']);
    }

    protected function setDefaultApiHeaders()
    {
        $this->setHeaders(['Accept' => 'application/vnd.github.v3+json']);
    }

    protected function processAccessTokenResponse($json)
    {
        $items = json_decode($json);
        $scopes = explode(',', $items->scope);
        return new AccessTokenResponse($items->access_token, $items->token_type, $scopes);
    }
}