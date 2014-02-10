<?php namespace Mitch\Satisfy;

use Mitch\Satisfy\Drivers\Driver;

class Satisfy
{
    private $driver;
    private $lastResponse;

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
        return $this->driver->requestAccessToken($code);
    }

    public function setHeaders($headers = [])
    {
        foreach ((array) $headers as $name => $content) {
            $this->driver->setHeader($name, $content);
        }
    }

    public function hasRequestedScopes()
    {
        // check if we have all the requested scopes
    }

    public function getAcceptedScopes()
    {
        return $this->driver->getAcceptedScopes();
    }

    public function hasAcceptedScopes($scopes = [])
    {
        $accepted = $this->getAcceptedScopes();
        foreach ($scopes as $scope) {
            if( ! in_array($scope, $accepted)) return false;
        }
        return true;
    }

    public function hasAcceptedScope($scope)
    {
        return $this->hasAcceptedScopes((array) $scope);
    }

    public function getQueryBuilder()
    {
        //
    }

    public function getCurrentDriverName()
    {
        return $this->driver->getDriverName();
    }

    public function setLastResponse($response)
    {
        $this->lastResponse = $response;
    }

    public function getLastResponse()
    {
        return $this->lastResponse;
    }
}