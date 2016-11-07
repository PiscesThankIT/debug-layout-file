<?php
namespace ThankIT\DevTool\Observer;

use Magento\Framework\Event\ObserverInterface;

class Layout  implements ObserverInterface
{
    protected $_logger;
    
    public function __construct(\Psr\Log\LoggerInterface $logger)
    {
        $this->_logger = $logger;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {

        $xml = $observer->getEvent()->getLayout()->getXmlString();
        // $this->_logger->debug($xml);   //*If you use it, check ouput string xml in var/log/debug.log
        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/layout_block.xml');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info($xml);
        return $this;
    }
}