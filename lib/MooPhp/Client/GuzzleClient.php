<?php

namespace MooPhp\Client;

use \Guzzle\Http\Client as GuzzleHttpClient;
use Guzzle\Http\Url;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

class GuzzleClient implements Client, LoggerAwareInterface
{

    /**
     * @var LoggerInterface
     */
    protected $logger;

    protected $endpoint = 'https://secure.moo.com/api/service/';

    /**
     * @var GuzzleHttpClient
     */
    private $client;

    public function __construct(GuzzleHttpClient $client, LoggerInterface $logger = null)
    {
        if (isset($logger)) {
            $this->setLogger($logger);
        }
        $this->client = $client;
    }

    /**
     * @param array $params
     * @param string $method HTTP method to use (one of the HTTP_ consts)
     * @return string
     */
    public function makeRequest(array $params, $method = self::HTTP_POST)
    {
        if ($this->logger) {
            $this->logger->debug("Making Request", array("params" => $params));
        }
        $url = Url::factory($this->endpoint);
        switch ($method) {
            case self::HTTP_GET:
                $url->setQuery($params);
                $request = $this->client->get($url);
                break;
            case self::HTTP_POST:
                $request = $this->client->post($url, null, $params);
                break;
            default:
                throw new \InvalidArgumentException("Method is not valid");
        }
        $response = $request->send();
        $responseBody = $response->getBody(true);
        if ($this->logger) {
            $this->logger->debug("Got Response", array("rawResponse" => $responseBody));
        }
        return $responseBody;
    }

    /**
     * @param array $params
     * @param string $fileParam The name of the param that contains the path to the file on disk
     * @return string
     */
    public function sendFile(array $params, $fileParam)
    {
        $params[$fileParam] = "@" . $params[$fileParam];
        return $this->makeRequest($params, self::HTTP_POST);
    }

    /**
     * @param array $params
     * @return string
     */
    public function getFile(array $params)
    {
        return $this->makeRequest($params, self::HTTP_GET);
    }

    /**
     * Sets a logger instance on the object
     *
     * @param LoggerInterface $logger
     * @return null
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}