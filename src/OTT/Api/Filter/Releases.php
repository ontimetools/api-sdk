<?php

namespace OTT\Api\Filter;

/**
 * Class Releases
 * @package OTT\Api\Filter
 * @url : http://developer.axosoft.com/api/releases.html#!/releases/
 */
class Releases extends FilterAbstract
{
    /** @var int */
    private $id = null;
    /** @var int */
    private $filter_by_project_id = null;
    /** @var bool */
    private $display_inactive = false;

    /**
     * @return boolean
     */
    public function isDisplayInactive()
    {
        return $this->display_inactive;
    }

    /**
     * @param boolean $display_inactive
     */
    public function setDisplayInactive($display_inactive)
    {
        $this->display_inactive = $display_inactive;
    }

    /**
     * @return int
     */
    public function getFilterByProjectId()
    {
        return $this->filter_by_project_id;
    }

    /**
     * @param int $filter_by_project_id
     */
    public function setFilterByProjectId($filter_by_project_id)
    {
        $this->filter_by_project_id = $filter_by_project_id;
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
}
