<?php

/*
 * This file is part of the PDF Version Converter.
 *
 * (c) Thiago Rodrigues <xthiago@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Simplelogica\PDFVersionConverter\Converter;

use Symfony\Component\Process\Process;

/**
 * Encapsulates the knowledge about unoconv command.
 *
 * @author Pablo Lozano <lozanomunarriz@gmail.com>
 */
class UnoconvConverterCommand
{
    /**
     * @var Filesystem
     */
    protected $baseCommand = 'unoconv -f pdf -o %s -e SelectPdfVersion=%s %s';

    public function __construct()
    {
    }

    public function run($originalFile, $newFile, $pdfVersion = 0)
    {
        $command = sprintf($this->baseCommand, $newFile, $pdfVersion, escapeshellarg($originalFile));

        $process = new Process($command);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }
    }
}
