#!/usr/bin/env perl 
#===============================================================================
#
#         FILE: crack.pl
#
#        USAGE: ./crack.pl  
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
#      CREATED: 16.02.2016 18:40:35
#     REVISION: ---
#===============================================================================

use strict;
use warnings;
use utf8;

use AI::FANN qw(:all);
use Data::Dumper;
use IO::File;

 my $n =500;

sub getData
{
	
	my (@arr);

	for(`md5sum nimg/*`)
	{
		#181c3398de088ced7539e03694cc1d09  nimg/8484.jpg
		my (%hash) ;
		if($_ =~ /(\w+)\s+\w+\/(\d+)/)
		{
			$hash{'value'} = $1;
			$hash{'result'} = $2;
			#print $1 , "\n";
			#print $2 , "\n";

			push @arr, \%hash;
		}
	}

	return \@arr;
}

#my $a = getData();
#print Dumper $$a[0]->{'result'};


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
	
	for ($count + 1 .. 3000  )
	{
		push @retArr, 0;
	}

	return \@retArr;

}

sub toArr
{
	my ($word) = @_;
	
	my (@arr) = split(//,$word);
	
	my (@retArr);
	
	for (@arr)
	{
		push @retArr, hex $_;
	}

	return \@retArr;
}

#print Dumper getByteFiles('nimg/2357.jpg');


#die();


if ($ARGV[0] eq 'train') {

	# create an ANN with 2 inputs, a hidden layer with 3 neurons and an
	# output layer with 1 neuron:
	#my $num_layers = 3;
	my $num_input = 3000;
	my $num_neurons_hidden = 64; #
	my $num_neurons2_hidden = 16;
	my $num_output = 1;
	my $ann = AI::FANN->new_standard( $num_input, $num_neurons_hidden, $num_neurons2_hidden, $num_output );
	
	$ann->hidden_activation_function(FANN_LINEAR);
	$ann->output_activation_function(FANN_LINEAR);
	
	#	FANN_LINEAR
	
	# create the training data for a XOR operator:	
	
	
	
	#$VAR1984
	my $train = AI::FANN::TrainData->new_empty(102, $num_input, 1);

	my $i =0;
	

	#a77a71df805cac85c78bf04a040fa11f  img/1
	#e3f962bdbd0cf69ed1576ab351111bdb  img/2
	#c1c5e9dd0b297bd8c87a180b85cf0d12  img/3
	#507d5b988599421fbf0d8f650b1bbc09  img/4
	#fb35179e06d2ba59efc0a858ed23e433  img/index.txt
	#f04441a1a0627f53ecfe508f1ee42f8f  nimg/4588-2.jpg
	
	$i++;
	
	my ($data);

	

	for (`ls nimg/` )
	{
		if ($_ =~ /(\d+).jpg/)
		{
			print $1, "\n";
			$i++;
			$data = getByteFiles("nimg/$1.jpg") ;
			
			#print Dumper @$data;	

			$train->data($i, $data, [$1]);
		}	
	}

	#$i++;
	#$data =  toArr($_->{'value'});
	#$train->data($i, $data, [$_->{'result'}]);


	$ann->train_on_data($train, 250000, 10, 0.00001);

	$ann->save("xor.ann");
}
elsif ($ARGV[0] eq 'test') 
{

	my $ann = AI::FANN->new_from_file("xor.ann");

	for my $a (-1, 1) {
		for my $b (-1, 1) {
			my $out = $ann->run([$a, $b]);
			printf "xor(%f, %f) = %f\n", $a, $b, $out->[0];
		}
	}

	my($a,$b) = (54,11);
	my $out = $ann->run([$a, $b]);
			printf "xor(%f, %f) = %f\n", $a, $b, $out->[0];

}
else 
{
	die "bad action\n"
}

