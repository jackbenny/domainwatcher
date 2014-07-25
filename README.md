# Domainwatcher #
Domainwatcher is meant to be a simple way to keep track of your domains
expiraion dates (so you don't miss to renew them).

## Usage ##
Just fill the array ($domains) with all yours domain names and the run the
script from a Bash-prompt (colors only work in Bash).
If the domain has less days than the treshold ($warnLevel) the domain name will
be marked in red, otherwise it will be marked in green. The script also prints
out how many days each domain has left until expiration.

## Thanks ##
The Color-class was found online at http://www.if-not-true-then-false.com/2010/php-class-for-coloring-php-command-line-cli-scripts-output-php-output-colorizing-using-bash-shell-colors/ so a thanks goes to 'If not true than false'.
