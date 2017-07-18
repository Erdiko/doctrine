#!/bin/sh

# Install erdiko
composer create erdiko/erdiko erdiko --keep-vcs

# Swap out with latest code to be tested
rm -rf ./erdiko/vendor/erdiko/$PACKAGE
cp -R ./code ./erdiko/vendor/erdiko/$PACKAGE

cd erdiko
echo $CIRCLE_BRANCH
echo $PACKAGE

# decide which docker environment to bring up
if [ "$CIRCLE_BRANCH" == "release" ]; then
    docker-compose -f docker-compose-ci-regression.yml up -d
else
    docker-compose -f docker-compose-ci.yml up -d
fi

# copy code into container (Circle CI doesn't allow volume maps)
docker cp ./ erdiko_php:/code
docker cp ./ erdiko_web:/code

docker-compose ps
ls -lah
