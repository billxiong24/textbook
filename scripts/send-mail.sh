#!/bin/bash

### REPLACE : WITH ; IF ON WINDOWS, NEED TO TEST ON MAC
ARGS=$@
# echo $ARGS
# echo $#
FILE_NAME='SendEmailAuto'
cd '../JavaFiles'
echo 'bill1313' | sudo -S javac -cp "../lib/*" 'SendEmailAuto.java'
echo 'bill1313' | sudo -S java -cp "../lib/*:." 'SendEmailAuto' $1 $2 $3 " ${4}" " ${5}" 
