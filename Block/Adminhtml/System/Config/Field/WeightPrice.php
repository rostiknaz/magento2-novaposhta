<?php
/**
 * WeightPrice field block.
 *
 * @category   Rostiknaz
 * @package    Rostiknaz_NovaPoshta
 * @author     Nazymko Rostyslav
 */

namespace Rostiknaz\NovaPoshta\Block\Adminhtml\System\Config\Field;


class WeightPrice extends \Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray
{
    /**
     * @var \Magento\Framework\Data\Form\Element\Factory
     */
    protected $_elementFactory;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Data\Form\Element\Factory $elementFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Data\Form\Element\Factory $elementFactory,
        array $data = []
    )
    {
        $this->_elementFactory  = $elementFactory;
        parent::__construct($context,$data);
    }

    protected function _construct()
    {
        $this->addColumn('weight',
            [
                'label' => __('Weight upper limit'),
                'style' => 'width:120px',
            ]
        );
        $this->addColumn('price',
            [
                'label' => __('Price'),
                'style' => 'width:120px',
            ]
        );
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add rate');
        parent::_construct();
    }
}