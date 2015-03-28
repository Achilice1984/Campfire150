<style type="text/css">

.clock {
	margin-top: 100px;
	margin-bottom: 100px;
}
.clock-item .inner {
	height: 0px;
	padding-bottom: 100%;
	position: relative;
	width: 100%;
}
.clock-canvas {
	background-color: rgba(255, 255, 255, .1);
	border-radius: 50%;
	height: 0px;
	padding-bottom: 100%;
}
.text {
	color: #333;
	font-size: 30px;
	font-weight: bold;
	margin-top: -50px;
	position: absolute;
	top: 50%;
	text-align: center;
	width: 100%;
}
.text .val {
	font-size: 50px;
}
.text .type-time {
	font-size: 20px;
}
 @media (min-width: 768px) and (max-width: 991px) {
	.clock-item {
		margin-bottom: 30px;
	}
}
 @media (max-width: 767px) {
	.clock-item {
		margin: 0px 30px 30px 30px;
	}
}	
</style>


<div class="countdown-container container">
	<div class="clock row">
		<h2 style="display: table; margin: 0 auto; margin-bottom: 40px; font-size: 3em;"><?php echo gettext("Final Release"); ?></h2>
		<!-- days --> 
		<div class="clock-item clock-days countdown-time-value col-sm-6 col-md-3">
			<div class="wrap">
				<div class="inner">
				<div id="canvas_days" class="clock-canvas"></div>
					<div class="text">
						<p class="val">0</p>
						<p class="type-days type-time"><?php echo gettext("DAYS"); ?></p>
					</div>
				</div>
			</div>
		</div>

		<!-- hours --> 

		<div class="clock-item clock-hours countdown-time-value col-sm-6 col-md-3">
			<div class="wrap">
				<div class="inner">
					<div id="canvas_hours" class="clock-canvas"></div>
					<div class="text">
						<p class="val">0</p>
						<p class="type-hours type-time"><?php echo gettext("HOURS"); ?></p>
					</div>
				</div>
			</div>
		</div>

		<!-- minutes --> 
		<div class="clock-item clock-minutes countdown-time-value col-sm-6 col-md-3">
			<div class="wrap">
			<div class="inner">
				<div id="canvas_minutes" class="clock-canvas"></div>
					<div class="text">
						<p class="val">0</p>
						<p class="type-minutes type-time"><?php echo gettext("MINUTES"); ?></p>
					</div>
				</div>
			</div>
		</div>

		<!-- seconds --> 
		<div class="clock-item clock-seconds countdown-time-value col-sm-6 col-md-3">
			<div class="wrap">
				<div class="inner">
					<div id="canvas_seconds" class="clock-canvas"></div>
					<div class="text">
						<p class="val">0</p>
						<p class="type-seconds type-time"><?php echo gettext("SECONDS"); ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>