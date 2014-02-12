<?php namespace Mitch\Satisfy\Drivers;

use Mitch\Satisfy\Guzzle;
use Mitch\Satisfy\Redirectors\Redirector;

abstract class Driver
{
    private $client;
    private $redirector;
    private $config = [];
    private $scopes = [];
    private $headers = [];

    public function __construct(Guzzle $client, Redirector $redirector, $config = [], $scopes = [], $headers = [])
    {
        $this->client = $client;
        $this->redirector = $redirector;
        $this->config = $config;
        $this->scopes = $scopes;
        $this->headers = $headers;
    }

    abstract public function getDriverName();
    abstract protected function getAuthorizationBase();
    abstract protected function getAccessTokenBase();
    abstract protected function getApiBase();
    abstract protected function setDefaultAuthorizationHeaders();
    abstract protected function setDefaultApiHeaders();
    abstract protected function processAccessTokenResponse($json);

    public function authorize()
    {
        $url = $this->getAuthorizationUrl();
        $this->redirector->to($url);
    }

    public function getAuthorizationUrl()
    {
        $parameters = [
            'client_id'    => $this->config['client_id'],
            'redirect_uri' => $this->config['redirect_uri'],
            'scope'        => $this->getFormatedScopes(),
        ];
        $query = http_build_query($parameters);
        return $this->getAuthorizationBase().'?'.$query;
    }

    public function requestAccessToken($code)
    {
        $query = $this->prepareAuthorizationRequest(['code' => $code]);
        $response = $this->client->request($this->getAccessTokenBase(), $query, 'post');
        return $this->processAccessTokenResponse($response);
    }

    public function setClient(Client $client)
    {
        $this->client = $client;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function setScopes($scopes = [])
    {
        $this->scopes = $scopes;
    }

    public function getScopes()
    {
        return $this->scopes;
    }

    public function setScope($scope)
    {
        $this->scopes[] = $scope;
    }

    public function getFormatedScopes()
    {
        return implode(',', $this->scopes);
    }

    public function setHeader($header, $value)
    {
        $this->headers[$header] = $value;
    }

    public function setHeaders(array $headers)
    {
        foreach ($headers as $header => $value) {
            $this->setHeader($header, $value);
        }
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    private function setDefaultClientOptions()
    {
        $this->client->setDefaultOption('headers', $this->getHeaders());
    }

    private function prepareAuthorizationRequest($extra = [])
    {
        $this->setDefaultAuthorizationHeaders();
        $this->setDefaultClientOptions();
        $query = [
            'client_id' => $this->config['client_id'],
            'client_secret' => $this->config['client_secret'],
        ];
        return $extra + $query;
    }
}