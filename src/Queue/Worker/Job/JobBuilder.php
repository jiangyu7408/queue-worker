<?php

/**
 * Created by PhpStorm.
 * User: Jiang Yu
 * Date: 2015/12/18
 * Time: 17:25.
 */
namespace Queue\Worker\Job;

use Queue\Worker\Token\Token;

/**
 * Class JobBuilder.
 */
class JobBuilder
{
    /**
     * @param JobInterface $job
     * @param string       $payload
     *
     * @return JobInterface
     */
    public function build(JobInterface $job, $payload)
    {
        if (!is_string($payload)) {
            throw new \InvalidArgumentException('bad arg: payload');
        }

        $job = clone $job;

        $token = new Token();
        $token->fromPayload($payload);
        $job->setToken($token);

        $job->setPayload($payload);

        return $job;
    }
}
