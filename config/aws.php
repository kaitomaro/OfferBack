<?php

use Aws\Laravel\AwsServiceProvider;

return [

    /*
    |--------------------------------------------------------------------------
    | AWS SDK Configuration
    |--------------------------------------------------------------------------
    |
    | The configuration options set in this file will be passed directly to the
    | `Aws\Sdk` object, from which all client objects are created. This file
    | is published to the application config directory for modification by the
    | user. The full set of possible options are documented at:
    | http://docs.aws.amazon.com/aws-sdk-php/v3/guide/guide/configuration.html
    |
    */
    'S3' => [
        'region' => env('AWS_S3_REGION', 'ap-northeast-1'),
        'credentials' => [
            'key' => env('AWS_S3_ACCESSKEY'),
            'secret' => env('AWS_S3_SECRETKEY') 
        ]
    ],
    'Sns' => [
        'region' => env('AWS_SNS_REGION', 'ap-northeast-1'),
        'credentials' => [
            'key' => env('AWS_SNS_ACCESSKEY'),
            'secret' => env('AWS_SNS_SECRETKEY') 
        ],
        'arn' => env('AWS_SNS_ARN'),
        'topic' => env('AWS_TOPIC_ARN')
    ]
];
