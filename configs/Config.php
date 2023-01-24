<?php

//namespace Ross\SlimApi\Config;

class Config
{

    public array $settings=[];

    public function __construct(array $env)
    {
        $this->settings = [
          'url' => $env['DATABASE_URL'],
        ];
    }


}