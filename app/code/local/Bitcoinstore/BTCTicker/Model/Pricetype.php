<?php
class Bitcoinstore_BTCTicker_Model_Pricetype
{
    public function toOptionArray()
    {
        return array(
            array('value'=>1, 'label'=>Mage::helper('btcticker')->__('Daily High')),
            array('value'=>2, 'label'=>Mage::helper('btcticker')->__('Daily Low')),
            array('value'=>3, 'label'=>Mage::helper('btcticker')->__('Average')),            
        );
    }

}