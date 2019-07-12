<?php

namespace RookieSoft\CustomerTags\Block\Adminhtml\Tags\Edit;

/**
 * Adminhtml Add New Row Form.
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry             $registry
     * @param \Magento\Framework\Data\FormFactory     $formFactory
     * @param array                                   $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \RookieSoft\CustomerTags\Model\Status $options,
        \RookieSoft\CustomerTags\Model\ResourceModel\Tag\CollectionFactory $tagCollectionFactory,
        array $data = []
    ) {
        $this->tagCollectionFactory = $tagCollectionFactory;
        $this->_options = $options;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form.
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $model = $this->_coreRegistry->registry('row_data');
        $form = $this->_formFactory->create(
            ['data' => [
                            'id' => 'edit_form',
                            'enctype' => 'multipart/form-data',
                            'action' => $this->getData('action'),
                            'method' => 'post'
                        ]
            ]
        );

        $form->setHtmlIdPrefix('astags_');

        if ($model->getId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Edit Row Data'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add Row Data'), 'class' => 'fieldset-wide']
            );
        }

        $tags = $this->tagCollectionFactory->create()
            ->addFieldToFilter('code', $model->getCode())
            ->load();

        // foreach($tags as $tag) {
        //     $tagToArray =     $tag->getTagCode();
        //     $tagToCategoryCollection  = $this->tagCategoryTagCollectionFactory->create()
        //             ->addFieldToFilter('tag_code', $tagToArray)
        //             ->load();
            // $categories = [];
            // $categoryIds = [];

            // foreach($tagToCategoryCollection as $tagToCategory) {
            //     $categoryCollection = $this->tagCategoryCollectionFactory->create()
            //         ->addFieldToFilter('code', $tagToCategory->getCategoryCode())
            //         ->load();

            //     foreach($categoryCollection as $category) {
            //         $categories[] = $category->getLabel();
            //         $categoryIds[] = $category->getId();
            //     }
            // }
        // }

        $fieldset->addField(
            'code',
            'text',
            [
                'name'      => 'code',
                'label'     => __('Tag Code'),
                'id'        => 'code',
                'title'     => __('Tag Code'),
                'class'     => 'required-entry',
                'required'  => true,
                'disabled' => ($model->getId() ? true : false),
            ]
        );

        $fieldset->addField(
            'label',
            'text',
            [
                'name'      => 'label',
                'label'     => __('Tag'),
                'id'        => 'label',
                'title'     => __('Tag'),
                'class'     => 'required-entry',
                'required'  => true,
            ]
        );

        $fieldset->addField(
            'description',
            'text',
            [
                'name'  => 'description',
                'label' => __('Description'),
                'id'    => 'description',
                'title' => __('Description'),
            ]
        );
        $fieldset->addField(
            'state',
            'select',
            [
                'name'      => 'state',
                'label'     => __('Status'),
                'id'        => 'state',
                'title'     => __('Status'),
                'values'    => $this->_options->getOptionArray(),
                'class'     => 'status',
                'required'  => true,
            ]
        ); 

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }


}
