<?php


namespace App\Classe;


use Mailjet\Client;
use Mailjet\Resources;

class Mails
{
    private $apiKey="e7df72b55d35027c72572cb2220d86f2";
    private $apiKeySecret= "f6795a4463fe5161919c7a37d95fdbfd";

    public function sendMail($to_email, $to_name, $subject, $content)
    {
        $mj = new Client($this->apiKey, $this->apiKeySecret,true,['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "cedric.comminges@gmail.com",
                        'Name' => "RoyalTrip"
                    ],
                    'To' => [
                        [
                            'Email' => $to_email,
                            'Name' => $to_name
                        ]
                    ],
                    'TemplateID' => 2971190,
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                    "Variables"=> [
                        "content" => $content,
                    ]
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() && dd($response->getData());
    }
}