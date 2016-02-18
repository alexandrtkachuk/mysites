#!/usr/bin/env perl 
#===============================================================================
#
#         FILE: crack2.pl
#
#        USAGE: ./crack2.pl  
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
#      CREATED: 18.02.2016 14:34:07
#     REVISION: ---
#===============================================================================

use strict;
use warnings;
use utf8;

use AI::FANN qw(:all);
use Data::Dumper;
use IO::File;


sub getByteFiles
{
	
	
	my $path = shift; ;

	my $fh = new IO::File "< $path" or die "Cannot open $path : $!";

	binmode($fh);

	my $buf;

	my $buflen = 4096;
	
	my ($count, @retArr) = 0;

	while (read($fh,$buf,$buflen)) 
	{
		# Тут работаем с блоком, считанным в $buf
		#print Dumper unpack('ss', $buf);

		@retArr = unpack "C*", $buf;
		$count++;
	}

	close($fh) or die "Error closing $path : $!";

	$count = @retArr;
	
	for ($count + 1 .. 100  )
	{
		push @retArr, 0;
	}

	return \@retArr;

}


sub train
{
	# create an ANN with 2 inputs, a hidden layer with 3 neurons and an
	# output layer with 1 neuron:
	#my $num_layers = 3;
	my $num_input = 100;
	my $num_neurons_hidden = 128; #
	my $num_neurons2_hidden = 128;
	my $num_output = 1;
	my $ann = AI::FANN->new_standard( $num_input, $num_neurons_hidden,  $num_output );
	
	$ann->hidden_activation_function(FANN_LINEAR);
	$ann->output_activation_function(FANN_LINEAR);
	
	#	FANN_LINEAR
	
	# create the training data for a XOR operator:	
	
	
	
	#$VAR1984
	my $train = AI::FANN::TrainData->new_empty(101, $num_input, 1);

	my $i = 0;
	

		
		
	my ($data);

	

	for (`ls img/` )
	{
		if ($_ =~ /(\d+).bmp/)
		{
			#print $1, "\n";
			$i++;
			$data = getByteFiles("img/$1.bmp") ;
			
			#print Dumper @$data;	
			my ($out) = $1;
			$train->data($i, [@$data], [$out]);

			last if ($i == 20);
		}	
	}

	#$i++;
	#$data =  toArr($_->{'value'});
	#$train->data($i, $data, [$_->{'result'}]);


	$ann->train_on_data($train, 2500, 100, 0.00001);

	$ann->save("xor.ann");
}


sub test 
{
	my $ann = AI::FANN->new_from_file("xor.ann");

	my $data = getByteFiles("test/1455798233.bmp") ;
	
	my $out = $ann->run($data);

	print Dumper $out;
	
	$data = getByteFiles("test/foo.bmp") ;

	$out = $ann->run($data);

	print Dumper $out;

}

sub mlog 
{
	my ($ret) = @_;
	
	my ($count) = 0;

	for (@$ret)
	{
		next if (!$_);
		print  $_, ' ';
		$count++ ; 
	}

	print "\ncount : $count \n";

}

sub prob
{


	my ($ret) = getByteFiles('img/0206.bmp');
	 mlog($ret);

	 ($ret) = getByteFiles('img/0296.bmp');
	 mlog($ret);
	
	 ($ret) = getByteFiles('img/0432.bmp');
	mlog($ret);
	
print "\n\n";

}

sub main
{

	#train();
	#test();	
	prob();
	return 0;

	my ($count, $max) =  (0, 0);

	for my $path (`ls img/*.bmp`)
	{
		$count = 0;

		my ($ret) = getByteFiles($path);



		for (@$ret)
		{
			#print  $_;

			$count++ if ($_);
		}

		$max = $count if ($count > $max);
	}

	print "\n max : $max \n";
}

main();
