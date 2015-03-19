$(function(){
	WordCloud(
			document.getElementById('wordCloudCanvas'), 
			{ list: WordCloudWords,
			
			  gridSize: 20,//Math.round(16 * $('#wordCloudCanvas').width() / 4000),
			  weightFactor: function (size) {

			    return size * $('#wordCloudCanvas').width() / 25;
			  },
			  rotateRatio: 0,
			  fontFamily: '"Helvetica Neue",Helvetica,Arial,sans-serif',
			  color: '#fff',
			  hover: window.drawBox,
			  click: function(item) {
			  	window.location.replace($("#base_url").val() + "story/search?q=" + item[0]);
			    //alert(item[0] + ': ' + item[1]);
			  },
			  backgroundColor: 'transparent'		
		 });	
});

