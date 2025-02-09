#!/bin/bash

docker build . -t justchess:latest

docker run -d --name justchess --rm -p 127.0.0.1:5001:5000 justchess
