	<link type="text/css" href="http://jqueryui.com/latest/themes/base/ui.all.css" rel="stylesheet" />
	<script type="text/javascript" src="http://jqueryui.com/latest/jquery-1.3.2.js"></script>
	<script type="text/javascript" src="http://jqueryui.com/latest/ui/ui.core.js"></script>
	<script type="text/javascript" src="http://jqueryui.com/latest/ui/ui.slider.js"></script>
	<style type="text/css">
		#sq_pos { margin: 10px; width: 500px;}
		#sq_scale { margin: 10px; height: 40px;}
		.sq_slider { font-size: 62.5%; }
	</style>
	<script type="text/javascript">
		var base_width = <?=$base_width?>;
		var base_height = <?=$base_height?>;
		var sq_width=new Array();
		var sq_height=new Array();
		var sq_img_url=new Array();
		var current_squirrel = 2;
		sq_width[1] = 54;
		sq_height[1] = 100;
		sq_img_url[1] = 'data/squirrel_small.png';
		sq_width[2] = 81;
		sq_height[2] = 150;
		sq_img_url[2] = 'data/squirrel_medium.png';
		sq_width[3] = 117;
		sq_height[3] = 216;
		sq_img_url[3] = 'data/squirrel_large.png';
		$(document).ready(function(){
			// HORIZONTAL
			$("#sq_pos").slider({min: 0, max: base_width, value: base_width/2, change: function() {
				var x_value = Math.floor($('#sq_pos').slider('option', 'value') - (sq_width[current_squirrel] / 2));
				document.sq_data.sq_pos_x.value = x_value;
				$("#squirrel_image").css("left", x_value);
			}});
			// VERTICAL
			$("#sq_scale").slider({orientation: 'vertical', min: 1, max: 3, value: 2, change: function() {
				current_squirrel = $('#sq_scale').slider('option', 'value');
				var y_value = base_height - sq_height[current_squirrel];
				document.sq_data.sq_image.value = current_squirrel;
				document.sq_data.sq_pos_y.value = y_value;
				$("#squirrel_image").attr('src', sq_img_url[current_squirrel]);
				$("#squirrel_image").css("top", y_value);
				// RESIZING SQUIRREL IMAGE MEANS WE HAVE TO RECALC X VALUES
				var x_value = Math.floor($('#sq_pos').slider('option', 'value') - (sq_width[current_squirrel] / 2));
				document.sq_data.sq_pos_x.value = x_value;
				$("#squirrel_image").css("left", x_value);
			}});
		});
	</script>