$(function(){
	WordCloud(
			document.getElementById('wordCloudCanvas'), 
			{ list: WordCloudWords,
			
			  gridSize: Math.round(16 * $('#wordCloudCanvas').width() / $('#wordCloudCanvas').height()),
			  weightFactor: 12,
			  rotateRatio: 0,
			  fontFamily: '"Helvetica Neue",Helvetica,Arial,sans-serif',
			  color: '#fff',
			  hover: window.drawBox,
			  click: function(item) {
			  	window.location.replace($("#base_url").val() + "story/search?search=true&q=" + item[0]);
			    //alert(item[0] + ': ' + item[1]);
			  },
			  backgroundColor: 'transparent'		
		 });	
});

