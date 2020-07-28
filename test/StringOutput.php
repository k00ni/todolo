<?php

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

    public function setDecorated(bool $decorated)
    {
    }

    public function setFormatter(OutputFormatterInterface $formatter)
    {
    }

    public function setVerbosity(int $level)
    {
    }

    public function write($message, bool $newline = false, int $options = 0)
    {
        $this->messages .= $message;

        if ($newline) {
            $this->messages .= PHP_EOL;
        }
    }

    public function writeln($message, int $options = 0)
    {
        $this->write($message, true);
    }
}
