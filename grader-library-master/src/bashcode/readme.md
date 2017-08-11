# Setting Up the bash runner
make sure you has been install the [openjudge/sandbox](https://github.com/openjudge/sandbox) library.

## Installing process

```
$ cd Sandbox/libsandbox
$ ./configure
$ sudo make install
```

After that you have to compile the sandbox program. 

Compile sandbox.c with this following command `gcc sandbox.c -o sandbox -lsandbox`

### Note
* Please note that you must compile the sandbox.c program to `sandbox` filename. This is convention. Otherwise, the judge will not be run.
* Do not to submit issues to the Sandbox, because it is an additional library from [https://github.com/openjudge/sandbox/](https://github.com/openjudge/sandbox/)


## Author
This code:

- compile.sh
- diff.sh
- runner.sh

is created by Yusuf Syaifudin <yusuf.syaifudin@gmail.com>

please make that file is chmod 775