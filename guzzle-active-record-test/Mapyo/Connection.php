<?php
namespace Mapyo;
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
                    'Authorization' => "Bearer ${settings['token']}",
                ),
            ),
        ));
    }
}
