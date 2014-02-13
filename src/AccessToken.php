<?php namespace Mitch\Satisfy;

class AccessToken
{
    protected $token;
    protected $type;
    protected $scopes = [];

    public function __construct($token, $type = null, $scopes = [])
    {
        $this->token = $token;
        $this->type = $type;
        $this->scopes = $scopes;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getAcceptedScopes()
    {
        return $this->scopes;
    }

    public function hasScopes($scopes = [])
    {
        foreach ($scopes as $scope) {
            if( ! in_array($scope, $this->scopes)) return false;
        }
        return true;
    }
}