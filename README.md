# PDF version converter 
PHP library for converting the version of PDF files (for compatibility purposes).

## Requirements

- PHP 5.3+
- Ghostscript (gs command on Linux)
- Unoconv & LibreOffice instaled (for docx conversion to pdf)

## Installation

Run `php composer.phar require simplelogica/pdf-version-converter dev-master` or add the follow lines to composer and run `composer install`:

```
{
    "require": {
        "simplelogica/pdf-version-converter": "dev-master"
    }
}
```

## Usage

Guessing a version of PDF File:

```php
<?php
// import the namespaces
use Simplelogica\PDFVersionConverter\Guesser\RegexGuesser;
// [..]

$guesser = new RegexGuesser();
echo $guesser->guess('/path/to/my/file.pdf'); // will print something like '1.4'
```

Converting file to a new PDF version:

```php
<?php
// import the namespaces
use Symfony\Component\Filesystem\Filesystem,
    Simplelogica\PDFVersionConverter\Converter\GhostscriptConverterCommand,
    Simplelogica\PDFVersionConverter\Converter\GhostscriptConverter
;

// [..]

$command = new GhostscriptConverterCommand();
$filesystem = new Filesystem();

$converter = new GhostscriptConverter($command, $filesystem);
$converter->convert('/path/to/my/file.pdf', '1.4');
```

Converting DOCX to a new PDF version:

```php
<?php
// import the namespaces
use Symfony\Component\Filesystem\Filesystem,
    Simplelogica\PDFVersionConverter\Converter\UnoconvConverterCommand,
    Simplelogica\PDFVersionConverter\Converter\UnoconvConverter
;

// [..]

$command = new UnoconvConverterCommand();
$filesystem = new Filesystem();

$converter = new UnoconvConverter($command, $filesystem);
$converter->convert('/path/to/my/file.docx', 0);
```

## Contributing

Is really simple add new implementation of guesser or converter , just implement `GuessInterface` or `ConverterInterface`.

## Running unit tests

Run `phpunit -c tests`.
