<?php

namespace Voloshkov\News\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class NewsResource extends AbstractDb
{

    protected function _construct()
    {
        $this->_init('news', 'news_id');
    }
}
