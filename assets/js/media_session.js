if ('mediaSession' in navigator) {
  	navigator.mediaSession.metadata = new MediaMetadata({
    	artwork: [
          	{
            	src: 'https://menime.herokuapp.com/assets/img/icon.png', sizes: '128x128', type: 'image/png'
            }
      	]
    });
}