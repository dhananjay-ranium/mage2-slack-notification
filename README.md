# Mage2-slack-notification
A simple Slack-Magento2 notification library, aim to send basic notification to your Slack channel by using Slack's webhook url.
### Developed By :computer:
[![N|Ranium](https://d1vxlv5w7jsf3o.cloudfront.net/wp-content/uploads/2018/10/24121043/ranium-logo-black.png)](https://ranium.in/)
##
Register or Login(if you alreday have slack account) to you workspace on [Slack]
Here's how you can grab your webhook url - https://api.slack.com/incoming-webhooks

# Install
```sh
 
Head to your project's app/code and create folder `Ranium`
 
Clone this repo - git clone https://github.com/dhananjay-ranium/mage2-slack-notification.git

Paste repo in Ranium folder. 

```
# Features
- Supports multi-line notification
- notification status code (success,info,warning,danger)
- `More to come` like workspace integration, send to multiple channels etc

# Example
Following is the sample example to send notification from Controller, same can be used in other files.  

```php

<?php

use \Ranium\SlackNotification\Helper\Data;
use \Magento\Framework\App\Action\Action;

class Test extends Action
{
    protected $_helper;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
         \Ranium\SlackNotification\Helper\Data $helper
    ) {
        $this->_helper = $helper;       
        return parent::__construct($context);
    }

    public function execute()
    {
        $this->_helper->sendError($title="This is sample title",$error="This is sample error",$log_level="success");
        /*
          $log_level = "success" (Optional other parameters are success(default), info, warning & danger)
        */
    }
}
```
# Contributing
If you have any issue or idea which you want to share, [please open an issue].
If you'd like to contribute, please fork the repository. Pull requests are warmly welcome.

# License
MIT

   [Register]: <https://slack.com/signin>
   [Login]: <https://slack.com/signin>
   [please open an issue]: <https://github.com/dhananjay-ranium/mage2-slack-notification/issues>
