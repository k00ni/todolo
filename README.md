# todolo

[![Build Status](https://travis-ci.com/k00ni/todolo.svg?branch=master)](https://travis-ci.com/k00ni/todolo)

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/k00ni/todolo/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/k00ni/todolo/?branch=master)

**Project Status:** *early development phase (pre-alpha)*

## About

Todolo helps you to keep track of TODO, FIXME etc. all over your files.
It shows a list of files with all related TODO messages on the terminal.

## Installation

Please install `k00ni/todolo` with composer.

## Usage

Run

> php bin/todolo

in the root folder of your project. If files in your `src` folder contain TODO's like

> // TODO foobar

it may print something like the following on the terminal:

```
Dir: src
     /Todolo/TodoFinder.php
     - add me
```
