<?php
/**
 * Created by PhpStorm.
 * User: Jiang Yu
 * Date: 2015/12/18
 * Time: 10:25.
 */
namespace Queue\Worker\Token;

/**
 * Class Token.
 */
interface TokenInterface
{
    /**
     * @param string $payload
     */
    public function fromPayload($payload);

    /**
     * @param string $tokenString
     */
    public function fromString($tokenString);

    /**
     * @return string
     */
    public function toString();
}
