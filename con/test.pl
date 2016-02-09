#!/usr/bin/env perl 
#===============================================================================
#
#         FILE: test.pl
#
#        USAGE: ./test.pl  
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
#      CREATED: 09.02.2016 09:42:59
#     REVISION: ---
#===============================================================================

use strict;
use warnings;
use utf8;

my ($maxZero, $countZero, $countOne, $temp) = (0, 0, 0, 0);

for (1..1000000)
{
    my ($didgit) = int(rand(2));
    
    if($didgit)
    {
        $temp = 0;
        $countOne++;
    }
    elsif(!$didgit)
    {
        $countZero++;
        
        $temp++;
        
        $maxZero = $temp if ($temp > $maxZero);
    }
    else
    {
        print "error\n";
    }
}

print "maxZero: $maxZero\t";
print "countZero: $countZero\t";
print "countOne: $countOne\n";

