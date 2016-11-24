<?php

namespace Model;

/**
 * Class ObserverModel
 */
class ObserverModel
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $event;

    /** @var int */
    private $orderNum;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param string $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }

    /**
     * @return int
     */
    public function getOrderNum()
    {
        return $this->orderNum;
    }

    /**
     * @param int $orderNum
     */
    public function setOrderNum($orderNum)
    {
        $this->orderNum = $orderNum;
    }


}