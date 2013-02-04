<?php
class Bitcoinstore_BTCTicker_Model_Update extends Mage_Core_Model_Abstract
{

  public function getBitPayAverage()
  {
    $URL = "https://bitpay.com/api/rates";
    
    // Initialize session and set URL.
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $URL);

    // Set so curl_exec returns the result instead of outputting it.
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    // Get the response and close the channel.
    $json = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);

    $data = json_decode($json);
    if($data)
    {
      $current_price = (double)$data[0]->rate;
      Mage::getModel('core/config')->saveConfig('btcticker/main/current_bitpay_price', $current_price);
      return $current_price;
    }
    else {
      Mage::log('Curl Error ' . $error . ' BitPay returned "' . $json . '"', null, 'btcticker.log');
      Mage::logException('Failed to retrieve BitPay data.');
      throw new Exception('Failed to retrieve BitPay data.');
      return false;
    }
  }

  public function getMtGoxAverage()
  {
    $URL = "https://mtgox.com/api/1/BTCUSD/ticker";
    
    // Initialize session and set URL.
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $URL);

    // Set so curl_exec returns the result instead of outputting it.
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    // Get the response and close the channel.
    $json = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);

    $data = json_decode($json);
    if($data)
    {
      $current_price = (double)$data->return->last_local->value;
      Mage::getModel('core/config')->saveConfig('btcticker/main/current_mtgox_price', $current_price);
      return $current_price;
    }
    else {
      Mage::log('Curl Error ' . $error . ' MtGox returned "' . $json . '"', null, 'btcticker.log');
      Mage::logException('Failed to retrieve MtGox data.');
      throw new Exception('Failed to retrieve MTGox data.');
      return false;
    }
  }
}