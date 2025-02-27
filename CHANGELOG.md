# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/) and this project adheres to 
[Semantic Versioning](https://semver.org/spec/v2.0.0.html). Please note this changelog affects this package and not the 
WeFact API. See the changelog of the [WeFact API](https://www.wefact.nl/api/changelog/) for detailed information.

## [6.0.0]

### Added

- Add support for Laravel 12.

### Removed

- Drop support for PHP versions lower than 8.2.

## [5.0.0]

### Added

- Add support for Laravel 11.
- Add pint for code style.

### Removed

- Drop support for PHP versions lower than 8.1

## [3.0.0]

### Changed

- Update to Laravel 9.

## [2.0.0]

### Changed

- Switch to using the HTTP Client of Laravel. The request will now return the `Illuminate\Http\Client\Response`.

## [1.0.0]

### Added

- Add the initial WeFact API implementation.
