<?php

namespace AppBundle\Services;



class PushNotification{

    private $apiKey;
    private $appId;
    public function __construct($oneSignalAppId, $oneSignalApiKey)
    {
        $this->appId = $oneSignalAppId;
        $this->apiKey = $oneSignalApiKey;
    }

    /**
     * @param array $segments
     * @param string $message
     * @param string $url
     * @return mixed
     */
    function sendMessage($segments, $message, $url) {
        $content      = array(
            "en" => $message
        );
        $fields = array(
            'app_id' => $this->appId,
            'included_segments' => $segments,
            'contents' => $content,
            'url' => $url
        );

        $fields = json_encode($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic '. $this->apiKey
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}
