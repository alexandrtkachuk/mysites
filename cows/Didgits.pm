#
#===============================================================================
#
#         FILE: Didgits.pm
#
#  DESCRIPTION: 
#
#        FILES: ---
#         BUGS: ---
#        NOTES: ---
#       AUTHOR: YOUR NAME (), 
# ORGANIZATION: 
#      VERSION: 1.0
#      CREATED: 04.02.2016 15:19:44
#     REVISION: ---
#===============================================================================
package Didgits;

use strict;
use warnings;



sub new
{

	my $class = ref($_[0])||$_[0];
	return bless(
		{   	
			'0' => [],
			'1' => [],
			'2' => [],   
			'3' => [],
			'4' => [],
			'5' => [],
			'6' => [],
			'7' => [],
			'8' => [],
			'9' => []
			,'none' => []
			,'maxbulls' => 0
			,'maxcows' => 0 
		},
		$class);
}

sub setValue
{
	my ($self, $value, $cow, $bull) = @_;

	my (@temp) = split(//,$value);
	
	my ($position) = 1;

	for(@temp)
	{
		my (%val) = (
			'cow' => $cow , 
			'bull' => $bull,
			'position' => $position
		);
		
		push $self->{$_}, {%val};

		$position++;
	}

	$self->{'maxcows'} = $cow if ($self->{'maxcows'} < $cow);

	$self->{'maxbulls'} = $bull if ($self->{'maxbulls'} < $bull);
}





1;
