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

my (@DIDGITS);

sub bustCustumCharactersRecursion
{
	my ($arr, $word, $count) = @_;

	$count--;

	for(@$arr)
	{
		if($count)
		{
			bustCustumCharactersRecursion($arr, $word . $_, $count);
		}
		else
		{
			#print $word.$_, "\n";
			createArr($word.$_);
		}
	}
}

sub createArr
{
	my ($word)= @_;
	
	my @arr=split(//,$word);
	
	for my $i (@arr)
	{
		my ($count) = 0;
		for my $j (@arr)
		{
			if($i eq $j)
			{
				$count++;
			}
		}
		if ($count > 1) {return 0;}
	}
	
	#print $word, "\n";
	push @DIDGITS, $word;
}

sub cow
{
	my ($origin, $test) = @_;

	my @origin = split(//,$origin);

	my @test = split(//,$test);
	
	my (%cows) = ('cow' => 0, 'bull' => 0);
	
	for (@test)
	{
		$cows{'cow'}++ if ($_ ~~ @origin);
	}	

	for(0..3)
	{
		$cows{'bull'}++ if($origin[$_] eq $test[$_] );
	}

	return \%cows;
}

sub mlog
{
	my ($origin, $test, $cow , $step) = @_;
	
	print "step ", $step, "\n";
	print "origin =", $origin, " start=", $test, "\n";

	print "cow:" , $cow->{'cow'}, " bull:" ,  $cow->{'bull'}, "\n";
}


sub endstep
{
	my ($none, $indidgit, $st, $did) =@_ ;

	if(!$st->{'cow'})
	{
		my (@temp) = split(//,$did);

		for(@temp)
		{
			push @$none, "$_";
		}
	}
	elsif($st->{'cow'} == 4)
	{
		my (@temp)	= split(//,$did);
		
		for(@temp)
		{
			push @$indidgit, "$_";
		}

	}
	elsif($st->{'bull'} == 4)
	{
		#goooood
		print $startdid, "\n";
		return $startdid;
	}
	
	return undef;
}

sub game
{
	my ($origin) = @_;
	
	my (@indidgit, @none);
	
	my ($startdid, $second, $thirty, $fourty);

	my (%did) = ('1' => -1, '2' => -1 , '3' => -1, '4' => -1);
	
	($startdid) = $DIDGITS[int(rand(5040))];

	#step 1 

	my $st1 = cow($origin, $startdid);
	
	mlog($origin, $startdid, $st1, 1 );

	#step 2
	# origin = 3748 start=7986	
	

	my ($result) = endstep(\@indidgit, \@none, $st, $startdid);

	if($result)
	{
		return $result; 
	}
	else
	{
		my (@didgits) = split(//,$startdid);
		
		my (@temp);

		for(1..4-$st1->{'cow'})
		{
			#pop @didgits;
			push @temp, $didgits[$_ - 1];
		}
		
		for(0..9)
		{
			next if( "$_" ~~ @didgits);
			
			push @temp, "$_";
			
			my $count = @temp;

			last if (4 == $count);
			
		}
		
		$second = "";

		for(1..4)
		{
			$second .= $temp[4-$_];
		}

	}
	
	my $st2 = cow($origin, $second);

	mlog($origin, $second, $st2, 2);

	#step 3
	
	if(!$st2->{'cow'})
	{
		my (@temp) = split(//,$second);

		for(@temp)
		{
			push @none, $_;
		}
	}
	elsif($st2->{'cow'} == 4)
	{
		 my (@temp)	= split(//,$second);

		for(@temp)
		{
			push @indidgit, $_;
		}
	}
	elsif($st2->{'bull'} == 4)
	{
		#goooood
		print $second, "\n";
		return $second;
	}
	elsif($st1->{'bull'})
	{
	
	}


	
}


sub main
{
	bustCustumCharactersRecursion([1,2,3,4,5,6,7,8,9,0], '', 4 );

	my $count = @DIDGITS;
	
	for	(0..0)
	{
		my $r = int(rand($count));
		
		#game($DIDGITS[$r]);

		#print $DIDGITS[$r], "\n";	
	}

	my (@temp) = (1,2);
	
	test(\@temp);

	print Dumper @temp;
}

main();
