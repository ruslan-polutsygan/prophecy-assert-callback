<?php

namespace RP\Prophecy\Argument\Token;

use Prophecy\Exception\InvalidArgumentException;
use Prophecy\Argument\Token\TokenInterface;

class AssertCallbackToken implements TokenInterface
{
    private $callback;

    /**
     * Initializes token.
     *
     * @param callable $callback
     *
     * @throws \Prophecy\Exception\InvalidArgumentException
     */
    public function __construct($callback)
    {
        if (!is_callable($callback)) {
            throw new InvalidArgumentException(sprintf(
                'Callable expected as an argument to AssertCallbackToken, but got %s.',
                gettype($callback)
            ));
        }

        $this->callback = $callback;
    }

    /**
     * Scores 7 if callback returns true, false otherwise.
     *
     * @param $argument
     *
     * @return bool|int
     */
    public function scoreArgument($argument)
    {
        try {
            call_user_func($this->callback, $argument);
        } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
            return false;
        }

        return 7;
    }

    /**
     * Returns false.
     *
     * @return bool
     */
    public function isLast()
    {
        return false;
    }

    /**
     * Returns string representation for token.
     *
     * @return string
     */
    public function __toString()
    {
        return 'assert_callback()';
    }
}
