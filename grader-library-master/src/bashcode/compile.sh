#!/bin/bash

START=$(($(date +%s%N)/1000000));

### code you want to compile
FILENAME="$1";

### extension of code
EXT="$2";

### output filename of code
OUTPUT="$3";

if [[ -z "$FILENAME" && -z "$EXT" ]]; then
	echo "Invalid argument"
	echo "example: ./compile filename extension output_filename"
fi

function execution_time
{
	# Get Current Time (in milliseconds)
	END=$(($(date +%s%N)/1000000));
	echo "compile_time: $((END-START))"
	exit 0
}

######## COMPILING JAVA ########
if [[ $EXT == "java" ]]; then
	javac $FILENAME >/dev/null 2>cerr &
	EXITCODE=$?

	echo $EXITCODE
	execution_time
fi

####### COMPILING C or C++ #############
if [[ $EXT == "cpp" ]]; then

	g++ $FILENAME -O2 -o $OUTPUT >/dev/null 2>$OUTPUT &
	EXITCODE=$?
	
	echo "exit_code: $EXITCODE"
	execution_time

fi

if [[ $EXT == "c" ]]; then

	gcc $FILENAME -O2 -o $OUTPUT >/dev/null 2>$OUTPUT &
	EXITCODE=$?
	
	echo "exit_code: $EXITCODE"
	execution_time

fi