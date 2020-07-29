<?php

declare(strict_types=1);

namespace Todolo\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Todolo\Helper\ConfigHelper;
use Todolo\Helper\OutputHelper;
use Todolo\TodoFinder;

class Todolo extends Command
{
    protected static $defaultName = 'todolo';

    /**
     * @var string
     */
    protected $configFilename = '.todolo.php';

    /**
     * @var ConfigHelper
     */
    protected $configHelper;

    /**
     * @var OutputHelper
     */
    protected $outputHelper;

    /**
     * @var TodoFinder
     */
    protected $todoFinder;

    public function __construct(
        ConfigHelper $configHelper,
        OutputHelper $outputHelper,
        TodoFinder $todoFinder,
        string $name = null
    ) {
        parent::__construct($name);

        $this->configHelper = $configHelper;
        $this->outputHelper = $outputHelper;
        $this->todoFinder = $todoFinder;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $currentDir = getcwd();
        $config = $this->configHelper->getStandardConfig();

        if (file_exists($currentDir.'/'.$this->configFilename)) {
            $userConfig = (array) require $currentDir.'/'.$this->configFilename;

            // user config overrides standard config
            $config = array_merge($config, $userConfig);
        }

        $this->configHelper->validateConfig($config);

        $todos = [];

        // per dir ...
        foreach ($config['dirs_to_check'] as $dir) {
            $dirPath = $currentDir.'/'.$dir;

            $todos[$dir] = $this->todoFinder->getAllTodosForPHPFilesIn($dirPath);
        }

        $this->outputHelper->printTodos($output, $todos, $config);

        return 0;
    }
}
