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
		print $did, "\n";
		return $did;
	}
	
	return undef;
}

sub nextValue
{
	my ($dids) = @_ ;

	my ($value, @arr);
	
	#еще нужно отработать ситуацию где 4коровы или в 8ми разных цифр по 2 коровы

	#если есть цифры которые были не задейcтвованы то задействовать их
	
	for(0..9)
	{
		my $temp = $dids->{$_};
		
		my $count = @$temp;

		push @arr, "$_" if(!$count);

		$count = @arr;

		last if ($count == 4);
	}
	
	my $count = @arr;
	
	for my $i ($count + 1 .. 4)
	{	
		for my $j(0..9)
		{	
			my ($bool) = 0;
			
			my $tempArr = $dids->{$j};
			
			for(@$tempArr)
			{
				if(!$_->{'cow'})
				{
					$bool = 1;
					last;
				}
				elsif($_->{'bull'})
				{
					last unless("$j" ~~ @arr);
				}
				elsif($i == $_->{'position'})	
				{
					$bool = 1;
					last;
				}
			}

			next if($bool);

			next if("$j" ~~ @arr);

			push @arr, "$j";

			last
		}
	}
	
	for(@arr)
	{
		$value .= "$_";
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

	#step 1 

	my $st1 = cow($origin, $startdid);
	
	$dids->setValue($startdid, $st1->{'cow'}, $st1->{'bull'});

	mlog($origin, $startdid, $st1, 1);
	

	#step 2
	# origin = 3748 start=7986	
	

	my ($result) = endstep(\@indidgit, \@none, $st1, $startdid);
	
		

	if($result)
	{
		return ($result, 1); 
	}
	else
	{
		my (@didgits) = split(//,$startdid);
		
		my (@temp);

		for(1..$st1->{'cow'})
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

	$dids->setValue($second, $st2->{'cow'}, $st2->{'bull'});
	($result) = endstep(\@indidgit, \@none, $st2, $second);
	#print Dumper $dids;
	#step other
	
	my ($step) = 2;	

	if($result)
	{
		return ($result, 2); 
	}

	for(1..2)
	{
		$step++;
		
		my ($value) = nextValue($dids);

		my $st3 = cow($origin, $value);

		$dids->setValue($value, $st3->{'cow'}, $st2->{'bull'});
		
		mlog($origin, $value, $st3, $step);

		($result) = endstep(\@indidgit, \@none, $st3, $value);

		if($result)
		{
			return ($result, $step); 
		}	

	}
			
}

sub test
{
	my $d = Didgits->new();
	
	my (%temp) = ('rr'=>2, 'ee' => 18);
	my (%temp2) = ('rr1'=>23, 'ee1' => 48);

	push $d->{'1'}, {%temp};
	push $d->{'1'}, {%temp2};
	

	#print Dumper $d;
	
	my $tarr = $d->{'1'};
	
	my $count = @$tarr;

	print "count = $count\n";

	for(@$tarr)
	{
		print Dumper $_;
		print $_->{'rr'};
	}	

}

sub main
{
	bustCustumCharactersRecursion([1,2,3,4,5,6,7,8,9,0], '', 4 );

	my $count = @DIDGITS;
	
	for	(0..0)
	{
		my $r = int(rand($count));
		
		game($DIDGITS[$r]);

		#print $DIDGITS[$r], "\n";	
	}
	
	#test();	
}

main();
