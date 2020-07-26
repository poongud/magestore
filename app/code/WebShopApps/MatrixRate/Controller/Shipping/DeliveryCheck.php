<?php
namespace WebShopApps\MatrixRate\Controller\Shipping;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Context;
use WebShopApps\MatrixRate\Helper\Data;

class DeliveryCheck extends \Magento\Framework\App\Action\Action
{
    protected $helperData;

    public function __construct(
        Context $context,
        Data $helperdata
    ) {
        $this->helperData = $helperdata;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $translateData = (array)$this->getRequest()->getPost();
        if ($this->getRequest()->isPost()) {

            if (isset($translateData['pincode'])) {

                $result  = $this->helperData->getAvailability($translateData['pincode']);
                if (empty($result)) {
                    $status = false;
                    $message = "Delivery location is not available for this pincode.";
                } else {
                    $status = true;
                    $message = "Delivery location is available for this pincode.";
                }
                $response['pincode'] = $translateData['pincode'];
            } else {
                $status = false;
                $message = "Invalid request params.";
            }
        } else {
            $status = false;
            $message = "Invalid request.";
        }
        /* Create array for return value */
        $response['status'] = $status;
        $response['message'] = $message;
        return $resultJson->setData($response);
    }
}
