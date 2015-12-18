<?php
/**
 * Created by PhpStorm.
 * User: Jiang Yu
 * Date: 2015/12/18
 * Time: 12:12.
 */
namespace Queue\Worker\JobStatus\Persist;

/**
 * Class JobStatusPersist.
 */
interface JobStatusPersistInterface
{
    /**
     * @param string $key
     * @param int    $status
     */
    public function update($key, $status);

    /**
     * @return mixed
     */
    public function flush();

    /**
     * @param string $key
     *
     * @return int
     */
    public function query($key);
}
