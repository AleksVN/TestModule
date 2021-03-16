<?php

namespace Voloshkov\News\Model\ResourceModel\Col;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Voloshkov\News\Model\NewsModel;
use Voloshkov\News\Model\ResourceModel\NewsResource;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init(NewsModel::class, NewsResource::class);
    }

    public function sort($porydok)
    {
        if (!$porydok) {
            $porydok = 'asc';
        }
        $this->setOrder('updated_at', $porydok);

        return $this;
    }
}
