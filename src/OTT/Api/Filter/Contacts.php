<?php

namespace OTT\Api\Filter;

/**
 * Class Contacts
 * @package OTT\Api\Filter
 * @url : http://developer.axosoft.com/api/contacts.html#!/contacts/
 */
class Contacts extends FilterAbstract
{
    /** @var int */
    private $id = null;
    /** @var string */
    private $search_string = null;
    /** @var string */
    private $search_field = null;
    /** @var int */
    private $customer_id = null;
    /** @var int */
    private $page_size = null;
    /** @var int */
    private $page = null;
    /** @var string */
    private $sort_fields = null;
    /** @var string */
    private $columns = null;
    /** @var string */
    private $group_field = null;
    /** @var string */
    private $extend = null;

    /**
     * @return string
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @param string $columns
     */
    public function setColumns($columns)
    {
        $this->columns = $columns;
    }

    /**
     * @return int
     */
    public function getCustomerId()
    {
        return $this->customer_id;
    }

    /**
     * @param int $customer_id
     */
    public function setCustomerId($customer_id)
    {
        $this->customer_id = $customer_id;
    }

    /**
     * @return string
     */
    public function getExtend()
    {
        return $this->extend;
    }

    /**
     * @param string $extend
     */
    public function setExtend($extend)
    {
        $extends = ['custom_fields'];
        if (!in_array($extend, $extends)) {
            $extend = null;
        }
        $this->extend = $extend;
    }

    /**
     * @return string
     */
    public function getGroupField()
    {
        return $this->group_field;
    }

    /**
     * @param string $group_field
     */
    public function setGroupField($group_field)
    {
        $this->group_field = $group_field;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getPageSize()
    {
        return $this->page_size;
    }

    /**
     * @param int $page_size
     */
    public function setPageSize($page_size)
    {
        $this->page_size = $page_size;
    }

    /**
     * @return string
     */
    public function getSearchField()
    {
        return $this->search_field;
    }

    /**
     * @param string $search_field
     */
    public function setSearchField($search_field)
    {
        $this->search_field = $search_field;
    }

    /**
     * @return string
     */
    public function getSearchString()
    {
        return $this->search_string;
    }

    /**
     * @param string $search_string
     */
    public function setSearchString($search_string)
    {
        $this->search_string = $search_string;
    }

    /**
     * @return string
     */
    public function getSortFields()
    {
        return $this->sort_fields;
    }

    /**
     * @param string $sort_fields
     */
    public function setSortFields($sort_fields)
    {
        $this->sort_fields = $sort_fields;
    }
}
