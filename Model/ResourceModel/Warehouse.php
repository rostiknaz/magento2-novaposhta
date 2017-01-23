<?php
/**
 * Created by PhpStorm.
 * User: naro
 * Date: 1/23/17
 * Time: 4:31 PM
 */

namespace Rostiknaz\NovaPoshta\Model\ResourceModel;


class Warehouse extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('novaposhta_warehouse', 'id');
    }
}