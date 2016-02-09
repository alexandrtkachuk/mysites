
sub getFourValues
{
	my ($zero, $one, $two, $three, $four, $five, $six, $seven, $eight) = randomArr();
	
	my (@values) = 
		("$one$two$three$four", 
		"$four$five$six$seven", 
		"$three$four$eight$zero", 
		"$six$zero$three$four");
	
	return (@values);
}

sub perhapsAll
{
    my ($result, $values) = @_;

    my (@retArr);

    my $count = @$values;

    for my $x (@DIDGITS)
    {
	my ($flag) = 0;

	for my $i (0..$count - 1)
	{
	    my $st = cow($x, $$values[$i]);

	    if(
		!($st->{'cow'} eq $$result[$i]->{'cow'}) ||
		!($st->{'bull'} eq $$result[$i]->{'bull'})
	    )
	    {
		$flag = 1;
		last;
	    }
	}

	if (!$flag)
	{     
	    push @retArr, $x;
	}  
    }

    return (@retArr);
}

sub perhapsMin
{
    my ($result, $values, @minDidgits) = @_;

    my (@retArr);

    my $count = @$values;

    for my $x (@minDidgits)
    {
	my ($flag) = 0;

	for my $i (0..$count - 1)
	{
	    my $st = cow($x, $$values[$i]);

	    if(
		!($st->{'cow'} eq $$result[$i]->{'cow'}) ||
		!($st->{'bull'} eq $$result[$i]->{'bull'})
	    )
	    {
		$flag = 1;
		last;
	    }
	}

	if (!$flag)
	{     
	    push @retArr, $x;
	}  
    }

    return (@retArr);
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
	
	return 0 if (!$DEBUG);
		
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
	
	if($st->{'bull'} == 4)
	{
		#goooood
		print $did, "\n" if ($DEBUG);
		return $did;
	}
	
	return undef;
}

sub inArray
{
	my ($value, $arr) = @_;

	for(@$arr)
	{
		return 1 if ($_ eq $value);
	}

	return 0;
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


1;
