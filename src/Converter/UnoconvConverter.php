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

use Symfony\Component\Filesystem\Filesystem;

/**
 * Converter that uses unoconv to convert DOCX to PDF
 *
 * @author Pablo Lozano <lozanomunarriz@gmail.com>
 */
class UnoconvConverter implements ConverterInterface
{
    /**
     * @var Filesystem
     */
    protected $fs;

    /**
     * @var UnoconvConverterCommand
     */
    protected $command;

    /**
     * Directory where temporary files are stored.
     * @var string
     */
    protected $tmp;

    /**
     * @param GhostscriptConverterCommand $command
     * @param Filesystem $fs
     * @param null|string $tmp
     */
    public function __construct(UnoconvConverterCommand $command, Filesystem $fs, $tmp = null)
    {
        $this->command = $command;
        $this->fs = $fs;
        $this->tmp = $tmp ? : sys_get_temp_dir();
    }

    /**
     * Generates a unique absolute path for tmp file.
     * @return string absolute path
     */
    protected function generateAbsolutePathOfTmpFile()
    {
        return $this->tmp .'/'. uniqid('pdf_version_changer_') . '.pdf';
    }


    /**
     * {@inheritdoc }
     */
    public function convert(string $file, string $newVersion): ?string
    {
        $tmpFile = $this->generateAbsolutePathOfTmpFile();

        $this->command->run($file, $tmpFile, $newVersion);

        if (!$this->fs->exists($tmpFile))
            throw new \RuntimeException("The generated file '{$tmpFile}' was not found.");

        $info = pathinfo($file);

        $newFile = $info['dirname']. '/' .$info['filename'] . '.pdf';

        $this->fs->copy($tmpFile, $newFile, true);

        return $newFile;
    }
}
