<?php

/**
 * Created by PhpStorm.
 * User: Jiang Yu
 * Date: 2015/12/18
 * Time: 10:12.
 */
namespace Queue\Worker\Job;

use Queue\Worker\Token\TokenInterface;

/**
 * Class TestJob.
 */
class TestJob implements JobInterface
{
    /**
     * @var string
     */
    protected $payload;
    /**
     * @var TokenInterface
     */
    protected $token;

    /**
     * @return mixed
     */
    public function setUp()
    {
        dump(__METHOD__.': '.$this->token->toString());
    }

    /**
     * @return mixed
     */
    public function perform()
    {
        dump(__METHOD__.': '.$this->token->toString());
    }

    /**
     * @return mixed
     */
    public function tearDown()
    {
        dump(__METHOD__.': '.$this->token->toString());
    }

    /**
     * @return TokenInterface
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @param TokenInterface $token
     */
    public function setToken(TokenInterface $token)
    {
        $this->token = $token;
    }

    /**
     * @param string $payload
     */
    public function setPayload($payload)
    {
        if (!is_string($payload) || strlen($payload) === 0) {
            throw new \InvalidArgumentException('bad arg');
        }
        $this->payload = $payload;
    }
}
