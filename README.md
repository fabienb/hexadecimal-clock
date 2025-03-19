# Hexadecimal Clock

_If this is helpful to you in any way, please consider donating via [Paypal](https://paypal.me/fabienbutazzi) or use the Sponsor links in the sidebar to support this work and future enhancements._

## About

I wrote this fun 'hexadecimal clock' on CodePen in 2013. It simply displays the current time as a HEX colour code, filling the background with the relative colour. I believe it was inspired by a similar project, but I was unable to find it again after all these years.
These are the HTML, CSS and JS that made everything possible:

```html
<div id="hex-clock"></div>
```

```css
/*styling #hex-clock*/
/*custom font - Lato*/
@import url("[YOUR_FAVOURITE_FONT_URL_HERE]");
* {margin: 0; padding: 0; /*reset*/}
html, body {height: 100%; /*full-height*/}
#hex-clock {
	color: white; font: 36px/72px [FONT_REFERENCE_HERE]; height: 72px;
    /*centering*/
	position: relative; top: 50%; margin-top: -32px;
	text-align: center;
}
```

```javascript
var d, h, m, s, color;
function displayTime() {
	d = new Date();
	h = d.getHours();
	m = d.getMinutes();
	s = d.getSeconds();
	
	//add zero to the left of the numbers if they are single digits
	if(h <= 9) h = '0'+h;
	if(m <= 9) m = '0'+m;
	if(s <= 9) s = '0'+s;
	
	color = "#"+h+m+s;
	document.body.style.background = color;
	document.getElementById("hex-clock").innerHTML = color;
	
	//retrigger every second
	setTimeout(displayTime, 1000);
}

displayTime();
```

## Reprise

Late 2024, I wanted to convert this into a single PHP snippet to use in my WordPress blogs via a shortcode, probably something like `[hexclock]`, displaying this fun hexadecimal clock. 

The new version needed to:
- Get rid of the jQuery dependency in favour of pure Javascript
- Use `requestAnimationFrame` instead of `setTimeout`. This is generally preferred for animations because it is synchronised with the browser’s repaint cycle. This leads to smoother visuals and better performance, especially when dealing with frequent updates like this clock.
- Apply the background change to the container `div` rather than the body

This is the updated version, currently displayed at the bottom of the home page on [koandesign.com](https://koandesign.com):

```php
<?php
/*
Snippet Name: Hexadecimal Clock
Snippet URI: https://koan.design
Description: Fun clock that displays the current time into as a HEX colour code with an ever-changing background. Creates a shortcode to include anywhere in WordPress.
Version: 1.2
Author: (c) Fabien Butazzi - @fabienb
Author URI: https://koandesign.com
Text Domain: koandesign
*/

function hex_clock_shortcode() {
		$output = '<div id="hex-clock"></div>';

		$output .= '<style>
				#hex-clock {color:white;font:32px/72px unigeo64light,sans-serif;height:72px;position:relative;top:50%;text-align:center;}
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
```

Unigeo64 is the beautiful font created by [Zetafonts](https://www.zetafonts.com/unigeo) in use on koandesign.com, hence the `unigeo64light` reference above. 
You can always decouple the HTML, CSS and JS parts from this code, if you don't run WordPress and want to implement this elsewhere.

## License

This plugin is licensed under the [GNU General Public License v2 or later](LICENSE).
Leaving the copyright notice intact is appreciated, but not required.

