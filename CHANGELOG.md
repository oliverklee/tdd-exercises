# Change log

All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](https://semver.org/).

## x.y.z

### Added
- Add an RLE encoder/decoder (#38)
- Add Infection (#29)
- Add a PHPUnit configuration file (#25)
- Re-add support for PHP 7.1 and 7.2 (#24)
- Add and version the `composer.lock` (#17)
- Add support for PHP 7.4 (#16)
- Run the tests on TravisCI
- Composer script for PHP linting

### Changed
- Upgrade to PHPUnit 9 (#20, #36)
- Switch to a Symfony-style directory structure (#18)
- Switch from TravisCI to GitHub Actions (#12, #13)

### Deprecated

### Removed
- Drop support for PHP 7.1 and 7.2 again (#33)
- Drop the Vagrant configuration (#23)
- Drop support for PHP 7.2 (#19)

### Fixed
- Stop using curly braces for string indices (#47, #48)
- Keep GitHub actions on Composer 1 (#32)
- Make compatible with Composer 2 (#31)
- Fix the casing of the vfsstream package (#5)
