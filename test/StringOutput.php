<?php

declare(strict_types = 1);

namespace Test\Todolo;

use Symfony\Component\Console\Formatter\OutputFormatterInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StringOutput implements OutputInterface
{
    /**
     * @var string
     */
    protected $messages = '';

    public function getFormatter()
    {
    }

    public function getMessages(): string
    {
        return $this->messages;
    }

    public function getVerbosity()
    {
    }

    public function isDebug()
    {
    }

    public function isDecorated()
    {
    }

    public function isQuiet()
    {
    }

    public function isVerbose()
    {
    }

    public function isVeryVerbose()
    {
    }

    /**
     * @param bool $decorated
     */
    public function setDecorated($decorated)
    {
    }

    /**
     * @param OutputFormatterInterface $formatter
     */
    public function setFormatter($formatter)
    {
    }

    /**
     * @param int $level
     */
    public function setVerbosity($level)
    {
    }

    public function write($message, $newline = false, $options = 0)
    {
        $this->messages .= $message;

        if ($newline) {
            $this->messages .= PHP_EOL;
        }
    }

    public function writeln($message, $options = 0)
    {
        $this->write($message, true);
    }
}
