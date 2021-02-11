<?php

namespace JuanDiii\LoggerService\Service;

use Exception;
use \GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use JuanDiii\LoggerService\Exception\LoggerServiceException;

class GuzzleClient
{
    const CONFIG_KEY = 'logger';
    const BASE_URL = "http://localhost:8888";
    const CODE_RESPONSE = 200;

    private $accessKeyId;
    private $accessSecretKey;
    private $httpClient;

    public function __construct($config)
    {
        $this->extractProperties($config);
        $this->httpClient = new Client([
            'base_uri' => GuzzleClient::BASE_URL,
            'headers' => [
                'ACCESS_KEY_ID' => $this->accessKeyId,
                'ACCESS_SECRET_KEY' => $this->accessSecretKey,
            ],
        ]);
    }

    public function get($url)
    {
        try {
            $body = $this->httpClient->get($url);
            $code = $body->getStatusCode();
            if ($code != GuzzleClient::CODE_RESPONSE) {
                throw new LoggerServiceException("Error code {$code}");
            }

            $json = json_decode($body->getBody()->getContents(), true);

            return $json['data'];
        } catch (ServerException $ex) {
            throw new LoggerServiceException($ex->getMessage());
        } catch (ClientException $ex) {
            throw new LoggerServiceException($ex->getMessage());
        } catch (Exception $ex) {
            throw new LoggerServiceException($ex->getMessage());
        }
    }

    public function post($url, $data)
    {
        $data = json_encode($data);
        try {
            $body = $this->httpClient->post($url, [
                'body' => $data,
            ]);

            $json = $body->getBody()->getContents();
            $json = json_decode($json, true);
            $response = $json['data'];

            if (($response['errorsEvents'] != 0 && count($response['errors']))) {
                throw new LoggerServiceException("Internal error. Please contact the technical support.", 500);
            }

            return $response;
        } catch (ServerException $ex) {
            throw new LoggerServiceException($ex->getMessage());
        } catch (ClientException $ex) {
            throw new LoggerServiceException($ex->getMessage());
        } catch (Exception $ex) {
            throw new LoggerServiceException($ex->getMessage());
        }
    }

    protected function extractProperties($config)
    {
        if ($config->has(self::CONFIG_KEY)) {
            $data = $config->get(self::CONFIG_KEY);
            $this->accessKeyId = $data['logger']['accessKeyId'];
            $this->accessSecretKey = $data['logger']['accessSecretKey'];
        }
    }
}
