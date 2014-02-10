<?php namespace Mitch\Satisfy\Drivers;

class GithubDriver extends Driver
{
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

    public function getDriverName()
    {
        return 'Github';
    }
}