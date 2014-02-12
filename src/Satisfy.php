<?php namespace Mitch\Satisfy;

use Mitch\Satisfy\Drivers\Driver;

class Satisfy
{
    private $driver;
    private $lastResponse;
    private $requestedScopes = [];

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
        $this->setRequestedScopes();
        $this->driver->authorize();
    }

    public function getAuthorizationUrl()
    {
        $this->setRequestedScopes();
        return $this->driver->getAuthorizationUrl();
    }

    public function getAccessToken($code)
    {
        $this->lastResponse = $this->driver->requestAccessToken($code);
        return $this->lastResponse;
    }

    public function hasRequestedScopes(AccessTokenResponse $response = null)
    {
        $response = $response ?: $this->lastResponse;
        return $this->areScopesEqual($response->getScopes());
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

    private function setRequestedScopes()
    {
        $this->requestedScopes = $this->getScopes();
    }

    private function areScopesEqual($scopes)
    {
        if ( ! $scopes) {
            throw new AccessTokenResponseNotFoundException;
        }
        return $this->requestedScopes == $scopes;
    }
}