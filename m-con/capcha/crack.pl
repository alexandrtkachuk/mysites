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

 my $n =500;





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




if ($ARGV[0] eq 'train') {

	# create an ANN with 2 inputs, a hidden layer with 3 neurons and an
	# output layer with 1 neuron:
	#my $num_layers = 3;
	my $num_input = 2;
	my $num_neurons_hidden = 128; #
	my $num_neurons2_hidden = 2;
	my $num_output = 1;
	my $ann = AI::FANN->new_standard( $num_input, $num_neurons_hidden, $num_neurons2_hidden, $num_output );
	
	$ann->hidden_activation_function(FANN_LINEAR);
	$ann->output_activation_function(FANN_LINEAR);
	
	#	FANN_LINEAR
	
	# create the training data for a XOR operator:	
	
	my $train = AI::FANN::TrainData->new_empty(100, 32, 1);

	my $i =0;
	

	#a77a71df805cac85c78bf04a040fa11f  img/1
	#e3f962bdbd0cf69ed1576ab351111bdb  img/2
	#c1c5e9dd0b297bd8c87a180b85cf0d12  img/3
	#507d5b988599421fbf0d8f650b1bbc09  img/4
	#fb35179e06d2ba59efc0a858ed23e433  img/index.txt
	
	$i++;
	
	my ($data) =  toArr('a77a71df805cac85c78bf04a040fa11f');

	$train->data($i, $data, [6588]);
	#####################################################
	
	$i++;
	$data =  toArr('e3f962bdbd0cf69ed1576ab351111bdb');
	$train->data($i, $data, [2682]);
	####################################################
	
	$i++;
	$data =  toArr('c1c5e9dd0b297bd8c87a180b85cf0d12');
	$train->data($i, $data, [2359]);
	####################################################
	
	$i++;
	$data =  toArr('507d5b988599421fbf0d8f650b1bbc09');
	$train->data($i, $data, [3172]);
	####################################################
	
	$i++;
	$data =  toArr('fb35179e06d2ba59efc0a858ed23e433');
	$train->data($i, $data, [5245]);
	####################################################	

	$ann->train_on_data($train, 250000, 1000, 0.00001);

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

