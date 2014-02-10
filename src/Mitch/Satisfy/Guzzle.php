<?php namespace Mitch\Satisfy;

use Guzzle\Http\Client;

class Guzzle
{
    private $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ?: new Client;
    }

    public function request($path, $query = [], $verb = 'get')
    {
        $pattern = $this->formatPattern($query);
        $query['path'] = $path;
        $request = $this->client->{$verb}([$pattern, $query]);
        $response = $request->send();
        // d($response->json());
        d($response->getBody(true));
        dd($response->getBody());
    }

    public function setDefaultOption($name, $option)
    {
        $this->client->setDefaultOption($name, $option);
    }

    protected function formatPattern($query = [])
    {
        $keys = array_keys((array) $query);
        return sprintf('{+path}{?%s}', implode('}{&', $keys));
    }
}