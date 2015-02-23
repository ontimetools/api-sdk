<?php

namespace OTT\Api\Filter;

/**
 * Class Attachments
 * @package OTT\Api\Filter
 * @url : http://developer.axosoft.com/api/attachments.html#!/attachments/
 */
class Attachments extends FilterAbstract
{
    /** @var int */
    private $id = null;
    /** @var string */
    private $search_string = null;
    /** @var bool */
    private $data = false;
    /** @var string */
    private $format = null;
    /** @var int */
    private $max_width = null;
    /** @var int */
    private $max_height = null;

    /**
     * @return boolean
     */
    public function isData()
    {
        return $this->data;
    }

    /**
     * @param boolean $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param string $format
     */
    public function setFormat($format)
    {
        $formats = ['raw', 'png'];
        if (!in_array($format, $formats)) {
            $format = null;
        }
        $this->format = $format;
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
    public function getMaxHeight()
    {
        return $this->max_height;
    }

    /**
     * @param int $max_height
     */
    public function setMaxHeight($max_height)
    {
        $this->max_height = $max_height;
    }

    /**
     * @return int
     */
    public function getMaxWidth()
    {
        return $this->max_width;
    }

    /**
     * @param int $max_width
     */
    public function setMaxWidth($max_width)
    {
        $this->max_width = $max_width;
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
}
