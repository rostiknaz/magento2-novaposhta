<?php
/**
 * Created by PhpStorm.
 * User: naro
 * Date: 1/23/17
 * Time: 4:28 PM
 */

namespace Rostiknaz\NovaPoshta\Model;


class City extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'novaposhta_city';

    protected function _construct()
    {
        $this->_init(ResourceModel\City::class);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}