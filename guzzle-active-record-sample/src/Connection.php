<?php
namespace GuzzleActiveSample;
use Guzzle\Http\Client;

class Connection
{
    /**
     * access_token
     *
     * @var string
     */
    protected $token;

    /**
     * The Http Client
     *
     * @var Guzzle\Http\Client
     */
    protected $client;

    /**
     * Create a new Connection instance
     *
     * @param $token
     * @access public
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Return a HTTP client instance
     *
     * @return Guzzle\Http\Client
     */
    public function client()
    {
        if($this->client) return $this->client;

        return new Client(Settings::base_url(), array(
            'request.options' => array(
                'headers' => array(
                    'Content-Type' => 'application/json',
                    'Authorization' => "Bearer {$this->token}",
                ),
            ),
        ));
    }

    public function get($url, array $params = array())
    {
        $request = $this->client()->createRequest('GET', $url);
        $query = $request->getQuery();

        foreach ($params as $k => $v) {
            $query->set($k, $v);
        }

        return $this->client()->send($request);
    }

    public function post($url, $body)
    {
        return $this->client()->post($url, null, $body);
    }

    public function put($url, $body)
    {
        return $this->client()->put($url, null, $body);
    }

    public function delete($url)
    {
        return $this->client()->delete($url);
    }

}
