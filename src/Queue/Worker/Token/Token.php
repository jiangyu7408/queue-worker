<?php

/**
 * Created by PhpStorm.
 * User: Jiang Yu
 * Date: 2015/12/18
 * Time: 10:23.
 */
namespace Queue\Worker\Token;

/**
 * Class Token.
 */
class Token implements TokenInterface
{
    /**
     * @var string
     */
    protected $token;
    /**
     * @var TokenGenerator
     */
    protected $generator;

    /**
     * Token constructor.
     */
    public function __construct()
    {
        $this->generator = new TokenGenerator();
    }

    /**
     * @param string $payload
     */
    public function fromPayload($payload)
    {
        $this->token = $this->generator->generate($payload);
    }

    /**
     * @param string $tokenString
     */
    public function fromString($tokenString)
    {
        $this->token = $tokenString;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->token;
    }
}
