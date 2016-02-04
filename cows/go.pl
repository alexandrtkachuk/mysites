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
	my (@araysDidgits) =  randomArr();

	for(@araysDidgits)
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
		my ($bull) = (0);
		
		#вынисти отдельной функцией	
		for my $j(@araysDidgits)
		{	
			my ($bool, $notbull, $isbull, $isposition) = (0, 0, 0, 0);
			
			my $tempArr = $dids->{$j};
			
			#если цифра была в комбинации хоть раз где небыло быка то она не бык!
				
			for(@$tempArr)
			{
				if(!$_->{'cow'})
				{
					$bool = 1;
					last;
				}

				last if (4 == $_->{'cow'});

				$notbull = 1 if(!$_->{'bull'});

				$isbull = 1 if($_->{'bull'});

				$isposition = 1 if($i == $_->{'position'});
			}

			#print "pos: $isposition " . "bull " .  $isbull ," j:$j" ,"\n";	

			next if($bool);

			next if("$j" ~~ @arr);

			if ($isposition && $notbull )
			{
				next;
			}
			elsif($isposition && $bull >= $dids->{'maxbulls'})
			{
				next;
			}
			
			$bull++ if ($isposition && $isbull);
			
			
			push @arr, "$j";
			
			last;	
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
	
	$startdid =5241;
	
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

	for(1..10)
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
	
	#print Dumper $dids;	
}

sub randomArr
{
	my (@arr) = @_;
	
	my (@newarr);

	
	
	while(1)
	{
		my $i = int(rand(10));

		unless($i ~~ @newarr)
		{
			push @newarr, $i;	
		}
		
		my $count = @newarr;

		last if $count > 9;
	}

	return (@newarr);
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
		#origin =6845 start=5241
		game('6845');	
		#game($DIDGITS[$r]);

		#print $DIDGITS[$r], "\n";	
	}
	
	
	#test();	
}

main();
