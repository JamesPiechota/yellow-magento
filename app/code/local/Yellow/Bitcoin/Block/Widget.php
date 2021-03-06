<?php

/**
 *
 * The MIT License (MIT)
 *
 * Copyright (c) 2014 YellowPay.co
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 **/
class Yellow_Bitcoin_Block_Widget extends Mage_Checkout_Block_Onepage_Payment
{

    /**
     * a copy value from server root from bitcoin.php model
     * just as read only
     * @var
     */
    protected $server_root ;


    /**
     * constructor method
     **/
    protected function _construct()
    {
        $this->setTemplate('bitcoin/widget.phtml');
        parent::_construct();
    }

    /**
     * @return string
     */
    public function GetQuoteId()
    {
        $quote = $this->getQuote();
        $quoteId = $quote->getId();

        return $quoteId;
    }

    /**
     * create an invoice and return the url so that widget.phtml can display it
     *
     * @return string
     */
    public function GetWidgetUrl()
    {
        if (!($quote = Mage::getSingleton('checkout/session')->getQuote())
            or !($payment = $quote->getPayment())
            or !($instance = $payment->getMethodInstance())
            or ($instance->getCode() != 'bitcoin')
        ) {
            return 'no payment';
        }
        if (Mage::getStoreConfig('payment/bitcoin/fullscreen')) {
            return 'disabled';
        }
        $quote = $this->getQuote();
        $payment = $quote->getPayment()->getMethodInstance();
        $invoice = $payment->createInvoice($quote);
        $this->server_root = $instance->getConfiguredServerRoot();
        return $invoice['url'];
    }

    /***
     * return the configured server root
     * @return string
     */
    public function getConfiguredServerRoot()
    {
        return $this->server_root;
    }
}
