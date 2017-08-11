#! /bin/bash

## first file
FILE_ONE="$1"

## second file
FILE_TWO="$2"

diff -w $FILE_ONE $FILE_TWO &

exit 0;