<?php

/**
 * Created by PhpStorm.
 * User: Jiang Yu
 * Date: 2015/12/18
 * Time: 12:09.
 */
namespace Queue\Worker\JobStatus\Persist;

/**
 * Class JobStatusPersist.
 */
class JobStatusPersist implements JobStatusPersistInterface
{
    /**
     * @var array
     */
    protected $data;

    /**
     * JobStatusPersist constructor.
     */
    public function __construct()
    {
        $this->data = $this->load();
    }

    /**
     * @param string $key
     * @param int    $status
     */
    public function update($key, $status)
    {
        $this->data[$key] = $status;
    }

    /**
     *
     */
    public function flush()
    {
        file_put_contents($this->getFilePath(), json_encode($this->data));
    }

    /**
     * @param string $key
     *
     * @return int
     */
    public function query($key)
    {
        return $this->data[$key];
    }

    /**
     * @return array
     */
    private function load()
    {
        $file = $this->getFilePath();
        if (!is_readable($file)) {
            return [];
        }
        $data = file_get_contents($file);
        if (is_string($data)) {
            $array = json_decode($data, true);
            if (is_array($array)) {
                return $array;
            }
        }

        return [];
    }

    /**
     * @return string
     */
    private function getFilePath()
    {
        return __CLASS__.'.persist';
    }
}
