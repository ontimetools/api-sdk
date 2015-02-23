<?php

namespace OTT\Api\Filter;

/**
 * Class Item
 * @package OTT\Api\Filter
 */
abstract class ItemAbstract extends FilterAbstract
{
    /** @var int */
    private $id = null;
    /** @var int */
    private $page = null;
    /** @var int */
    private $page_size = null;
    /** @var int */
    private $project_id = null;
    /** @var bool */
    private $include_sub_projects_items = false;
    /** @var bool */
    private $include_inactive_projects = false;
    /** @var int */
    private $release_id = null;
    /** @var bool */
    private $include_sub_releases_items = false;
    /** @var bool */
    private $include_inactive_releases = false;
    /** @var int */
    private $assigned_to_id = null;
    /** @var string */
    private $assigned_to_type = null;
    /** @var int */
    private $customer_id = null;
    /** @var int */
    private $contact_id = null;
    /** @var int */
    private $filter_id = null;
    /** @var bool */
    private $include_archived = false;
    /** @var string */
    private $sort_fields = null;
    /** @var string */
    private $search_string = null;
    /** @var int */
    private $search_field = null;
    /** @var int */
    private $columns = null;
    /** @var bool */
    private $attachments = false;
    /** @var bool */
    private $emails = false;
    /** @var bool */
    private $with_lock = false;

    /**
     * @return int
     */
    public function getAssignedToId()
    {
        return $this->assigned_to_id;
    }

    /**
     * @param int $assigned_to_id
     */
    public function setAssignedToId($assigned_to_id)
    {
        $this->assigned_to_id = $assigned_to_id;
    }

    /**
     * @return string
     */
    public function getAssignedToType()
    {
        return $this->assigned_to_type;
    }

    /**
     * @param string $assigned_to_type
     */
    public function setAssignedToType($assigned_to_type)
    {
        $this->assigned_to_type = $assigned_to_type;
    }

    /**
     * @return boolean
     */
    public function isAttachments()
    {
        return $this->attachments;
    }

    /**
     * @param boolean $attachments
     */
    public function setAttachments($attachments)
    {
        $this->attachments = $attachments;
    }

    /**
     * @return int
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @param int $columns
     */
    public function setColumns($columns)
    {
        $this->columns = $columns;
    }

    /**
     * @return int
     */
    public function getContactId()
    {
        return $this->contact_id;
    }

    /**
     * @param int $contact_id
     */
    public function setContactId($contact_id)
    {
        $this->contact_id = $contact_id;
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
     * @return boolean
     */
    public function isEmails()
    {
        return $this->emails;
    }

    /**
     * @param boolean $emails
     */
    public function setEmails($emails)
    {
        $this->emails = $emails;
    }

    /**
     * @return int
     */
    public function getFilterId()
    {
        return $this->filter_id;
    }

    /**
     * @param int $filter_id
     */
    public function setFilterId($filter_id)
    {
        $this->filter_id = $filter_id;
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
     * @return boolean
     */
    public function isIncludeArchived()
    {
        return $this->include_archived;
    }

    /**
     * @param boolean $include_archived
     */
    public function setIncludeArchived($include_archived)
    {
        $this->include_archived = $include_archived;
    }

    /**
     * @return boolean
     */
    public function isIncludeInactiveProjects()
    {
        return $this->include_inactive_projects;
    }

    /**
     * @param boolean $include_inactive_projects
     */
    public function setIncludeInactiveProjects($include_inactive_projects)
    {
        $this->include_inactive_projects = $include_inactive_projects;
    }

    /**
     * @return boolean
     */
    public function isIncludeInactiveReleases()
    {
        return $this->include_inactive_releases;
    }

    /**
     * @param boolean $include_inactive_releases
     */
    public function setIncludeInactiveReleases($include_inactive_releases)
    {
        $this->include_inactive_releases = $include_inactive_releases;
    }

    /**
     * @return boolean
     */
    public function isIncludeSubProjectsItems()
    {
        return $this->include_sub_projects_items;
    }

    /**
     * @param boolean $include_sub_projects_items
     */
    public function setIncludeSubProjectsItems($include_sub_projects_items)
    {
        $this->include_sub_projects_items = $include_sub_projects_items;
    }

    /**
     * @return boolean
     */
    public function isIncludeSubReleasesItems()
    {
        return $this->include_sub_releases_items;
    }

    /**
     * @param boolean $include_sub_releases_items
     */
    public function setIncludeSubReleasesItems($include_sub_releases_items)
    {
        $this->include_sub_releases_items = $include_sub_releases_items;
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
     * @return int
     */
    public function getProjectId()
    {
        return $this->project_id;
    }

    /**
     * @param int $project_id
     */
    public function setProjectId($project_id)
    {
        $this->project_id = $project_id;
    }

    /**
     * @return int
     */
    public function getReleaseId()
    {
        return $this->release_id;
    }

    /**
     * @param int $release_id
     */
    public function setReleaseId($release_id)
    {
        $this->release_id = $release_id;
    }

    /**
     * @return int
     */
    public function getSearchField()
    {
        return $this->search_field;
    }

    /**
     * @param int $search_field
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

    /**
     * @return boolean
     */
    public function isWithLock()
    {
        return $this->with_lock;
    }

    /**
     * @param boolean $with_lock
     */
    public function setWithLock($with_lock)
    {
        $this->with_lock = $with_lock;
    }
}
