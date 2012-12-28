<?php
class Bitcoinstore_BTCTicker_Model_Update extends Mage_Core_Model_Abstract
{
  public function getMtGoxAverage()
  {
    $URL = "https://bitpay.com/api/rates";
    
    // Initialize session and set URL.
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $URL);

    // Set so curl_exec returns the result instead of outputting it.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    // Get the response and close the channel.
    $json = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($json);
    if($data)
    {
      $current_price = $data[0]->rate;
      Mage::getModel('core/config')->saveConfig('btcticker/main/current_btc_price', $current_price);
      return $current_price;
    }
    else {
      Mage::log('ERROR: MtGox returned ' . $json);
      Mage::logException('Failed to retrieve MtGox data.');
      throw new Exception('Failed to retrieve MTGox data.');
      return false;
    }
  }
}