<?php

namespace JuanDiii\LoggerService\Service;

use Illuminate\Support\Facades\App;

class LogService
{

    /**
     * @param String appName
     * @param String message
     */
    public function debug($appName, $message)
    {
        $data = [
            'body' => [
                'routingKey' => 'copyryn',
                'message' => 'Error in line 56',
                'error' =>  'debug',
            ]
        ];

        return $this->sendPublish($data);
    }

    /**
     * @param String appName
     * @param String message
     */
    public function error($appName, $message)
    {
        $data = [
            'body' => [
                'routingKey' => $appName,
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

        return $connect->post('/api/v1/loggers', $data);
    }
}
