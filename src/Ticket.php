<?php

namespace Iszelei\OsTicketSDK;

use Iszelei\OsTicketSDK\Exceptions\MisisngParameterException;

/**
 * Class Ticket
 * @package Iszelei\OsTicketSDK
 */
class Ticket {

    /**
     * @var array
     */
    private $requiredParams = ['name',  'email',  'subject',  'message', 'ip', 'topicId'];
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $email;
    /**
     * @var string
     */
    protected $phone;
    /**
     * @var string
     */
    protected $subject;
    /**
     * @var string
     */
    protected $message;
    /**
     * @var string
     */
    protected $ip;
    /**
     * @var int
     */
    protected $topicId;
    /**
     * @var int
     */
    protected $Agency;
    /**
     * @var string
     */
    protected $Site;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Ticket $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Ticket $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return Ticket $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     * @return Ticket $this
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return Ticket $this
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     * @return Ticket $this
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * @return int
     */
    public function getTopicId()
    {
        return $this->topicId;
    }

    /**
     * @param int $topicId
     * @return Ticket $this
     */
    public function setTopicId($topicId)
    {
        $this->topicId = $topicId;

        return $this;
    }

    /**
     * @return int
     */
    public function getAgency()
    {
        return $this->Agency;
    }

    /**
     * @param int $Agency
     * @return Ticket $this
     */
    public function setAgency($Agency)
    {
        $this->Agency = $Agency;

        return $this;
    }

    /**
     * @return string
     */
    public function getSite()
    {
        return $this->Site;
    }

    /**
     * @param string $Site
     * @return Ticket $this
     */
    public function setSite($Site)
    {
        $this->Site = $Site;

        return $this;
    }

    /**
     * @throws MisisngParameterException
     */
    public function validate() {
        foreach($this->requiredParams as $requiredParam) {
            if($this->{$requiredParam} === null) {
                throw new MisisngParameterException($requiredParam . ' is required',1);
            }
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $params = get_object_vars($this);
        unset($params['requiredParams']);

        foreach($params as $key => $val) {
            if(is_null($val)) {
                unset($params[$key]);
            }
        }

        return json_encode($params);

    }


}