<?php namespace Mitch\Satisfy;

class AccessTokenResponse
{
    private $token;
    private $type;
    private $scopes = [];

    public function __construct($token, $type, $scopes = [])
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

    public function getScopes()
    {
        return $this->scopes;
    }

    public function __sleep()
    {
        return ['token', 'type', 'scopes'];
    }

    public function __toString()
    {
        return serialize($this);
    }
}