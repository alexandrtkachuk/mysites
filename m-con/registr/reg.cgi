#!/usr/bin/env perl 
#===============================================================================
#
#         FILE: reg.pl
#
#        USAGE: ./reg.pl  
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
#      CREATED: 18.02.2016 16:32:22
#     REVISION: ---
#===============================================================================

use strict;
use warnings;
use utf8;
use CGI qw/:standard/;


use WWW::Curl::Easy;

my ($COOKE) = '/tmp/first.cooks';
my $URL = '';


#print "Hello, world!";



sub SendParamsPost
{
	my ($host, $port, $url, $params) = @_;
	my ($curl) = WWW::Curl::Easy->new;
	
	my @authHeader = (
		'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36',
		'language: ru,en-US;q=0.8,en;q=0.6,uk;q=0.4'
		,'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8'
		,'Connection: keep-alive'
		,'Upgrade-Insecure-Requests: 1'
		#,'Accept-Encoding: gzip, deflate'
		#,'Referer: https://www.google.com.ua/'
		
	);

	$curl->setopt(CURLOPT_HEADER, 0);
	$curl->setopt(CURLOPT_HTTPHEADER, \@authHeader);
	$curl->setopt(CURLOPT_AUTOREFERER, 1);
	$curl->setopt(CURLOPT_FOLLOWLOCATION, 0); #disable auto riderect 
	$curl->setopt(CURLOPT_FAILONERROR, 0);	
	$curl->setopt(CURLOPT_CONNECTTIMEOUT, 0);
	$curl->setopt(CURLOPT_TIMEOUT, 120);
	$curl->setopt(CURLOPT_URL, $url);	
	$curl->setopt(CURLOPT_COOKIEJAR, $COOKE);
	$curl->setopt(CURLOPT_COOKIEFILE, $COOKE);	
	$curl->setopt(CURLOPT_POSTFIELDS, $params);
	
	$curl->setopt(CURLOPT_PROXY, $host . ':' . $port);
	$curl->setopt(CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);

	my ($response_body);
	
	$curl->setopt(CURLOPT_WRITEDATA, \$response_body);

	my ($retcode) = $curl->perform;

	if ($retcode == 0) 
	{
		return ($curl->getinfo(CURLINFO_HTTP_CODE), $response_body); 
	} 
	else 
	{	
		print("An error happened: $retcode ".$curl->strerror($retcode)." ".$curl->errbuf."\n");
	}

}


sub ConnectTor
{
	my ($host, $port, $url) = @_;
	my ($curl) = WWW::Curl::Easy->new;
	
	my @authHeader = (
		'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36',
		'language: ru,en-US;q=0.8,en;q=0.6,uk;q=0.4'
		,'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8'
		,'Connection: keep-alive'
		,'Upgrade-Insecure-Requests: 1'
		#,'Accept-Encoding: gzip, deflate'
		#,'Referer: https://www.google.com.ua/'
		
	);

	$curl->setopt(CURLOPT_HEADER, 0); #echo header
	$curl->setopt(CURLOPT_HTTPHEADER, \@authHeader);
	$curl->setopt(CURLOPT_AUTOREFERER, 1);
	$curl->setopt(CURLOPT_FOLLOWLOCATION, 1);
	$curl->setopt(CURLOPT_FAILONERROR, 0);	
	$curl->setopt(CURLOPT_CONNECTTIMEOUT, 0);
	$curl->setopt(CURLOPT_TIMEOUT, 120);
	$curl->setopt(CURLOPT_URL, $url);


	$curl->setopt(CURLOPT_COOKIEJAR, $COOKE);
	$curl->setopt(CURLOPT_COOKIEFILE, $COOKE);
	
	$curl->setopt(CURLOPT_PROXY, $host . ':' . $port);
	$curl->setopt(CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
	
	my ($response_body);
	
	$curl->setopt(CURLOPT_WRITEDATA, \$response_body);

	my ($retcode) = $curl->perform;

	if ($retcode == 0) 
	{
		return ($curl->getinfo(CURLINFO_HTTP_CODE), $response_body); 
	} 
	else 
	{
		# Error code, type of error, error message
		print("An error happened: $retcode ".$curl->strerror($retcode)." ".$curl->errbuf."\n");
	}
}

#to https://igrun.com/reg.php
#"email_reg"
#name="psw1"
#name="psw2"
#name="fio"
#name=year
#name=month
#name=day
#name="sex" f or m
#name="name"
#name="curr" RUB
#name="tel" (not +)
#name="safecode"



sub image
{
	

	my ($code, $result) = ConnectTor('localhost', 9050, "http://$URL/?p=6");
	
	#<img id="imgCaptcha" src="captcha/captcha.php?uid=2016021817454163" width="120" height="60" />
		
	if ($result =~ /src="captcha\/captcha\.php\?uid=(\d+)/)
	{
		#print '<img id="imgCaptcha"',
		#'src="' , "http://$URL/captcha.php?uid=$1",
		#'" width="120" height="60" />';
		
		my ($code2, $result2) = ConnectTor('localhost', 
				9050, "http://$URL/captcha/captcha.php?uid=$1");

		print $result2;
		#print $1;
	}

	print $result;

}

sub main
{
	if (param('img') && param('img') eq 'get')
	{
		print "Content-type: 'Content-Type: application/jpg'\n\n";
		#print "Content-type: text/html\n\n";
		image();
	
	}
	else
	{
		print "Content-type: text/html\n\n";
		form();
	}

}

sub form
{

	if (param) 
	{
		print "<p>capcha:", param('q') , '</p>';

#"email_reg"
#name="psw1"
#name="psw2"
#name="fio"
#name=year
#name=month
#name=day
#name="sex" f or m
#name="name"
#name="curr" RUB
#name="tel" (not +)
#name="safecode"

		my ($mail, $pw1, $pw2, $fio, $name, $tel) = ('alexandrtai66613@mail.com'
			, 'ig091226', 'ig091226', 'Alexandr Me O', 'Sasha', '380928765523');

		my ($params) = 'email=' . $mail . "&psw1=$pw1&psw2=$pw2" 
		. "&fio=$fio"
		. "&name=$name"
		. "&year=1980&month=10&day=07"
		. "&sex=m&curr=RUB"
		. "&tel=$tel"
		. "&login=$mail"
		
		. "&captcha=" . param('q');
		
		#checkCapcha
		
		my ($code, $result) = 	
			SendParamsPost('localhost', 9050, 
				"http://$URL/api/checkCaptcha.php",  
				'captcha=' . param('q') );
		
		print $result;
		

		 ($code, $result) = 	
			SendParamsPost('localhost', 9050, "https://$URL/reg.php",  $params);
		
		
		

		print $params;

		print $result;

	}
	elsif(param)
	{
	
		for (param)
		{
			print $_ , " =", param($_) ,"<br/>";
		}
	}
	else
	{

	my ($test_str) = '<select id="year_select" name=year class=t>
			<option value=1900>1900</option>
			<option value=1901>1901</option>
			<option value=1902>1902</option>
		</select>
		
		<select id="day_select" name=day class=t  >
		<option value=0>--</option><option value=01>01</option>
		<option value=02>02</option>
		<option value=03>03</option>
		</select>


		<select id="month_select" name=month class=t  >
			<option value=0>--</option>
			<option value=01>01</option>
			<option value=02>02</option>
		</select>';

		print '<img id="imgCaptcha" src="reg.cgi?img=get" width="120" height="60" />';
		
		print '<form method="POST">'
		#,$test_str
			
		,'<input type="text" name="q">
		<p><input type="submit"></p>
		</form>';
	}
}

#form();
main();
#test();
#image();
