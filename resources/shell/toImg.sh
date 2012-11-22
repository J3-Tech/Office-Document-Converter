#!/bin/bash
case 'jpg' in 
	$1 )
	gs -dNOPAUSE -sDEVICE=jpeg -dFirstPage=1 -sOutputFile="$3/%d-$4.jpg" -dJPEGQ=100 -r$5 -q "$2" -c quit
	;;
esac
case 'png' in
	$1 )
	gs -dNOPAUSE -sDEVICE=png256 -dFirstPage=1 -sOutputFile="$3/%d-$4.png" -r$5 -q "$2" -c quit
	;;
esac
case 'bmp' in
	$1 )
	gs -dNOPAUSE -sDEVICE=bmp256 -dFirstPage=1 -sOutputFile="$3/%d-$4.bmp" -r$5 -q "$2" -c quit
	;;
esac
