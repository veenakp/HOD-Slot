<?php

namespace HOD\Slot\Cron;

class Test
{
    public function execute()
    {
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/c.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        $logger->info('hii');
        return $this;
    }
}