<?php

/**
 * Created by PhpStorm.
 * User: Jiang Yu
 * Date: 2015/12/17
 * Time: 21:52.
 */
namespace Queue\Worker\JobStatus;

use Queue\Worker\JobStatus\Persist\JobStatusPersistInterface;
use Queue\Worker\Token\TokenInterface;

/**
 * Class JobStatus.
 */
class JobStatus
{
    const STATUS_WAITING = 1;
    const STATUS_RUNNING = 2;
    const STATUS_FAILED = 4;
    const STATUS_COMPLETE = 8;

    /**
     * @var TokenInterface
     */
    protected $token;
    /**
     * @var int
     */
    protected $status;
    /**
     * @var string
     */
    protected $payload;
    /**
     * @var JobStatusPersistInterface
     */
    protected $persist;

    /**
     * @param JobStatusPersistInterface $persist
     */
    public function __construct(JobStatusPersistInterface $persist)
    {
        $this->persist = $persist;
    }

    /**
     * @param TokenInterface $token
     */
    public function setToken(TokenInterface $token)
    {
        $this->token = $token;
    }

    /**
     *
     */
    public function setRunning()
    {
        $this->doPersist(self::STATUS_RUNNING);
    }

    /**
     *
     */
    public function setFailed()
    {
        $this->doPersist(self::STATUS_FAILED);
    }

    /**
     *
     */
    public function setComplete()
    {
        $this->doPersist(self::STATUS_COMPLETE);
    }

    /**
     *
     */
    public function setWaiting()
    {
        $this->doPersist(self::STATUS_WAITING);
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        if ($this->status === null) {
            $this->status = $this->persist->query($this->token->toString());
        }

        return $this->status;
    }

    /**
     * @param int $status
     */
    protected function doPersist($status)
    {
        $this->status = $status;
        $this->persist->update($this->token->toString(), $this->status);
        $this->persist->flush();
    }
}
