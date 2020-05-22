<?php

namespace App\Services\Pay;

use App\Services\Service;
use Yansongda\Pay\Gateways\Alipay;
use Yansongda\Pay\Pay;

class AlipayGateway extends Service
{

    /**
     * @var array
     */
    protected $settings;

    public function __construct($options = [])
    {
        $defaults = $this->getSectionSettings('pay.alipay');

        $this->settings = array_merge($defaults, $options);
    }

    public function getSettings()
    {
        return $this->settings;
    }

    public function setReturnUrl($returnUrl)
    {
        $this->settings['return_url'] = $returnUrl;
    }

    public function setNotifyUrl($notifyUrl)
    {
        $this->settings['notify_url'] = $notifyUrl;
    }

    /**
     * @return Alipay
     */
    public function getInstance()
    {
        $config = $this->getDI()->get('config');

        $level = $config->env == ENV_DEV ? 'debug' : 'info';

        $payConfig = [
            'app_id' => $this->settings['app_id'],
            'ali_public_key' => $this->settings['public_key'],
            'private_key' => $this->settings['private_key'],
            'return_url' => $this->settings['return_url'],
            'notify_url' => $this->settings['notify_url'],
            'log' => [
                'file' => log_path('alipay.log'),
                'level' => $level,
                'type' => 'daily',
                'max_file' => 30,
            ],
        ];

        if ($config->env == ENV_DEV) {
            $payConfig['mode'] = 'dev';
        }

        return Pay::alipay($payConfig);
    }

}