<?php
/*
Ceres Control Panel

This is a control pannel program for Athena and Freya
Copyright (C) 2005 by Beowulf and Nightroad

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

To contact any of the authors about special permissions send
an e-mail to cerescp@gmail.com
*/

session_start();
include_once 'config.php'; // loads config variables

if (!isset($GET_img))
	exit(0);

$session = $_SESSION[$CONFIG_name.'sessioncode'];
$code = $session[$GET_img];

$im = imagecreate(55, 15);
$bg = imagecolorallocate($im, 255, 255, 255);
$textcolor = imagecolorallocate($im, 0, 0, 255);
imagecolortransparent($im, $bg);
imagestring($im, 5, 0, 0, substr(strtoupper(md5("Mytext".$code)), 0,6), $textcolor);
for ($i = 0; $i < 40; $i++) {
	$pixelcolor = imagecolorallocate($im, rand()%256, rand()%256, rand()%256);
	imagesetpixel($im, rand()%55 , rand()%15, $pixelcolor);
}
imagepng($im);
imagedestroy($im);

exit(0);
?>
