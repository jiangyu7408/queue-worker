<?php

/**
 * Created by PhpStorm.
 * User: Jiang Yu
 * Date: 2015/12/17
 * Time: 21:46.
 */
namespace Queue\Worker\Job;

use Queue\Worker\Token\TokenInterface;

/**
 * Interface JobInterface
 *
 * @package Queue\Worker
 */
interface JobInterface
{
    /**
     * @return mixed
     */
    public function setUp();

    /**
     * @return mixed
     */
    public function perform();

    /**
     * @return mixed
     */
    public function tearDown();

    /**
     * @return TokenInterface
     */
    public function getToken();

    /**
     * @return string
     */
    public function getPayload();

    /**
     * @param TokenInterface $token
     */
    public function setToken(TokenInterface $token);

    /**
     * @param string $payload
     */
    public function setPayload($payload);
}
