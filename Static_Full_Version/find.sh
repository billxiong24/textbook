#!/bin/bash
files=$(find -name "*.php" -print)

for i in $files; do
    echo $i
    cat $i | grep "width: 300%"
done
