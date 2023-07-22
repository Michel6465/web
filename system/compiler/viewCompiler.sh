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
sed -i -r 's/@end(for(each)?|if)/<\?php end\1; \?>/g' $compiled # @endforeach / @endfor /@endif
sed -i -r 's/@for(each)? +\((.*?)\)/<\?php for\1 (\2): \?>/g' $compiled # @foreach() / @for()
sed -i -r 's/@if +\((.*?)\)/<\?php if (\1): \?>/g' $compiled # @if()
sed -i -r "s/@include *\(['"'"'"](.*?)['"'"'"]( ?, ?(.*))?\)/<\?php \$_param=\3; require_once '\1'; unset\(\$_param\); \?>/g" $compiled # @include
sed -i -z 's/!!.*!!//g' $compiled # !! Comments (multiline)

# There are also sed tmp files, thus select only the .php
chmod g+x compiled-views/*.php

echo "Done."
