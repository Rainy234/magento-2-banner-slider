<?php
/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://www.mageplaza.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Mageplaza
 * @package     Mageplaza_BannerSlider
 * @copyright   Copyright (c) Mageplaza (https://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */
namespace Mageplaza\BannerSlider\Controller\Adminhtml\Slider;

use Mageplaza\BannerSlider\Controller\Adminhtml\Slider;
use Magento\Framework\View\Result\LayoutFactory;
use Mageplaza\BannerSlider\Model\SliderFactory;
use Magento\Framework\Registry;
use Magento\Backend\App\Action\Context;

class Banners extends Slider
{
    /**
     * Result layout factory
     * 
     * @var \Magento\Framework\View\Result\LayoutFactory
     */
    protected $resultLayoutFactory;

    /**
     * Banners constructor.
     *
     * @param LayoutFactory $resultLayoutFactory
     * @param SliderFactory $bannerFactory
     * @param Registry $registry
     * @param Context $context
     */
    public function __construct(
        LayoutFactory $resultLayoutFactory,
        SliderFactory $bannerFactory,
        Registry $registry,
        Context $context
    )
    {
        $this->resultLayoutFactory = $resultLayoutFactory;
        parent::__construct($bannerFactory, $registry, $context);
    }

    /**
     * @return \Magento\Framework\View\Result\Layout
     */
    public function execute()
    {
        $this->initSlider();
        $resultLayout = $this->resultLayoutFactory->create();
        /** @var \Mageplaza\BannerSlider\Block\Adminhtml\Slider\Edit\Tab\Banner $bannersBlock */
        $bannersBlock = $resultLayout->getLayout()->getBlock('slider.edit.tab.banner');
        if ($bannersBlock) {
            $bannersBlock->setSliderBanners($this->getRequest()->getPost('slider_banners', null));
        }
        return $resultLayout;
    }
}
