#!/usr/bin/env perl 
#===============================================================================
#
#         FILE: me.pl
#
#        USAGE: ./me.pl  
#
#  DESCRIPTION: 
#
#      OPTIONS: ---
# REQUIREMENTS: ---
#         BUGS: ---
#        NOTES: ---
#       AUTHOR: YOUR NAME (), 
# ORGANIZATION: 
#      VERSION: 1.0
#      CREATED: 18.02.2016 14:28:08
#     REVISION: ---
#===============================================================================

use strict;
use warnings;
use utf8;


for(`ls nimg/*.jpg`)
{
	if($_ =~ /(\d+)/)
	{
		#print $1, "\n";
		`djpeg -grayscale -bmp nimg/$1.jpg > img/$1.bmp`
	}
}
