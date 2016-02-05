#!/usr/bin/env perl 
#===============================================================================
#
#         FILE: go.pl
#
#        USAGE: ./go.pl  
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

#1. определить какие именно эти 4 числа.
#2. при этом по возможности одну и туже цифру не ставить в одну и туже позицию.

require 'tools.inc';

sub getDidgits
{
	my ($dids, @arr) = @_;

	my $count = @arr;	
	
	my ($bull) = (0);
	
	my (@araysDidgits) =  randomArr();

	for my $i ($count + 1 .. 4)
	{			
		
		#вынисти отдельной функцией	
		for my $j (@araysDidgits)
		{	
			my ($bool, $notbull, $isbull, $isposition, $maxcows) = (0, 0, 0, 0, 0);
			
			my $tempArr = $dids->{$j};
			
			#если цифра была в комбинации хоть раз где небыло быка то она не бык!
				
			for(@$tempArr)
			{
				if(!$_->{'cow'})
				{
					$bool = 1;
					last;
				}	
				
				$notbull = 1 if(!$_->{'bull'});

				$isbull = 1 if($_->{'bull'});

				$isposition = 1 if($i == $_->{'position'});

				if (4 == $_->{'cow'})
				{
					$maxcows = 1;
					last;
				}

			}

				
			#print "pos: $isposition " . "isbull " .  $isbull ," j:$j" , " i: $i", " false : $bool \n";
			
			next if($bool);

			next if($dids->{'maxcows'} == 4 && !$maxcows);

			next if("$j" ~~ @arr);

			if ($isposition && !$isbull  )
			{
				next;
			}
						
			$bull++ if ($isposition && $isbull);
			
			
			push @arr, "$j";

			#print "pos: $isposition " . "bull " .  $isbull ," j:$j" , "bulls: $bull","\n";
			
			last;	
		}
	}

	return (@arr);
}

sub nextValue
{
	my ($dids) = @_ ;

	my ($value, @arr);
	
	#еще нужно отработать ситуацию где 4коровы или в 8ми разных цифр по 2 коровы

	#если есть цифры которые были не задейcтвованы то задействовать их
	
	if($dids->{'maxcows'} != 4 && ($dids->{'cow1step'}+$dids->{'cow2step'} < 4) )
	{
		my (@araysDidgits) =  randomArr();

		for(@araysDidgits)
		{
			my $temp = $dids->{$_};

			my $count = @$temp;

			push @arr, "$_" if(!$count);

			$count = @arr;

			last if ($count == 4);
		}
		
	}
	
	my $combs =	$dids->{'combs'};

	while(1)
	{
		(@arr) = getDidgits($dids, @arr);
		
		my $count = @arr;

		for(@arr)
		{
			$value .= "$_";
		}

		last if(($count == 4) && !inArray($value, $combs));
		
		$value = "";

		#print Dumper(@arr), "\n";

		@arr = ();

		#sleep(1);

		#print Dumper($dids);

		#die();
	}	
		
	
	return $value;
}

sub game
{
	my ($origin) = @_;
	
	my (@indidgit, @none);
	
	my ($startdid, $second, $thirty, $fourty);

	my ($dids) = Didgits->new();	
	
	($startdid) = $DIDGITS[int(rand(5040))];
	
	#$startdid =5241;
	
	#step 1 

	my $st1 = cow($origin, $startdid);
	
	$dids->setValue($startdid, $st1->{'cow'}, $st1->{'bull'});

	mlog($origin, $startdid, $st1, 1);
	

	#step 2
	# origin = 3748 start=7986	
	

	my ($result) = endstep(\@indidgit, \@none, $st1, $startdid);
	
		

	#step other
	
	my ($step) = 1;	

	if($result)
	{
		return ($result, 1); 
	}

	for(1..20)
	{
		$step++;
		
		my ($value) = nextValue($dids);

		my $resultStep = cow($origin, $value);

		$dids->setValue($value, $resultStep->{'cow'}, $resultStep->{'bull'});
		
		mlog($origin, $value, $resultStep, $step);

		($result) = endstep(\@indidgit, \@none, $resultStep, $value);

		if($result)
		{
			return ($result, $step); 
		}	

	}
	
	return 0;	
}

sub main
{
	bustCustumCharactersRecursion([1,2,3,4,5,6,7,8,9,0], '', 4 );	

	my $count = @DIDGITS;	
	
	my (@statistic);
	#statistics

	for	(0..0)
	{
		my $r = int(rand($count));
		#origin =6845 start=5241
		#game('6845');	
		#print $DIDGITS[$r], "\n";

        my ($result, $step) = game($DIDGITS[$r]);
		
		if($result)
		{
			#print $result ,' - ', $step ,"\n";

			push @statistic, $step;
		}
		else
		{
			#print "none \n";
		}
	}	


	my ($sum) = 0;

	for (@statistic)
	{
		$sum += $_;
	}
	
	$count = @statistic;

	print "statistic:" , $sum/$count, "\n"; 


}

main();
