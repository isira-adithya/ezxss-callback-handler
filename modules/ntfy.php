<?php
    // Reference: https://docs.ntfy.sh/publish/#publish-as-json
    function postToNtfy(string $url, string $username="", string $password="", string $topic="bxss", string $title="ezXSS Alert", string $message="Blind XSS Fired!", array $tags=[], int $priority=3, string $attach="", string $filename="", string $click="", array $actions=[]) {
        $ntfy_options = [
            "topic" => $topic,
            "title" => $title,
            "message" => $message,
            "tags" => $tags,
            "priority" => $priority,
            "attach" => $attach,
            "filename" => $filename,
            "click" => $click,
            "actions" => $actions
        ];
        $http_options = [
            'http' => [
                'header'  => "Content-type: application/json",
                'method'  => 'POST',
                'content' => json_encode($ntfy_options)
            ]
        ];

        // Append basic auth header if username and password are provided
        if ($username !== "" && $password !== "") {
            $http_options['http']['header'] .= "\r\nAuthorization: Basic " . base64_encode("$username:$password");
        }

        $context  = stream_context_create($http_options);
        $result = file_get_contents($url, false, $context);

        return $result;
    }
?>