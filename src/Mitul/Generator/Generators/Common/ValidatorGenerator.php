<?php

namespace Mitul\Generator\Generators\Common;

use Config;
use Mitul\Generator\CommandData;
use Mitul\Generator\Generators\GeneratorProvider;
use Mitul\Generator\Utils\GeneratorUtils;

class ValidatorGenerator implements GeneratorProvider
{
    /** @var  CommandData */
    private $commandData;

    /** @var string */
    private $path;

    public function __construct($commandData)
    {
        $this->commandData = $commandData;
        $this->path = Config::get('generator.path_validator', app_path('Validator/'));
    }

    public function generate()
    {
        $templateData = $this->commandData->templatesHelper->getTemplate('Validator', 'common');

        $templateData = GeneratorUtils::fillTemplate($this->commandData->dynamicVars, $templateData);

        $fileName = $this->commandData->modelName.'Validator.php';

        if (!file_exists($this->path)) {
            mkdir($this->path, 0755, true);
        }

        $path = $this->path.$fileName;

        $this->commandData->fileHelper->writeFile($path, $templateData);
        $this->commandData->commandObj->comment("\nValidato created: ");
        $this->commandData->commandObj->info($fileName);
    }
}
