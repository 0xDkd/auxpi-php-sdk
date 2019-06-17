<?php
/**
 * Copyright (c) 2019. aimerforreimu
 * repo: https://github.com/aimerforreimu/auxpi
 */

namespace Aimer\Auxpi;

use GuzzleHttp\Client;
use Hanson\Foundation\AbstractAPI;


/**
 * Class Api
 * @package Aimer\Auxpi
 */
class Api extends AbstractAPI
{

    /**
     * @var
     */
    protected $token;

    /**
     * @var array
     */
    protected $guzzleOptions = [];

    /**
     * @var string
     */
    protected $url;

    /**
     * @var array
     */
    protected $select = [];


    /**
     * Api constructor.
     * @param $url
     * @param $token
     */
    public function __construct($url, $token)
    {
        $this->url = $url;
        $this->token = $token;
        $this->select = [
            'sougou',
            'sina',
            'smms',
            'cc',
            'flickr',
            'imgur',
            'prnt',
            'neteasy',
            'jd',
            'juejin',
            'ali',
            'local',
            'suning',
            'xiaomi',
            'vim',
            'ooxx',
            'souhu',
            'github',
            'toutiao',
            'gitee',
        ];
    }

    /**
     * @desc
     * @return Client
     */
    public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }

    /**
     * @desc
     * @param array $options
     */
    public function setGuzzleOptions(array $options)
    {
        $this->guzzleOptions = $options;
    }


    /**
     * @desc
     * @param $endpoint
     * @param array $params
     * @return mixed
     * @throws \ErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function uploadFile($endpoint, array $params)
    {
        $file = fopen($params['file_path'], 'r');
        if (!$file) {
            throw new \ErrorException("Can Not find file in " . $params['file_path']);
        }

        $config = [
            'multipart' => [
                [
                    'name'     => 'apiSelect',
                    'contents' => $params['api_select']
                ],
                [
                    'name'     => 'image',
                    'contents' => fopen($params['file_path'], 'r'),
                    'filename' => $params['file_name'],
                ]
            ],
            'headers'   => [
                'Authorization' => $this->token,
            ]
        ];

        $http = $this->getHttpClient();

        $response = $http->request('POST', $this->url . $endpoint, $config);


        $result = json_decode(strval($response->getBody()), true);

        return $result;

    }


    /**
     * @desc
     * @param $select
     * @param $path
     * @return mixed
     * @throws \ErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function uploadImageV1($select, $path)
    {
        $endpoint = 'v1/upload';
        if (!in_array($select, $this->select)) {
            throw new \ErrorException('CAN NOT FIND THIS API');
        }
        $options = [
            'api_select' => $select,
            'file_path'  => $path,
            'file_name'  => '123.png'
        ];
        return $this->uploadFile($endpoint, $options);
    }


    /**
     * @desc
     * @param $path
     * @return mixed
     * @throws \ErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function uploadImageV2($path)
    {
        $endpoint = 'v2/upload';

        $options = [
            'api_select' => '',
            'file_path'  => $path,
            'file_name'  => '123.png'
        ];
        return $this->uploadFile($endpoint, $options);
    }

}