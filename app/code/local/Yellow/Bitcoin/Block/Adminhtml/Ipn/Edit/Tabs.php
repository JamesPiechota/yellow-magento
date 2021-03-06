<?php

class Yellow_Bitcoin_Block_Adminhtml_Ipn_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId("ipn_tabs");
        $this->setDestElementId("edit_form");
        $this->setTitle(Mage::helper("bitcoin")->__("Item Information"));
    }

    protected function _beforeToHtml()
    {
        $this->addTab("form_section", array(
            "label" => Mage::helper("bitcoin")->__("Item Information"),
            "title" => Mage::helper("bitcoin")->__("Item Information"),
            "content" => $this->getLayout()->createBlock("bitcoin/adminhtml_ipn_edit_tab_form")->toHtml(),
        ));
        return parent::_beforeToHtml();
    }

}
