<?php
/*
Snippet Name: Hexadecimal Clock
Snippet URI: https://koan.design
Description: Fun clock that displays the current time into as a HEX colour code with an ever-changing background. Creates a shortcode to include anywhere in WordPress.
Version: 1.2
Author: Fabien Butazzi - @fabienb
Author URI: https://koandesign.com
Text Domain: koandesign
*/

function hex_clock_shortcode() {
		$output = '<div id="hex-clock"></div>';

		$output .= '<style>
				#hex-clock {color:white;font:32px/64px unigeo64light,sans-serif;height:64px;position:relative;top:50%;text-align:center;}
		</style>';

		$output .= '<script>
				//lets display the current time
				var d, h, m, s, color;
				function displayTime() {
						d = new Date(); //new data object
						h = d.getHours();
						m = d.getMinutes();
						s = d.getSeconds();

						//add zero to the left of the numbers if they are single digits
						if(h <= 9) h = "0"+h;
						if(m <= 9) m = "0"+m;
						if(s <= 9) s = "0"+s;

						color = "#"+h+m+s;
						//set background color
						document.getElementById("hex-clock").style.background = color; // Changed to hex-clock div
						//set time
						document.getElementById("hex-clock").innerHTML = color;

						//retrigger the function every second
						//setTimeout(displayTime, 1000); // original
						requestAnimationFrame(displayTime); // Use requestAnimationFrame instead of setTimeout
				}

				//call the function
				displayTime();
		</script>';

		return $output;
}
add_shortcode( 'hexclock', 'hex_clock_shortcode' );
?>
