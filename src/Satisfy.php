<?php namespace Mitch\Satisfy;

use Mitch\Satisfy\Drivers\Driver;

class Satisfy
{
    private $driver;
    private $token;

    public function __construct(Driver $driver = null)
    {
        $this->driver = $driver;
    }

    public function setDriver(Driver $driver)
    {
        $this->driver = $driver;
        return $this;
    }

    public function authorize()
    {
        $this->driver->authorize();
    }

    public function getAuthorizationUrl()
    {
        return $this->driver->getAuthorizationUrl();
    }

    public function getAccessToken($code)
    {
        $this->token = $this->driver->requestAccessToken($code);
        return $this->token;
    }

    public function getAcceptedScopes()
    {
        return $this->token->getAcceptedScopes();
    }

    public function hasScopes($scopes = [])
    {
        return $this->token->hasScopes($scopes);
    }

    public function hasScope($scope)
    {
        return $this->token->hasScopes((array) $scope);
    }

    public function getQueryBuilder()
    {
        //
    }

    public function setHeader($header, $value)
    {
        $this->driver->setHeader($header, $value);
    }

    public function setHeaders($headers = [])
    {
        $this->driver->setHeaders($headers);
    }

    public function getHeaders()
    {
        return $this->driver->getHeaders();
    }

    public function setScope($scope)
    {
        $this->driver->setScope($scope);
    }

    public function setScopes($scopes = [])
    {
        $this->driver->setScopes($scopes);
    }

    public function getScopes()
    {
        return $this->driver->getScopes();
    }

    public function setLastToken($token)
    {
        $this->token = $token;
    }

    public function getLastToken()
    {
        return $this->token;
    }

    public function getDriverName()
    {
        return $this->driver->getDriverName();
    }
}