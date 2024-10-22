<?php

class Magenteiro_Integration_Model_Cron
{
    public function integrate()
    {
        $orders = Mage::getModel('magenteiro_integration/queue')->getCollection()
            //Foi feito um array('null' => true)), por conta do MYSQL não aceita o '000-00-00 00:00:00'.
            ->addFieldToFilter('integrated_at', array('null' => true))
            ->getItems();

        /** @var Magenteiro_Integration_Model_Queue $queue */
        foreach($orders as $queue){
            $order = unserialize($queue->getContent());
            Mage::log('Pedido integrado: '. $order['increment_id'], null, 'integration.log', true);
            $queue->setIntegratedAt(date('Y-m-d H:i:s'));
            $queue->setDebugInfo('Registro integrado');
            $queue->save();
        }
    }
}