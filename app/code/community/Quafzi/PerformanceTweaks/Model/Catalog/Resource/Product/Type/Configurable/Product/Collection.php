<?php
/**
 * see http://de.slideshare.net/ivanchepurnyi/magento-performance
 *
 * refers to Catalog
 *
 * Magento is not using flat version of products for configurable products children retrieval.
 * So every configurable product page is a bottleneck.
 *
 * PHP version 5
 *
 * @category Mage
 * @package  Quafzi_PerformanceTweaks
 * @author   Thomas Birke <tbirke@netextreme.de>
 * @license  MIT http://opensource.org/licenses/MIT
 */

/**
 * Quafzi_PerformanceTweaks_Model_Eav_Entity_Attribute_Source_Table
 *
 * @category Mage
 * @package  Quafzi_PerformanceTweaks
 * @author   Thomas Birke <tbirke@netextreme.de>
 * @license  MIT http://opensource.org/licenses/MIT
 */
class Quafzi_PerformanceTweaks_Model_Catalog_Resource_Product_Type_Configurable_Product_Collection
    extends Mage_Catalog_Model_Resource_Product_Type_Configurable_Product_Collection
{
    /**
     * if flate catalog is enabled
     *
     * @return boolean
     */
    public function isEnabledFlat()
    {
        return Mage_Catalog_Model_Resource_Product_Collection::isEnabledFlat();
    }

    /**
     * fix addAttributeToFilter
     *
     * @param string $attribute Attribute code
     * @param mixed  $condition Condition
     * @param string $joinType  Join type
     */
    public function addAttributeToFilter($attribute, $condition = null, $joinType = 'inner')
    {
        if ($this->isEnabledFlat() && is_numeric($attribute)) {
            $attribute = $this->getEntity()->getAttribute($attribute)->getAttributeCode();
        }

        return parent::addAttributeToFilter($attribute, $condition, $joinType);
    }
}
