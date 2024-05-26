#!/usr/bin/env python3

"""
Read unicode text files and output a list of unicode ranges used by the characters in the file.

Prerequisites:
- Install fonttools from https://github.com/fonttools/fonttools
- Install woff2 compressor from https://github.com/google/woff2
- Download the Jigmo font from https://kamichikoichi.github.io/jigmo/ and extract it to a directory

Usage:
./choose_unicode_ranges.py <input_file> <jigmo_dir>
input_file is supposed to be 嬉笑集.html for this case
"""


import subprocess
import sys

with open(sys.argv[1], 'r', encoding='utf-8') as f:
    data = f.read()
    used_codepoints = set(ord(c) for c in data)

# convert to ranges in the form of U+XXXX-U+XXXX
ranges = []
start = None
end = None
for cp in sorted(used_codepoints):
    if start is None:
        start = cp
        end = cp
    elif cp == end + 1:
        end = cp
    else:
        ranges.append((start, end))
        start = cp
        end = cp

arg1 = []
arg2 = []
arg3 = []
for r in ranges:
    if r[-1] < 0x20000:
        which_arg = arg1
    elif r[-1] < 0x30000:
        which_arg = arg2
    else:
        which_arg = arg3

    if r[0] == r[1]:
        which_arg.append("U+%04X" % r[0])
    else:
        which_arg.append("U+%04X-%04X" % r)



cmd1 = ["pyftsubset", sys.argv[2] + "/Jigmo.ttf", "--unicodes=" + ",".join(arg1), "--output-file=./Jigmo1Subset.ttf"]
cmd2 = ["pyftsubset", sys.argv[2] + "/Jigmo2.ttf", "--unicodes=" + ",".join(arg2), "--output-file=./Jigmo2Subset.ttf"]

# XXX: Somehow this doesn't seem to work. I'm too unfamiliar with the fonttools
# and font formats/fundamentals to debug this. So we're just going to use the
# whole font for this one. Still keeping this here for reference/completeness.
cmd3 = ["pyftsubset", sys.argv[2] + "Jigmo3.ttf", "--unicodes=" + ",".join(arg3), "--output-file=./Jigmo3Subset.ttf"]

print(cmd1)
print(cmd2)
print(cmd3)

subprocess.run(cmd1)
subprocess.run(cmd2)
subprocess.run(cmd3)

# Merge the subsets, note that we're not using the third subset, see comments above.
cmd4 = ["pyftmerge", "./Jigmo1Subset.ttf", "./Jigmo2Subset.ttf", sys.argv[2] + "/Jigmo3.ttf", "--output-file=./JigmoForHeiSiuZaap.ttf"]
cmd5 = ["woff2_compress", "./JigmoForHeiSiuZaap.ttf"]
subprocess.run(cmd4)
subprocess.run(cmd5)
