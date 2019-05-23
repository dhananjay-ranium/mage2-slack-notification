<?php
namespace Eve\SlackNotification\Controller\Index;
use \Eve\SlackNotification\Helper\Data;
use \Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;


class Test extends Action
{
    
    protected $_helper;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
         \Eve\SlackNotification\Helper\Data $helper
    ) {
        $this->_helper = $helper;       
        return parent::__construct($context);
    }

    public function execute()
    {
        $this->_helper->sendError($title="This is sample title",$error="This is sample error",$log_level="success");
    }
}