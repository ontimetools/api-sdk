<?php

namespace OTT\Api\Filter;

/**
 * Class Projects
 * @package OTT\Api\Filter
 * @url : http://developer.axosoft.com/api/projects.html#!/projects/
 */
class Projects extends FilterAbstract
{
    /** @var int */
    private $id = null;
    /** @var string */
    private $extend = 'all';
    /** @var bool */
    private $attachments = false;
    /** @var bool */
    private $workflow = false;
    /** @var string */
    private $item_type = null;

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
        $this->extend = $extend;
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
     * @return string
     */
    public function getItemType()
    {
        return $this->item_type;
    }

    /**
     * @param string $item_type
     */
    public function setItemType($item_type)
    {
        $this->item_type = $item_type;
    }

    /**
     * @return boolean
     */
    public function isWorkflow()
    {
        return $this->workflow;
    }

    /**
     * @param boolean $workflow
     */
    public function setWorkflow($workflow)
    {
        $this->workflow = $workflow;
    }
}
