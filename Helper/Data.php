<?php
namespace Ranium\SlackNotification\Helper;
use \Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{   
    protected $_deploymentConfig;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\App\DeploymentConfig $deploymentConfig
    ) {
            parent::__construct($context);
            $this->_deploymentConfig = $deploymentConfig;       
    }

    public function getErrorLevelColor($level_name = null)
    {
        $getColor = array('info' => "#00ffcc",
                    'warning' => "#ffff99",
                    'success' => "#66ff66",
                    'danger' => "#ff4d4d" );

        return array_key_exists($level_name,$getColor) ? $getColor[$level_name] : $getColor["info"];
    }

    public function sendError($title=null, $error=null, $log_level=null)
    {      
        // PREAPRE HEADERS
        $httpHeaders = new \Zend\Http\Headers();
        $httpHeaders->addHeaders([
           'Content-Type' => 'application/json',
        ]);
        
        // PREAPARE HTTP REQUEST
        $request = new \Zend\Http\Request();
        $request->setHeaders($httpHeaders);
        $slack_token = $this->_deploymentConfig->get('slack/token');
        $slack_channel = $this->_deploymentConfig->get('slack/channel');

        if(is_null($slack_token) || is_null($slack_channel))
        {
            return null;
        }
        $logcolor = $this->getErrorLevelColor($level_name=$log_level);

        $attachments = array('color' => $logcolor,
                             'pretext' => "*".(string)$title."*",
                             'text' => "```".(string)$error."```",
                             'mrkdwn_in'=> ['text','pretext']);

        $request->setUri('https://hooks.slack.com/services/T04K0GJSL/'.(string)$slack_channel.'/'.(string)$slack_token);

        $request->setMethod(\Zend\Http\Request::METHOD_POST);

        // LOAD DATA
        $data = array('text' => '*Error in Magento :scream: *',
                        'mrkdwn' => True ,
                        'attachments' => array($attachments)
                    );

        $request->setContent(json_encode($data));
       
        $client = new \Zend\Http\Client();
                   
        $response = $client->send($request);

        return null;
    }
}
