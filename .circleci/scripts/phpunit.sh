#!/bin/sh

# Run unit tests inside of docker
cd /code/vendor/erdiko/$PACKAGE/tests/
phpunit AllTests
