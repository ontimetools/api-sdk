<?php

namespace OTT\Api\Filter;

/**
 * Class Filters
 * @package OTT\Api\Filter
 * @url : http://developer.axosoft.com/api/filters.html#!/filters/
 */
class Filters extends FilterAbstract
{
    /** @var int */
    private $item_type = null;
    private $allowed_types = ['defects', 'features', 'tasks', 'incidents'];

    /**
     * @return int
     */
    public function getItemType()
    {
        return $this->item_type;
    }

    /**
     * @param int $item_type
     */
    public function setItemType($item_type)
    {
        if (in_array($item_type, $this->getAllowedTypes())) {
            $this->item_type = $item_type;
        }
    }

    /**
     * @return array
     */
    private function getAllowedTypes()
    {
        return $this->allowed_types;
    }
}
