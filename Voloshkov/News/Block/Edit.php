<?php
namespace Voloshkov\News\Block;
use Magento\Framework\Controller\ResultFactory;

class Edit extends \Magento\Framework\View\Element\Template
{

    public function getSaveUrl()
    {
        return $this->_urlBuilder->getUrl(
            'news/novyna/save',
            []
        );

    }

    public function getEditUrl()
    {

        $model = $this->getData('novyna');

        return $this->_urlBuilder->getUrl(
            'news/novyna/edit',
            ['id' => $model->getId()]
        );

    }

    public function getViewUrl($id)
    {
        return $this->_urlBuilder->getUrl(
            'news/novyna/view',
            ['id' => $id]
        );

    }

}

