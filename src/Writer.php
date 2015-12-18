<?php

namespace Iszelei\OsTicketSDK;

use Iszelei\OsTicketSDK\Exceptions\CantCreateTicketException;

/**
 * Class Writer
 * @package Iszelei\OsTicketSDK
 */
class Writer {

    /**
     * @var string
     */
    protected $key;
    /**
     * @var string
     */
    protected $url;

    /**
     * Writer constructor.
     * @param string $key
     * @param string $url
     */
    public function __construct($key, $url)
    {
        $this->setKey($key)
            ->setUrl($url);
    }

    /**
     * @param Ticket $ticket
     * @return int
     * @throws CantCreateTicketException
     */
    public function createTicket(Ticket $ticket)
    {
        $ticket->validate();

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL             => $this->getUrl(),
            CURLOPT_POST            => 1,
            CURLOPT_POSTFIELDS      => $ticket->__toString(),
            CURLOPT_USERAGENT       => 'osTicket API',
            CURLOPT_HEADER          => false,
            CURLOPT_HTTPHEADER      => ['Expect:', 'X-API-Key: ' . $this->getKey()],
            CURLOPT_FOLLOWLOCATION  => false,
            CURLOPT_RETURNTRANSFER  => true
        ]);

        $result = curl_exec($ch);

        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        if ($code != 201) {
            throw new CantCreateTicketException('Can\'t create ticket', 1);
        }

        return (int) $result;
    }

    /**
     * @param string $key
     * @return Writer $this
     */
    private function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $url
     * @return Writer $this
     */
    private function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

}