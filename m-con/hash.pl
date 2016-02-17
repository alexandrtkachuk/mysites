#!/usr/bin/env perl 
#===============================================================================
#
#         FILE: hash.pl
#
#        USAGE: ./hash.pl  
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
#      CREATED: 16.02.2016 13:52:07
#     REVISION: ---
#===============================================================================

use strict;
use warnings;
use utf8;

use Digest::MD5 qw(md5_hex);


 
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
			tast($word.$_);
		}
	}
}


sub tast
{
	my ($word) = @_;
	
	my ($hash) = md5_hex($word);

	#590b40e05c9d57975a1b757692a69780 alexandrtai@gmail.com
	
	die("\n-- $word --\n") if ($hash eq '590b40e05c9d57975a1b757692a69780');
	
	return 0;
}

sub main 
{
	my (@chapters)= qw/1 2 3 4 5 6 7 8 9 0/;
	
	for(6 .. 25)
	{
		
		bustCustumCharactersRecursion(\@chapters, '0', $_ );

		print "end : ", $_, "\n";
	}
	print "none :(\n";
}

main();
