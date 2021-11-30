<?php

namespace Magelearn\NewsletterSubscribeAtCheckout\Helper;

/**
 * Class Data
 * @package Magelearn\NewsletterSubscribeAtCheckout\Helper
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var string
     */
    private $tab = 'checkout';

    /**
     * Get module configuration values from core_config_data
     *
     * @param $setting
     * @return mixed
     */
    public function getConfig($setting)
    {
        return $this->scopeConfig->getValue(
            $this->tab . '/magelearn_newslettersubscribeatcheckout/' . $setting,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
