<?php
namespace WebShopApps\MatrixRate\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    protected $matrixrateResource;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \WebShopApps\MatrixRate\Model\ResourceModel\Carrier\Matrixrate $matrixrateResource
    ) {
        $this->matrixrateResource = $matrixrateResource;
        parent::__construct($context);
    }

    public function getAvailability($pincode)
    {
        $adapter = $this->matrixrateResource->getConnection();
        $postcode = trim($pincode);
        $select = $adapter->select()->from(
            $this->matrixrateResource->getMainTable()
        )->where(
            'website_id = :website_id'
        );
        $select->where('dest_zip <= :postcode');
        $select->where('dest_zip_to >= :postcode');
        $bind = [
            ':website_id' => 1,
            ':country_id' => 'IN',
            ':postcode' => (int)$postcode,
        ];
        $results = $adapter->fetchAll($select, $bind);
        return $results;
    }
}
