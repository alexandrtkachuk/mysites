#!/usr/bin/env perl 
#===============================================================================
#
#         FILE: go.pl
#
#        USAGE: ./go.pl  
#
#  DESCRIPTION: 
#COWS - все совпавшие числа включая быков
#BULL - точное совпадение
#1. определить какие именно эти 4 числа.
#2. при этом по возможности одну и туже цифру не ставить в одну и туже позицию.
#
#также иследовать тактику и определить исключения
#
#1234
#4567
#3480
#6043
#      OPTIONS: ---
# REQUIREMENTS: ---
#         BUGS: ---
#        NOTES: ---
#       AUTHOR: A.Tkachuk (), 
# ORGANIZATION: 
#      VERSION: 1.0
#      CREATED: 02.02.2016 16:12:08
#     REVISION: ---
#===============================================================================

use strict;
use warnings;
use utf8;

use Data::Dumper;
use Didgits;

our (@DIDGITS);
our ($DEBUG) = 1;

require 'tools.inc';
require 'old.inc';


sub perhaps
{
    my ($result, $values, @arr) = @_;
	
	my (@retArr);

    my $count = @arr; 
	
	if ($count)
	{
		(@retArr) = perhapsMin($result, $values, @arr);
	}
	else
	{
		(@retArr) = perhapsAll($result, $values, @arr);
	}

    return (@retArr);
}


sub game2
{
    my ($origin) = @_;

    #getFourValues();
    
    my ($steps, @result, @resArr, @values) = (0);
	
	#'1234', '4567', '3480', '6043'

    for (getFourValues())
	{
		$steps ++;

		my $st = cow($origin, $_);

		return ($_, $steps) if (4 == $st->{'bull'});	

		push @result, $st;

		push @values, $_;	
		#(@resArr) = perhaps(\@result, \@values, @resArr);
	}
    
    (@resArr) = perhaps(\@result, \@values);

	my $count =  @resArr;

	if ( 1 == $count)
	{
		return (@resArr, $steps);
	}
	elsif(!$count)
	{
		return "error\n";
	}
	else
	{
		for(0..10)
		{
			$steps++;

			my $r = int(rand($count));
			
			my $st = cow($origin, $resArr[$r]);
			
			push @result, $st;
			push @values, $resArr[$r];

			(@resArr) = perhaps(\@result, \@values, @resArr);

			$count =  @resArr;	

			return (@resArr, $steps) if (1 == $count);
		}
	}

	return "none\n" ;
}

sub main
{
	
	bustCustumCharactersRecursion([1,2,3,4,5,6,7,8,9,0], '', 4 );	

	my $count = @DIDGITS;	
	
	my (@statistic);
	#statistics
    
    #game2('8956'); 
	
	my ($m) = 10;
	my ($s) = 1;

	my ($five, $min, $max) = (0,0,0);
	my ($maximumSt, $nogood) = (0,0); # $maximumSt - подряд печальки

	for	(0..20000)
    {
        my $r = int(rand($count));

		#print "m:", $m, , " l:", $_ ," \n";
        #origin =6845 start=5241
        #game('6845');	
        #print $DIDGITS[$r], "\n";

		my ($result, $step) = game2($DIDGITS[$r]);
		
		$m = $m - $s;
		
        if($result)
        {
			#print $result ,' - ', $step ,"\n";

			$five++ if (5 == $step);
			$min++ if (5 > $step);
			$max++ if (5 < $step);
			
            push @statistic, $step;

			if (5 >= $step)
			{
				$m += $s * 1.5;	

				$s = 1;	

				$nogood = 0;
			}
			else
			{
				if($s == 1)
				{
					$s = 5;
				}
				elsif($s == 5)
				{
					$s = 50;
				}
				elsif($s == 50)
				{
					$s = 150;
				}
				elsif($s == 150)
				{
					$s = 250;
				}
				elsif($s == 250)
				{
					$s = 500;
				}
				elsif($s == 500)
				{
					$s = 1000; 
				}
				elsif($s == 1000)
				{
					$s == 2500;
				}
				elsif($ == 2500)
				{
					$s = 5000;
				}

				$nogood++;

				$maximumSt =$nogood  if ($nogood > $maximumSt);	
			}

        }
        else
        {
            #print "none \n";
        }
    }	
	
	print "m:", $m, "\n";
	print "max b:$maximumSt \n";

    my ($sum) = 0;

    for (@statistic)
    {
        $sum += $_;
    }

    $count = @statistic;
    if($count)
    {
        print "statistic:" , $sum/$count, "\n";

		print "5:$five \t min:$min \t max:$max \n";	
    }

}

my $time = time;

main();

print "time:", time - $time, "\n";
