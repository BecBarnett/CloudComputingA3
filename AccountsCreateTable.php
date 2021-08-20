<?php
/**
 * Cloud Computing Assignment 3 by Rebecca Barnett S3856827
*/

require 'vendor/autoload.php';

date_default_timezone_set('UTC');

use Aws\DynamoDb\Exception\DynamoDbException;

$sdk = new Aws\Sdk([
    'region'   => 'us-east-1',
    'version'  => 'latest'
]);

$dynamodb = $sdk->createDynamoDb();

$params = [
    'TableName' => 'Accounts',
    'KeySchema' => [
        [
            'AttributeName' => 'email',
            'KeyType' => 'HASH'  //Partition key
        ]
    ],
    'AttributeDefinitions' => [
        [
            'AttributeName' => 'email',
            'AttributeType' => 'S'
        ],
        [
            'AttributeName' => 'username',
            'AttributeType' => 'S'
        ],
        [
            'AttributeName' => 'password',
            'AttributeType' => 'S'
        ],
        [
            'AttributeName' => 'favTeam',
            'AttributeType' => 'S'
        ],
        [
            'AttributeName' => 'favDriver',
            'AttributeType' => 'S'
        ],
        [
            'AttributeName' => 'timezone',
            'AttributeType' => 'S'
        ],
    ],
    'ProvisionedThroughput' => [
        'ReadCapacityUnits' => 10,
        'WriteCapacityUnits' => 10
    ]
];

try {
    $result = $dynamodb->createTable($params);
    echo 'Table created successfully. Status:' . 
        $result['TableDescription']['TableStatus'] ."\n";

} catch (DynamoDbException $e) {
    echo "Table was not created. Status:\n";
    echo $e->getMessage() . "\n";
}

?>
