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

/**
 * Classes that implements this interface can convert the PDF version of given file.
 *
 * @author Pablo Lozano <lozanomunarriz@gmail.com>
 */
interface ConverterInterface
{
    /**
     * Change PDF version of given $file to $newVersion.
     * @param string $file absolute path.
     * @param string $newVersion version (1.4, 1.5, 1.6, etc) for GS (0,1) for Unoconv.
     * @throws \RuntimeException if something goes wrong.
     * @return void
     */
    public function convert($file, $newVersion);
}
