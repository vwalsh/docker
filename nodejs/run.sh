#!/usr/bin/env bash

#docker build --quiet --tag codenodejs . && docker run --rm -it -v $(pwd)/output:/output codenodejs
docker build --quiet --tag codenodejs . && docker run --rm -it codenodejs
