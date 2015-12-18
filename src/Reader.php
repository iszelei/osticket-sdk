<?php

namespace Iszelei\OsTicketSDK;

/**
 * Class Reader
 * @package Iszelei\OsTicketSDK
 */
class Reader {

    /**
     * @var string
     */
    protected $wsdlUrl;
    /**
     * @var Staff
     */
    protected $staff;

    /**
     * Reader constructor.
     * @param Staff $staff
     * @param string $wsdlUrl
     */
    public function __construct(Staff $staff, $wsdlUrl)
    {
        $this->setStaff($staff)
            ->setWsdlUrl($wsdlUrl);
    }

    /**
     * @return array
     * @throws SoapFault
     */
    public function listDepartments()
    {
        return $this->call(
            'ostDepartment.listAll',
            $this->staff->getCredentialArray()
        );
    }

    /**
     * @return array
     * @throws SoapFault
     */
    public function listTopics()
    {
        return $this->call(
            'ostTopic.listAll',
            $this->staff->getCredentialArray()
        );
    }

    /**
     * @param int $departmentId
     * @return array
     */
    public function departmentTopics($departmentId)
    {
        $return = [];
        $topics = $this->listTopics();
        foreach($topics as $topic)
        {
            if($topic->department == $departmentId && $topic->isEnabled && $topic->isActive)
                $return[] = $topic;
        }

        return $return;
    }

    /**
     * @param string $action
     * @param array $params
     * @return mixed
     * @throws \SoapFault
     */
    private function call($action, $params)
    {
        $osticketClient = new \SoapClient($this->getWsdlUrl());

        try {
            $result = $osticketClient->__call($action, $params);

            return $result;
        }
        catch (\SoapFault $e) {
            throw $e;
        }
    }

    /**
     * @return mixed
     */
    public function getWsdlUrl()
    {
        return $this->wsdlUrl;
    }

    /**
     * @param mixed $wsdlUrl
     */
    private function setWsdlUrl($wsdlUrl)
    {
        $this->wsdlUrl = $wsdlUrl;
    }

    /**
     * @return Staff
     */
    public function getStaff()
    {
        return $this->staff;
    }

    /**
     * @param Staff $staff
     * @return Reader $this
     */
    private function setStaff(Staff $staff)
    {
        $this->staff = $staff;

        return $this;
    }



}