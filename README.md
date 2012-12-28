BitPayTicker
=====
A magento extension for getting the current price of Bitcoins every five minutes from Bitpay using cron. Originally created for Bitcoinstore.com.

### Installation
- Move this into your app/code/local folder within your magento install.
- Make sure your crontab is setup to run cron.php. This file is located in your root Magento directory. For more info on this, see [this link](https://support.sweettoothrewards.com/entries/21196536-setting-up-cron-jobs-in-magento).

### Usage

Once initiated, grab the price from anywhere in your codebase using something similar to 

    $current_BTC_price = Mage::getStoreConfig('Bitcoinstore/BTCTicker/current_BTC_price');

Update instantly by opening http://yoursite.com/cron.php in your browser