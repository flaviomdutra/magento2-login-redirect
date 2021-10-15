<?php

/**
 * @author Flávop Dutra - flaviomdutra@outl0ok.com
 * @copyright Copyright (c) 2021 Flávio DUtra (https://github.com/flaviomdutra)
 * @package Dutra_RedirectCheckout
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 * 1. Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY FLAVIO DUTRA (https://github.com/flaviomdutra). 
 * AND CONTRIBUTORS``AS IS'' AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, 
 * BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS 
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED.  IN NO EVENT SHALL THE FOUNDATION 
 * OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, 
 * EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, 
 * PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; 
 * OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, 
 * WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR 
 * OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF 
 * ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

namespace Dutra\RedirectCheckout\Plugin;

class LoginRedirection
{

    protected $_storeManager;
    protected $_customerSession;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Customer\Model\Session $customerSession
    ) {
        $this->_storeManager = $storeManager;
        $this->_customerSession = $customerSession;
    }
    public function afterLoadCustomerQuote(
        \Magento\Checkout\Model\Session $_subject,
        $result
    ) {
        $_quote = $_subject->getQuote();
        if (count($_quote->getAllItems()) > 0) {
            $this->_customerSession
                ->setBeforeAuthUrl($this->_storeManager->getStore()->getUrl('checkout/cart'));
        }
    }
}
