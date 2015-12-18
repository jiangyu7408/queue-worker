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
     * JobBuilder constructor.
     *
     * @param JobInterface $jobProto
     * @param Token        $tokenProto
     */
    public function __construct(JobInterface $jobProto, Token $tokenProto)
    {
        $this->jobProto = $jobProto;
        $this->tokenProto = $tokenProto;
    }

    /**
     * @param string $payload
     *
     * @return JobInterface
     */
    public function build($payload)
    {
        if (!is_string($payload)) {
            throw new \InvalidArgumentException('bad arg: payload');
        }

        $jobProto = clone $this->jobProto;

        $tokenProto = clone $this->tokenProto;
        $tokenProto->fromPayload($payload);
        $jobProto->setToken($tokenProto);

        $jobProto->setPayload($payload);

        return $jobProto;
    }
}
