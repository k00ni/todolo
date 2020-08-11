# todolo

[![Build Status](https://travis-ci.com/k00ni/todolo.svg?branch=master)](https://travis-ci.com/k00ni/todolo)
[![Code Coverage](https://scrutinizer-ci.com/g/k00ni/todolo/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/k00ni/todolo/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/k00ni/todolo/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/k00ni/todolo/?branch=master)

## About

Todolo helps you to keep track of TODO, FIXME etc. all over your files.
It shows a list of files with all related TODO messages on the terminal.

## Installation

Please install `k00ni/todolo` with composer.

## Usage

Run

> vendor/bin/todolo

in the root folder of your project. If files in your `src` folder contain TODO's like

> // TODO foobar

it may print something like the following on the terminal:

```
-----------------------------------------------------
tests/Integration/TodoFinderTest.php
-----------------------------------------------------
- TODO 1
- FIXME 2
- Foobar

-----------------------------------------------------
tests/Integration/Helper/OutputHelperTest.php
-----------------------------------------------------
No TODOs found.
-----------------------------------------------------
```

## Config

**Complete config example:**

```php
return [
    'dirs_to_check' => [
        'src',
    ],
    // show
    'show_empty_dir' => false,
    'show_files_with_no_todos' => false,
    'show_no_files_info' => true,
];
```

### dirs_to_check

List all folders you wanna include in the TODO collection.

Example:

```php
return [
    'dirs_to_check' => [
        'src',
    ],
];
```

### show_empty_dir

If set to `true` it will show empty dirs in the output later on.

Example:

```php
return [
    'show_empty_dir' => true,
];
```

### show_files_with_no_todos

If set to `true` it will show files which have no TODOs inside.

Example:

```php
return [
    'show_files_with_no_todos' => true,
];
```

### show_no_files_info

If set to `true` it will show info if a dir has no files inside.

Example:

```php
return [
    'show_no_files_info' => true,
];
```
