<?php

/**
 * Created by PhpStorm.
 * User: Jiang Yu
 * Date: 2015/12/18
 * Time: 15:52.
 */
namespace Queue\Worker\Token;

/**
 * Class TokenGenerator.
 */
class TokenGenerator
{
    /**
     * @param string $payload
     *
     * @return string
     */
    public function generate($payload)
    {
        assert(is_string($payload) || is_numeric($payload));

        return crc32(uniqid(md5($payload)));
    }
}
