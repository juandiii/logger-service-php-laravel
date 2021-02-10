<?php

namespace JuanDiii\LoggerService\Service;

use Exception;
use Illuminate\Support\Facades\App;

class LogService
{

    /**
     * @param String appName
     * @param String message
     */
    public function debug($message)
    {
        $data = [
            'body' => [
                'message' => $message,
                'error' =>  'debug',
            ]
        ];

        return $this->sendPublish($data);
    }

    /**
     * @param String appName
     * @param String message
     */
    public function error($message)
    {
        $data = [
            'body' => [
                'message' => $message,
                'error' =>  'error',
            ]
        ];

        return $this->sendPublish($data);
    }

    /**
     * @param String $data
     * @return mixed
     */
    private function sendPublish($data)
    {
        /**
         * @var GuzzleClient $connect
         */
        $connect = App::make(GuzzleClient::class);

        try {
            return $connect->post('/api/v1/loggers', $data);
        } catch (Exception $ex) {
        }

        return;
    }
}
