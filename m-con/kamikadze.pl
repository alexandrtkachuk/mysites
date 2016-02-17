#!/usr/bin/env perl 
#===============================================================================
#
#         FILE: kamikadze.pl
#
#        USAGE: ./kamikadze.pl  
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
#      CREATED: 14.02.2016 23:49:17
#     REVISION: ---
#===============================================================================

use strict;
use warnings;
use utf8;

my ($longTime, $max, $count) = (0, 0, 0);

for (1..10000000)
{
    my ($r) = int(rand(5));
    
    #print $r, "\n";

    if (!$r)
    {
       $longTime++; 
       $count++;

       $max = $longTime if ($longTime > $max);
    }
    else
    {
       $longTime = 0;
    }

}

print "count : ", $count, "\n";
print "max : ", $max, "\n";

