var flickrUrl = 'https://api.flickr.com/services/rest/?format=json',
  pathArray = window.location.pathname.split('/'),
  lastPartURL = pathArray[pathArray.length-2],
  startSlideshowButton;

function photoFail(a, b, c) {
  console.log(a,b,c);
  $('.photos').append('<p class="error">Er ging iets mis bij het ophalen van de foto\'s. Blijft dit gebeuren? <a href="/contact">Neem dan alstublieft contact op</a>.</p>');
}

function insertCollections(response) {
  var collections = response.collections.collection,
      setHTML,
      photoURL;
  for(var key in collections) {
    if(collections.hasOwnProperty(key)) {
      var coll = collections[key];
      setHTML = $('<div class="collection"><h2>' + coll.title + '</h2></div>');
      for(var key in coll.set) {
        if(coll.set.hasOwnProperty(key)) {
          var ps = coll.set[key];
          console.log(ps);
          psURL = 'https://farm' + ps.farm + '.staticflickr.com/' + ps.server + '/' + ps.primary + '_' + ps.secret + '_q.jpg';
          photosetHTML = $('<a class="photoset" href="' + ps.id + '">' + ps.title + '</a>');
          setHTML.append(photosetHTML);
        }
      }
      $('.photos').append(setHTML);
    }
  }
  $('.loading').remove();
}

function getCollections() {
  $.ajax({
    url: flickrUrl,
    dataType: 'JSON',
    data: {
      method: 'flickr.collections.getTree',
      api_key: flickr.api_key,
      user_id: flickr.user_id,
      nojsoncallback: 1
    }
  }).done(insertCollections).fail(photoFail);
}

function insertPhotos(response) {
  var photos = response.photoset.photo,
      album = $('<div class="album"></div>');
  album.append($('<a href="../" class="back-to-albums">Terug naar de albums</a>'));
  $('h1').text(response.photoset.title);

  for(var key in photos) {
    if(photos.hasOwnProperty(key)) {
      var p = photos[key];
      pURL = 'https://farm' + p.farm + '.staticflickr.com/' + p.server + '/' + p.id + '_' + p.secret + '_b.jpg';
      tURL = 'https://farm' + p.farm + '.staticflickr.com/' + p.server + '/' + p.id + '_' + p.secret + '_q.jpg';
      pHTML = $('<a class="photo fancybox" id="' + p.id + '" href="' + pURL + '" rel="group"><img src="' + tURL + '"></a>');
      pHTML.appendTo(album);
    }
  }

  album.append($('<a href="../" class="back-to-albums">Terug naar de albums</a>'));
  $('.photos').html(album);
  $.getScript(folder.static + 'fancybox.js').done(function() {
    $('.fancybox').fancybox({
      beforeShow: function() {
        location.hash = this.element.attr('id');
      }
    });
    if(location.hash !== undefined && location.hash !== "") {
      $(location.hash).trigger('click');
    }
  });

  startSlideshowButton = $('<button class="button">Start slideshow</button>');
  album.prepend(startSlideshowButton);
  startSlideshowButton.click(function() {
    $('.fancybox').first().click();
    setTimeout(function() {
      $.event.trigger({ type: 'keydown', which: 32 });
    }, 100);
  });
}

function getPhotos(id) {
  $.ajax({
    url: flickrUrl,
    dataType: 'JSON',
    data: {
      method: 'flickr.photosets.getPhotos',
      api_key: flickr.api_key,
      user_id: flickr.user_id,
      photoset_id: id,
      nojsoncallback: 1
    }
  }).done(insertPhotos).fail(photoFail);
}
