<?php

/**
 * Created by PhpStorm.
 * User: Jiang Yu
 * Date: 2015/12/18
 * Time: 15:58.
 */
namespace Queue\Worker\Job;

use Queue\Worker\Token\Token;

/**
 * Class SerializerTest.
 */
class SerializerTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function test()
    {
        $payload = json_encode(['time' => microtime(true)]);
        $job = new TestJob();
        $job->setPayload($payload);

        $token = new Token();
        $token->fromPayload($payload);
        $job->setToken($token);
        static::assertTrue(strlen($token->toString()) > 0);

        static::assertEquals($payload, $job->getPayload());

        $serializer = new JobSerializer();
        $flatten = $serializer->serialize($job);
        $job2 = $serializer->unserialize($flatten, $job, $token);
        static::assertEquals($job, $job2);
    }
}
