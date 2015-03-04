$(function(){
	WordCloud(
			document.getElementById('wordCloudCanvas'), 
			{ list: WordCloudWords,
			
			  gridSize: Math.round(16 * $('#wordCloudCanvas').width() / 4000),
			  weightFactor: function (size) {

			    return size * $('#wordCloudCanvas').width() / 25;
			  },
			  rotateRatio: 0.1,
			  fontFamily: 'Finger Paint, cursive, sans-serif',
			  color: '#f0f0c0',
			  hover: window.drawBox,
			  click: function(item) {
			    alert(item[0] + ': ' + item[1]);
			  },
			  backgroundColor: '#485969'		
		 });

	
});

