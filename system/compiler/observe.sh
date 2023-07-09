#!/bin/bash

function watch {
	while true
	do
		local ATIME=`stat -c %Z $1`

		if [[ "$ATIME" != "$LTIME" ]]
		then
			local LTIME=$ATIME
			./system/compiler/viewCompiler.sh $1
		fi
		sleep 0.05
	done
}


for f in views/*.cphp
do
	watch $f &
done
