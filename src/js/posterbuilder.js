function builderInit() {
  let poster = jQuery('.js-poster'),
    posterHero = jQuery('.js-poster-hero'),
    posterStyling = jQuery('.js-poster-styling'),
    savePdf = jQuery('.js-save-pdf'),
    savePng = jQuery('.js-save-png'),
    imageInput = jQuery('.js-change-image'),
    colorControls = jQuery('.js-change-color');

  savePdf.click(function() {
    let printContents = poster[0].innerHTML,
      originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    builderInit();
  });

  savePng.click(function() {
    domtoimage.toPng(poster[0], { bgcolor: "#fff" }).then(function (dataUrl) {
      var img = new Image();
      img.src = dataUrl;
      console.log(dataUrl);
      window.open(dataUrl.replace(/^data:image\/[^;]/, 'data:application/octet-stream'));
    }).catch(function (error) {
        console.error('oops, something went wrong!', error);
    });
  });

  imageInput.bind('input', function(event) {
    let reader = new FileReader();
    reader.onload = function() {
     posterHero[0].src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
  });

  colorControls.click(function() {
    let desiredColor = jQuery(this).css('backgroundColor');
    posterStyling.html('body{--page-bg:' + desiredColor + '}');
  });
}
