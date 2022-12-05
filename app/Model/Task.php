<?php

namespace App\Model;

use Core\BaseModel;

class TaskException extends \Exception {}
class Task extends BaseModel
{
    private int $_id;
    private string $_title;
    private int $_status;
    private int $_degree;

    /**
     * @throws TaskException
     */
    public function __construct($_id, $_title, $_status, $_degree)
    {
        $this->setID($_id);
        $this->setTitle($_title);
        $this->setStatus($_status);
        $this->setDegree($_degree);
    }

    /**
     * @return integer
     */
    public function getID(): int
    {
        return $this->_id;
    }

    /**
     * @param int $id
     * @throws TaskException
     */
    public function setID(int $id): void
    {
        if (($id !== null) && (!is_numeric($id) || $id <= 0 || $id > 9223372036854775807)) {
            throw new TaskException("Task ID error");
        }
        $this->_id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->_title;
    }

    /**
     * @param string $title
     * @throws TaskException
     */
    public function setTitle(string $title): void
    {
        if (strlen($title) < 0 || strlen($title) > 255) {
            throw new TaskException("Task title cannot be more than 255 characters.");
        }
        $this->_title = $title;
    }

    /**
     * @return integer
     */
    public function getStatus(): int
    {
        return $this->_status;
    }

    /**
     * @param integer $status
     * @throws TaskException
     */
    public function setStatus(int $status): void
    {
        if ($status !== 1 && $status !== 0) {
            throw new TaskException("Task status must be 0 or 1");
        }
        $this->_status = $status;

    }

    /**
     * @return integer
     */
    public function getDegree(): int
    {
        return $this->_degree;
    }

    /**
     * @param integer $degree
     * @throws TaskException
     */
    public function setDegree(int $degree): void
    {
        if (!is_numeric($degree) || ($degree < 0 || $degree > 5)) {
            throw new TaskException("Task status must be between 1 and 5");
        }
        $this->_degree = $degree;

    }

    /**
     * @return array
     */
    public function returnTaskAsArray(): array
    {
        $task = array();
        $task['id'] = $this->getId();
        $task['title'] = $this->getTitle();
        $task['status'] = $this->getStatus();
        $task['degree'] = $this->getDegree();
        return $task;
    }
}