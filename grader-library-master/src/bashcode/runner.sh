#! /bin/bash

####################### Check Memory and Time of a Process ############################
#
# Script written by Yusuf Syaifudin on Saturday, June, 21 2014 06:26 A.M.
# Website: http://yusyaif.com
# 
#
# Check memory and elapsed time of a process in very simple way
# program will be sandboxing with ./sandbox program
#
#
# How to use:
# please `sudo chmod 777 runner.sh` before using this bash script
# 
# to use:
# ./runner timeLimit    memoryLimit ./yourProgram input.txt output.txt
#          (in ms)     (in byte)
#
# example:
# to run program with limit time = 1second and memory = 1MB
# ./runner 1000 1048576 ./myProgram input.txt output.txt
#
#######################################################################################

## timeout
TIMELIMIT="$1";

## memory limit
MEMLIMIT="$2";

## program to run
PROGRAM="$3";

## input file
INPUT="$4";

## output file
OUTPUT="$5";


curDIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
SANDBOX="${curDIR}/sandbox"
# echo $SANDBOX

## Sandboxing program for maximum time 1 minute
## and $PROGRAM's time limit is $TIMELIMIT
## memory limit is $MEMLIMIT
## output file must not bigger than 30 MB
## redirect input and output to attached file

$SANDBOX 60000 $TIMELIMIT $MEMLIMIT 31457280 $PROGRAM < $INPUT > $OUTPUT &

exit 0;
