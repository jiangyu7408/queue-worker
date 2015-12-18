<?php

/**
 * Created by PhpStorm.
 * User: Jiang Yu
 * Date: 2015/12/18
 * Time: 15:41.
 */
namespace Queue\Worker\Job;

use Queue\Worker\Token\TokenInterface;

/**
 * Class JobSerializer.
 */
class JobSerializer
{
    /**
     * @param JobInterface $job
     *
     * @return string
     */
    public function serialize(JobInterface $job)
    {
        $data = [
            'token' => $job->getToken()->toString(),
            'payload' => $job->getPayload(),
        ];

        return json_encode($data);
    }

    /**
     * @param string         $data
     * @param JobInterface   $jobPrototype
     * @param TokenInterface $tokenPrototype
     *
     * @return JobInterface
     */
    public function unserialize($data, JobInterface $jobPrototype, TokenInterface $tokenPrototype)
    {
        $array = json_decode($data, true);

        $object = clone $jobPrototype;
        $object->setPayload($array['payload']);

        $token = clone $tokenPrototype;
        $token->fromString($array['token']);

        $object->setToken($token);

        return $object;
    }
}
