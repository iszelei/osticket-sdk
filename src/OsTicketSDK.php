<?php

namespace Iszelei\OsTicketSDK;

use Iszelei\OsTicketSDK\Exceptions\CantCreateTicketException;

/**
 * Class OsTicketSDK
 * @package Iszelei\OsTicketSDK
 */
class OsTicketSDK {

    /**
     * @var Reader
     */
    protected $reader;
    /**
     * @var Writer
     */
    protected $writer;

    /**
     * OsTicketSDK constructor.
     * @param string|null $writeKey
     * @param string|null $writeUrl
     * @param Staff|null $readerUser
     * @param string|null $readerWsdl
     * @thorws \InvalidArgumentException
     */
    public function __construct($writeKey = null, $writeUrl = null, Staff $readerUser = null, $readerWsdl = null)
    {
        if($writeUrl && $writeKey) {
            $this->setWriter($writeKey, $writeUrl);
        }

        if($readerUser) {
            $this->setReader($readerUser, $readerWsdl);
        }

        if(!$this->writer && !$this->reader) {
            throw new \InvalidArgumentException('Reader or writer must be set', 1);
        }
    }

    /**
     * @param string $key
     * @param string $url
     */
    private function setWriter($key, $url)
    {
        $this->writer = new Writer($key, $url);
    }

    /**
     * @param Staff $readerUser
     * @param string $wsdl
     */
    private function setReader(Staff $readerUser, $wsdl)
    {
        $this->reader = new Reader($readerUser, $wsdl);
    }

    /**
     * @param Ticket $ticket
     * @return int
     * @throws CantCreateTicketException
     */
    public function createTicket(Ticket $ticket)
    {
        try {

            return $this->writer->createTicket($ticket);

        } catch (CantCreateTicketException $e) {

            throw $e;

        }
    }

    /**
     * @return array
     */
    public function listDepartments()
    {
        return $this->reader->listDepartments();
    }

    /**
     * @return array
     */
    public function listTopics()
    {
        return $this->reader->listTopics();
    }

    /**
     * @param int $departmentId
     * @return array
     */
    public function departmentTopics($departmentId)
    {
        return $this->reader->departmentTopics($departmentId);
    }

    /**
     * Retrieve one topic information
     *
     * @param $id ID of topic
     * @return \stdClass|null
     */
    public function getTopic($id)
    {
        $topics = $this->listTopics();
        $topics = array_filter($topics, function($topic) use ($id) {
            return ((int) $topic->id === (int) $id);
        });
        return array_pop($topics);
    }

}