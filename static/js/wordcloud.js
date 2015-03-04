$(function(){
	WordCloud(
			document.getElementById('wordCloudCanvas'), 
			{ list: [['foo', 30], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6], ['bar', 6]],
			
			  gridSize: 19,
			  weightFactor: 3,
			  fontFamily: 'Finger Paint, cursive, sans-serif',
			  color: '#f0f0c0',
			  hover: window.drawBox,
			  click: function(item) {
			    alert(item[0] + ': ' + item[1]);
			  },
			  backgroundColor: '#485969'		
		 });
});