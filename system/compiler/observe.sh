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

# If there is no *.cphp file, will return "./*.cphp", which is not what we want
shopt -s nullglob # Set glob to null
shopt -s nocaseglob # Case insensitive

for f in views/*.{cphp,php}
do
	watch $f &
done

shopt -u nullglob # Unset
shopt -u nocaseglob
