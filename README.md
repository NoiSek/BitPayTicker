BitPayTicker
=====
A magento extension for getting the current price of Bitcoins every five minutes from Bitpay and Magento using cron. Originally created for Bitcoinstore.com.

### Installation
- Move this into the root of your Magento directory. Overwrite, as necessary.
- Make sure your crontab is setup to run cron.php. This file is located in the root your Magento directory. For more info on this, see [this link](https://support.sweettoothrewards.com/entries/21196536-setting-up-cron-jobs-in-magento).

### Requirements
You may need all of these, and you may need none of these depending on what came installed with your OS. Install all of them to cover your bases.

- php5-curl
- libcurl3-dev
- libcurl3
- curl

### Usage

Once initiated, grab the price from anywhere in your codebase using this: 

    // Bitpay
    $bitpay_current = Mage::getStoreConfig('btcticker/main/current_bitpay_price');
    
    // MtGox
    $mtgox_current = Mage::getStoreConfig('btcticker/main/current_mtgox_price');

Update instantly by opening http://yoursite.com/cron.php in your browser

### Changelog
## 2.3
- First update! 
- MtGox now supported
- User agent supplied with cURL to prevent timeout errors.
- Cron timing changed to 1 minute updates
- Jobs renamed to prevent conflicts

## 1.1
- Creation of the repo. Bitpay supported, all is well with the world.