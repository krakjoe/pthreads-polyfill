# pthreads-polyfill

[![Build Status](https://travis-ci.org/krakjoe/pthreads-polyfill.svg)](https://travis-ci.org/krakjoe/pthreads-polyfill)

*pthreads-polyfill* aims to satisfy the API requirements of *pthreads* classes such that code written to depend on *pthreads* will work when *pthreads* is not, or can not be loaded.

*pthreads-polyfill* does not implement the same execution model, for obvious reasons, and has no external dependencies.

*pthreads-polyfill* will fill for v2 or v3.

Testing
------

*pthreads-polyfill* is distributed with some *PHPUnit* tests, these tests should all pass with *pthreads* loaded, and without it.

Testing *pthreads-polyfill*

    phpunit tests

If *pthreads* is loaded by your configuration the polyfill will not be used.

Testing test code coverage for *pthreads-polyfill*

	phpdbg -nqrr vendor/bin/phpunit tests --coverage-text

Command tells phpdbg not to load any php.ini so that polyfill is used.
