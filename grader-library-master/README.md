# GRADER

This is a library to create an online judge system based on PHP. Now you can easily compile or even run your program from PHP with only one line of code. Do not worry about the risk of damage to the system by malicious programs, because this library uses openjudge/sandbox used in online judge system for *ACM/ICPC* training. Refer to: [https://openjudge.net/Solution/Sandbox](https://openjudge.net/Solution/Sandbox) and [https://github.com/openjudge/sandbox](https://github.com/openjudge/sandbox)

keyword: open judge, online judge php, laravel online judge


## INSTALLATION

You can download a copy or clone from this repository if you want. But, there are easy way to include this library in to your project using [Composer](https://getcomposer.org). Please include this in `require` composer.json:


```
require: {
	"yusufs/grader": "1.0"
}
```

## Setting up the library
Before using this library, there are several steps that must be done.

First, install `sandbox` library. I promise you need this, even at the first you say "WHAT THE HELL ABOUT THIS CONFIGURATION PROCESS". You need this to prevent malicious program damaging your system.

```
$ cd Yusufs/bashcode/Sandbox/libsandbox
$ ./configure
$ sudo make install
```

After that you have to compile the sandbox program. Compile sandbox.c with this following command: 

```
gcc sandbox.c -o sandbox -lsandbox
```

*Note:*

* Please note that you must compile the sandbox.c program to `sandbox` filename. This is convention. Otherwise, the judge will not be run.
* Do not to submit issues to the Sandbox, because it is an additional library from [https://github.com/openjudge/sandbox/](https://github.com/openjudge/sandbox/)

Please make this following file is `chmod 775`

- compile.sh
- diff.sh
- runner.sh
- sandbox


Finishing up!
Don't forget to make `storage` directory in the root of your project, since this library will save all file in there.

```
$ mkdir storage
```

for example if you are using laravel 4.2.* the tree structure will look like this:

- app
- bootstrap
- public
- vendor
- CONTRIBUTING.md
- artisan
- composer.json
- phpunit.xml
- readme.md
- server.md

Now you must have those tree look like this

- app
- bootstrap
- public
- *storage*
- vendor
- CONTRIBUTING.md
- artisan
- composer.json
- phpunit.xml
- readme.md
- server.md

### Done! Now you can use this library


## USAGE
Here's the flow:
* you make a file to save your code,
* you compile your code and now it called as 'program' (an executable program),
* you make an input to run your program,
* you run your 'program' with your input,
* you get the detail about status

Here's is the status code:
* PD 	= Pending
* OK 	= Okay
* RF 	= Restricted Function
* ML 	= Memory Limit Exceed
* OL 	= Output Limit Exceed
* TL 	= Time Limit Exceed
* RT 	= Run Time Error (SIGSEGV, SIGFPE, ...)
* AT 	= Abnormal Termination
* IE 	= Internal Error (of sandbox executor)
* BP 	= Bad Policy (since version 0.3.3 of openjudge/sandbox)


### Save the code or script

@param file extension
@param code

```
return Yusufs\Grader::saveScript("c", "YOUR-CODE-HERE");
```

example output

```
{
	success: true,
	message: "File saved!",
	detail: {
		filename: "script_12031364091415211460.c",
		path: "storage/scripts/",
		extension: "c"
	}
}
```

### Compile code to program

@param filename of script

```
return Yusufs\Grader::compile("script_12031364091415211460.c");
```

example output

```
{
	status: true,
	message: "Now you can run this program.",
	detail: {
		reason: "compiled",
		time: "3",
		time_unit: "ms",
		exit_code: "0",
		program_path: "storage/scripts/script_12031364091415211460.c"
	}
}
```


### Save the input

@param content of input

```
return Yusufs\Grader::saveInput("PROGRAM-INPUT-HERE");
```

example output

```
{
	success: true,
	message: "File saved!",
	detail: {
		filename: "input_7204332951415211535.txt",
		path: "storage/input/",
		extension: "txt"
	}
}
```


### Run the program

@param program filename (the same as the script name)
@param input filename
@param time limit (in seconds)
@param memory limit (in kiloBytes)

```
return Yusufs\Grader::run('script_12031364091415211460.c', 'input_7204332951415211535.txt', 1, 32000);
```

example output

```
{
	status: true,
	message: "You can now evaluate the result.",
	detail: {
		result: "OK",
		cpu: "519",
		vsize: "4288",
		rss: "356",
		cpu_unit: "ms",
		vsize_unit: "kB",
		rss_unit: "kB",
		filename: "1415212611_output_of_input_7204332951415211535.txt",
		path: "storage/output/"
	}
}
```

### Compare program
used to compare the output of the two programs at once

```
return Yusufs\Grader::compareProgram('script_7357485711415184458.cpp', 'script_7357485711415184458.cpp', 'input_7080103211415181065.txt', 1, 338592);
```

example output

```
{
	judge: {
		output_file_difference: false,
		output_file_similarity: true
	},
	program1: {
		status: true,
		message: "You can now evaluate the result.",
		detail: {
			result: "OK",
			cpu: "2",
			vsize: "12620",
			rss: "1064",
			cpu_unit: "ms",
			vsize_unit: "kB",
			rss_unit: "kB",
			filename: "1415212854_output_of_input_7080103211415181065.txt",
			path: "storage/output/"
		}
	},
	program2: {
		status: true,
		message: "You can now evaluate the result.",
		detail: {
			result: "OK",
			cpu: "2",
			vsize: "12620",
			rss: "1064",
			cpu_unit: "ms",
			vsize_unit: "kB",
			rss_unit: "kB",
			filename: "1415212854_output_of_input_7080103211415181065.txt",
			path: "storage/output/"
		}
	}
}
```

## A BACKGROUND
*there is no effect without cause* - Yusuf Syaifudin, November 6, 2014 01:51AM

This library was made in furtherance of college assignment (TUGAS KHUSUS), where I feel I write code that is less neat, it is difficult to overhaul. "So, why not just make the library?" I thought. For that this library is created.

## LICENSE
