#!/bin/bash
files=$(find -name "*.php" -print)

for i in $files; do
    echo $i
    cat $i | grep -F "$1";
done
