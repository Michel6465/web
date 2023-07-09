#! /bin/bash

echo "Compiling $1 ... "

# Get compiled path and basename	
filename=$(basename -- $1)
file="${filename%.*}" # Removes extension
compiled=./compiled-views/$file.php
cp -f -- $1 $compiled

# Replace syntaxic sugars
sed -i -r 's/(\{\{\?|@php)/<\?php/g' $compiled # {{?
sed -i    's/{{/<\?=/g' $compiled # {{
sed -i -r 's/\}\}|@endphp/\?>/g' $compiled # }}
sed -i -r 's/@endfor(each)?/<\?php endfor\1; \?>/g' $compiled # @endforeach / @endfor
sed -i -r 's/@for(each)? +\((.*?)\)/<\?php for\1 (\2): \?>/g' $compiled # @foreach() / @for()
sed -i -z 's/!!.*!!//g' $compiled # !! Comments (multiline)

# There are also sed tmp files
chmod g+x compiled-views/*.php

echo "Done."
