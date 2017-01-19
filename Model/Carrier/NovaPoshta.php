<?php
/**
 * Created by PhpStorm.
 * User: naro
 * Date: 1/19/17
 * Time: 2:55 PM
 */

namespace Rostiknaz\NovaPoshta\Model\Carrier;

use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Shipping\Model\Rate\Result;

class NovaPoshta extends \Magento\Shipping\Model\Carrier\AbstractCarrier
    implements \Magento\Shipping\Model\Carrier\CarrierInterface
{
    /**
     * @var string Carrier code.
     */
    protected $_code = 'novaposhta';

    //после подключения синхронизации с API эти свойства будут удалены
    protected $_shippingPrice = 10.00;
    protected $_werehouseId = 1;
    protected $_werehouseName = 'Склад №1';

    /**
     * Constructor.
     *
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory
     * @param \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory,
        \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory,
        array $data = []
    ) {
        $this->_rateResultFactory = $rateResultFactory;
        $this->_rateMethodFactory = $rateMethodFactory;
        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data);
    }

    /**
     * Returns an array of allowed shipping methods.
     *
     * @return array
     */
    public function getAllowedMethods()
    {
        return ['werehouse_' . $this->_werehouseId => $this->_werehouseName];
    }

    /**
     * Adds a new shipping method to the cart and checkout and shipping price calculation.
     * 
     * @param RateRequest $request Contains all information about items in cart/quote.
     *
     * @return Result $result Object that contains all shipping methods.
     */
    public function collectRates(RateRequest $request)
    {
        if (!$this->getConfigFlag('active')) {
            return false;
        }

        /** @var \Magento\Shipping\Model\Rate\Result $result */
        $result = $this->_rateResultFactory->create();

        /** @var \Magento\Quote\Model\Quote\Address\RateResult\Method $method */
        $method = $this->_rateMethodFactory->create();

        $shippingPrice = 10.00; // dummy price
        $warehouseId = 1; // dummy warehouse ID
        $warehouseName = 'Склад №1'; // dummy warehouse name

        $method->setCarrier($this->_code)
            ->setCarrierTitle($this->getConfigData('title'))
            ->setMethod('werehouse_' . $warehouseId)
            ->setMethodTitle($warehouseName)
            ->setPrice($shippingPrice)
            ->setCost($shippingPrice);

        /*you can fetch shipping price from different sources over some APIs, we used price from config.xml - xml node price*/
//        $amount = $this->getConfigData('price');

//        $method->setPrice($shippingPrice);
//        $method->setCost($shippingPrice);

        $result->append($method);

        return $result;
    }

    /**
     * Check if carrier has shipping tracking option available
     *
     * @return bool
     */
    public function isTrackingAvailable()
    {
        return true;
    }
}