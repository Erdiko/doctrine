#!/bin/sh

CIRCLE_BRANCH="release"
CIRCLE_BRANCH="develop"

# decide which docker environment to bring up
if [ "$CIRCLE_BRANCH" == "release" ]; then
    echo "release"
else
    echo "not release"
fi
