#!/usr/bin/env perl 
#===============================================================================
#
#         FILE: bolshMen.pl
#
#        USAGE: ./bolshMen.pl  
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
#      CREATED: 15.02.2016 14:17:43
#     REVISION: ---
#===============================================================================

use strict;
use warnings;
use utf8;

my ($USD, $RUR) = (27, 0.33);

sub getRate
{
	my ($code, $min) = @_;
	
	my ($percent) = 1.75;	
		
	my (@usd) = (0.1, 0.2, 1, 3, 5, 10, 20, 50, 100); # code = 1
	my (@rub) = (1, 5, 50, 150, 250, 500, 1000, 2500, 5000); #code = 2
	my (@grn) = (0.25, 1, 20, 60, 100, 200, 400, 1000, 2000 );# code = 3

	my (@full) = (@grn);

	if ($min )
	{
		if ( 1 == $code)
		{
			$min = $min * $USD;
		}
		elsif(2 == $code)
		{
			$min = $min * $RUR;
		}
	}

	
	
	for (@usd)
	{
		push @full, $USD * $_; 
	}	

	for (@rub)
	{
		push @full, $RUR * $_;
	}
	
	my ($n, $min) = (0, 0);

	(@full) = sort { $a <=> $b } @full;
	
	return (@full);
		
	my $count = @full;
	
	for my $step (0..$count)
	{	
		my ($minInStep) = 0;
		my $R = $min * $percent;
		for (@full)
		{
			if($_ * $percent  >= $min+$_)
			{
				$minInStep = $_;
				last;
			}
		}
	
		print $step, ") ", $minInStep, "\tmin=", $min,"\twin: ",$minInStep * $percent ,"\n";

		$min += $minInStep;		
	}
	
	

	
	

}



sub main
{
	my ($wrong, $maxWrong) = (0, 0);
	#1	3	5	50	100	150	250	500	750
	
	my (@arr) = getRate();#(1, 3, 5 );
	
	my ($rate) = $arr[0];
	my ($sum) = 0;

	for (1..1000)
	{
		#print "start( sum: $sum\trate: $rate) \n";

		my ($r) = int(rand(100))%2;
		
		$sum = $sum - $rate;

		if ($r)
		{
			$wrong++;
			$maxWrong = $wrong if ($wrong > $maxWrong);
				

			my $count = @arr;
			
			for (0 .. $count-1)
			{
				if ($rate < $arr[$_])
				{
					$rate = $arr[$_];
					last;
				}
			}
		} 
		else
		{
			$wrong = 0;
			$sum = $sum + $rate * 1.7;
			$rate = $arr[0];
		}
		
		#print "end ( sum: $sum\trate: $rate\tr:$r) \n\n";

	}

	print "maxWrong:", $maxWrong, "\n";
	print "sum: ", $sum, "\n";
}

main();
#getRate

