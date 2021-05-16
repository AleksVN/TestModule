<?php

namespace Voloshkov\News\Model;

use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Voloshkov\News\Model\ResourceModel\NewsResource;

class NewsModel extends AbstractModel
{
   public $_idFieldName = 'news_id';

    protected function _construct()
    {
        $this->_init(NewsResource::class);
    }
}
