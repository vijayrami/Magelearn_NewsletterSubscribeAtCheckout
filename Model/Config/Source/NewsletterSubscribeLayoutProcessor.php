<?php

namespace Magelearn\NewsletterSubscribeAtCheckout\Model\Config\Source;

use Magelearn\NewsletterSubscribeAtCheckout\Helper\Data as Helper;

/**
 * Class NewsletterSubscribeLayoutProcessor
 * @package Magelearn\NewsletterSubscribeAtCheckout\Model\Config\Source
 */
class NewsletterSubscribeLayoutProcessor
{
    /**
     * @var Helper
     */
    private $helper;

    /**
     * NewsletterSubscribeLayoutProcessor constructor.
     * @param Helper $helper
     */
    public function __construct(
        Helper $helper
    ) {
        $this->helper = $helper;
    }

    /**
     * {@inheritdoc}
     */
    public function process($jsLayout)
    {
        $enabled = ($this->helper->getConfig('enabled')) ? 1 : 0;
        $checked = ($this->helper->getConfig('checked')) ? 1 : 0;
        $label = $this->helper->getConfig('label');
        $note_enabled = ($this->helper->getConfig('note_enabled')) ? 1 : 0;
        $note = $this->helper->getConfig('note');

        $config = [
            'customer-email' => [
                'children' => [
                    'newsletter_subscribe' => [
                        'config' => [
                            'enabled' => $enabled,
                            'checked' => $checked,
                            'label' => $label,
                            'note_enabled' => $note_enabled,
                            'note' => $note
                        ]
                    ]
                ]
            ]
        ];

        $updateLayout = [
            'components' => [
                'checkout' => [
                    'children' => [
                        'steps' => [
                            'children' => [
                                'billing-step' => [
                                    'children' => [
                                        'payment' => [
                                            'children' => $config
                                        ]
                                    ]
                                ],
                                'shipping-step' => [
                                    'children' => [
                                        'shippingAddress' => [
                                            'children' => $config
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        // Merge updated layout with existing one
        return array_merge_recursive($jsLayout, $updateLayout);
    }
}
