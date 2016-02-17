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

use Data::Dumper;
my ($USD, $RUR) = (27, 0.3);


sub game
{
	my ($usd, $rub, $grn, $code, $min) = @_;

	my ($next) ;

	if ($min)
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
	
	my ($temp, $index) = (10000);

	for my $i (0..8)
	{
		if (($$rub[$i] * $RUR) < $temp && ($$rub[$i] * $RUR) > $min)
		{
			$temp = $$rub[$i] * $RUR;
			$code = 2;
			$index = $i;
		}
		
		next;
		
		if (($$usd[$i] * $USD) < $temp && ($$usd[$i] * $USD) > $min)
		{
			$temp = $$usd[$i] * $USD;
			$code = 1;
			$index = $i;
		}
		
		if($$grn[$i] < $temp && $$grn[$i] > $min)
		{
			$code = 3;
			$temp = $$grn[$i];
			$index = $i;
		}	
	}
	
	my ($rate) ;

	if ($code == 1)
	{
		$rate = $$usd[$index];
	}
	elsif (2 == $code)
	{
		
		$rate = $$rub[$index];
	}
	elsif(3 == $code)
	{
		$rate = $$grn[$index];
	}


	return ($code, $rate);
}

sub addbalance
{
	my ($mU, $mR, $mG, $code, $rate) = @_;
	
	if ($code == 1)
	{
		$mU = $mU +  $rate;
	}
	elsif (2 == $code)
	{
		$mR += $rate;
	}
	elsif(3 == $code)
	{
		$mG += $rate;
	}


	return ($mU, $mR, $mG);
}

sub subbalance
{
	my ($mU, $mR, $mG, $code, $rate) = @_;
	
	if ($code == 1)
	{
		$mU = $mU -  $rate;
	}
	elsif (2 == $code)
	{
		$mR -= $rate;
	}
	elsif(3 == $code)
	{
		$mG -= $rate;
	}


	return ($mU, $mR, $mG);
}

sub mlog
{
	my ($mU, $mR, $mG) = @_;

	print "U: $mU\t";
	print "R: $mR\t";
	print "G: $mG\t";
	print "\n";
}

sub main
{
	my ($maxZero, $maxOne, $countZero, $countOne, $tempZ, $tempO) = (0, 0, 0, 0, 0, 0);

	my (@usd) = (0.01, 0.012 ,0.1, 0.2, 0.5, 1, 3, 5, 10, 25, 50); # code = 1
	my (@rub) = (1, 3, 5, 50, 150, 250, 500, 1250, 2500); #code = 2
	my (@grn) = (0.25, 0.75, 1, 20, 60, 100, 200, 500, 1000);# code = 3
	
	my (@arr) = game(\@usd, \@rub, \@grn, 1, 0);

	#print Dumper @arr;
	#return 0;

	my ($mU, $mR, $mG) = (300, 5000, 3000);

	my ($code, $rate) = (1,0);

	my ($st, $stepNotWin) = (0,0);	

	for (1..10000)
	{
		my ($didgit) = int(rand(2));
		
		$rate = 0 if ($rate > 2000);

		($code, $rate) = game(\@usd, \@rub, \@grn, $code, $rate);
		
		#$rate = $rus[0] if ($rate >= 50);

		($mU, $mR, $mG) = subbalance($mU, $mR, $mG, $code, $rate);
		
		if($st == $didgit )
		{
			($mU, $mR, $mG) = addbalance($mU, $mR, $mG, $code, $rate*1.9);

			$code = 1;
			$rate = 0;

			$st = int(!$st);

			$stepNotWin = 0;
		}
		else
		{
			$stepNotWin++;

			#$st = int(!$st) if ($stepNotWin > 9);
		}
		
		#mlog($mU, $mR, $mG);
		


		if($didgit)
		{
			$tempZ = 0;
			$countOne++;	
			$tempO++;

			$maxOne = $tempO if ($tempO > $maxOne);

		}
		elsif(!$didgit)
		{		
			$countZero++;

			$tempZ++;
			
			$tempO = 0;

			$maxZero = $tempZ if ($tempZ > $maxZero);
		}
		else
		{
			print "error\n";
		}

	}
	
	mlog($mU, $mR, $mG);

	print "maxZero: $maxZero\t";
	print "maxOne: $maxOne\t";
	print "countZero: $countZero\t";
	print "countOne: $countOne\n";
}

main();


