jQuery(document).ready(onDocReady);

var userAction,
  form_failure = "Er is iets mis gegaan op de server, excuses voor het ongemak. Herlaadt de pagina en probeer het nog eens. Blijft het fout gaan? Mail dan naar helpdesk@scoutingoost1.nl.";

function onDocReady () {

  let $ = jQuery,
    menu = $('.site-menu'),
    header = $('.site-header'),
    adminForm = $('.administration'),
    rentalForm = $('.rental'),
    checkableInputs = $('input[type=radio], input[type=checkbox]'),
    textInputs = $('input, textarea, select'),
    nextButtons = $('.js-next'),
    speltakDefiners = $('[name=Geboortedatum], [name=Gender]'),
    addressDefiners = $('[name=Postcode], [name=Huisnummer]'),
    chooseActionButton = $('.js-choose-action'),
    chooseRentalTypeButton = $('.js-choose-rental-type'),
    ibanField = $('[name=IBAN]');

  ajaxurl = document.head.querySelector("[name=ajaxurl]").content;

  menuToggler(menu);
  menu.removeClass('opened');

  scrollMenu(header);
  prepAdminForm(adminForm);
  prepRentalForm(rentalForm);
  checkableInputs.bind('change', updateCheckableFieldState);
  textInputs.focusout(updateTextFieldState);
  textInputs.change(updateTextFieldState);
  nextButtons.click(nextFormStep);
  speltakDefiners.focusout(updateSpeltak);
  speltakDefiners.change(updateSpeltak);
  addressDefiners.focusout(updateAddress);
  chooseActionButton.click(chooseAction);
  chooseRentalTypeButton.click(chooseRentalType);
  ibanField.focusout(requireSepa);
  adminForm.submit(submitAdministration);

  if (typeof pickAction !== 'undefined') {
    if (pickAction) {
      chooseActionButton.click();
    }
  }

  if ($('.album').length) {
    $('.fancybox').fancybox({
      beforeShow: function() {
        location.hash = this.element.attr('id');
      }
    });

    if (location.hash !== undefined && location.hash !== "") {
      $(location.hash).trigger('click');
    }

    $('#js-slideshow-button').click(function() {
      $('.fancybox').first().click();
      setTimeout(function() {
        $.event.trigger({ type: 'keydown', which: 32 });
      }, 100);
    });
  }

}



function menuToggler (menu) {

  var menuToggle = $('.js-menu-toggle');

  menuToggle.click(function (e) {
    e.preventDefault();
    menu.toggleClass('opened');
    menuToggle.toggleClass('opened');
  });

}

function scrollMenu (header) {
  $(window).scroll(function() {
    var scroll = $(window).scrollTop();
    if (scroll > 150) {
      header.addClass("site-header--sticky");
    } else {
      header.removeClass("site-header--sticky");
    }
  });
}



function prepAdminForm(form) {
  form.children('fieldset:not(.start)').hide();
}

function prepRentalForm(form) {
  form.children('fieldset:not(.start)').hide();
}

function updateCheckableFieldState() {
  if ($(this).prop('checked')) {
    $(this).parent().siblings('label').removeClass('checked');
    $(this).parent().addClass('checked');
  } else {
    $(this).parent().removeClass('checked');
  }
}

function updateTextFieldState() {
  let targetLabel = $(this).parent();

  if($(this).is('[type=radio]')) {
    targetLabel = targetLabel.parent();
  }

  if ($(this).is(':valid')) {
    targetLabel.removeClass('invalid');
    targetLabel.addClass('valid');
  } else {
    targetLabel.removeClass('valid');
    targetLabel.addClass('invalid');
  }

  let step = $(targetLabel).parent();
  if (checkStep(step)) {
    $('.form-prob').remove();
  }
}

function nextFormStep(backupEl = false) {
  let thisStep = $(this).parent();
  if (backupEl && !backupEl.target) {
    thisStep = backupEl;
  }
  if (checkStep(thisStep)) {
    let nextStep;
    if (userAction === 'Afmelden') {
      nextStep = thisStep.nextAll('.act-delete').first();
    } else if (userAction === 'Wijzigen') {
      nextStep = thisStep.nextAll(':not(.non-changing)').first();
    } else if (userAction === 'Evenement') {
      nextStep = thisStep.nextAll('.one-day').first();
    } else if (userAction === 'Overnachting') {
      nextStep = thisStep.nextAll('.multi-day').first();
    } else {
      nextStep = thisStep.next();
    }
    nextStep.show();
    nextStep.find('input, textarea').first().focus();
    updateFormOverview();
  } else {
    thisStep.append("<p class='form-prob'>Nog niet alle velden zijn goed ingevuld. Gaat er iets mis? Mail helpdesk@scoutingoost1.nl.</p>");
  }
}

function checkStep(step) {
  let fields = step.find('input, select'),
    fieldsOK = true;
  fields.each(function() {
    if(!$(this)[0].checkValidity()) {
      fieldsOK = false;
    }
  });
  return fieldsOK;
}

function updateSpeltak() {
  let dob = $('[name=Geboortedatum]').val(),
    gender = $('[name=Gender]:checked').val();

  if (dob && gender) {

    let dobDate = new Date(dob),
      ageDifMs = Date.now() - dobDate.getTime(),
      ageDate = new Date(ageDifMs),
      age = Math.abs(ageDate.getUTCFullYear() - 1970),
      probSpeltak;

    if (age < 7) {
        probSpeltak = 'Bevers';
    } else if (age < 11) {
      if (gender === 'Meisje') {
        probSpeltak = 'Kabouters';
      }
    } else if (age < 15) {
      if (gender === 'Meisje') {
        probSpeltak = 'Gidsen';
      } else if (gender === 'Jongen') {
        probSpeltak = 'Verkenners';
      }
    } else if (age < 18) {
      probSpeltak = 'Explos';
    } else {
      probSpeltak = 'Stam';
    }
    $('[name=Speltak]').val(probSpeltak).change();
  }
}

function updateAddress() {
  let postcode = $('[name=Postcode]').val(),
    number = $('[name=Huisnummer]').val();

  if (postcode && number) {
    $.ajax({
      url: ajaxurl,
      data: { postcode: postcode, number: number, action: 'address' },
      method: "GET",
      dataType: "json"
    }).done(function(data) {
      $('[name=Straat]').val(data['street']);
      $('[name=Stad]').val(data['city']);
    });
  }
}

function updateFormOverview() {
  let overviewDiv = $('.form-overview'),
    formContents = $('form').serializeArray(),
    overviewHtml = $('<table class="form-overview__table"></table>');

  formContents.forEach(function(e) {
    if (e['name'] !== 'action' &&
      e['name'] !== 'url' &&
      e['name'] !== 'form_action' &&
      e['name'] !== 'Opmerkingen' &&
      e['name'] !== 's') {
      if(e['name'] === 'tnv') {
        e['name'] = "Ter name van";
      }
      let propName ='<td>' + e['name'] + '</td>',
        propValue = '<td>' + e['value'] + '</td>';
      overviewHtml.append('<tr>' + propName + propValue + '</tr>');
    }

  });

  overviewDiv.html(overviewHtml);
}

function chooseAction() {
  userAction = $('[name=Actie]:checked').val();

  $('input:not([name=url]), select').prop('required', true);
  let nonDelSteps = $('fieldset:not(.act-delete)'),
    nonChangeSteps = $('.non-changing');
  nonDelSteps.find('input, select').prop('disabled', false);
  nonChangeSteps.find('input, select').prop('disabled', false);

  switch (userAction) {
    case 'Wijzigen':
      $('input:not(.identifying), select:not(.identifying)').prop('required', false);
      nonChangeSteps.find('input, select').prop('disabled', true);
      nonChangeSteps.hide();
      break;
    case 'Afmelden':
      nonDelSteps.find('input, select').prop('disabled', true);
      nonDelSteps.hide();
      break;
  }
  $('[name=submit]').text(userAction);

  prepAdminForm($('.administration'));
  nextFormStep($(this).parent());
}

function chooseRentalType() {
  userAction = $('[name="Soort verhuur"]:checked').val();

  $('input:not([name=url]), select').prop('required', true);
  let multiDayOnly = $('fieldset:not(.one-day)'),
    oneDayOnly = $('fieldset:not(.multi-day)');
  multiDayOnly.find('input, select').prop('disabled', false);
  oneDayOnly.find('input, select').prop('disabled', false);

  switch (userAction) {
    case 'Overnachting':
      oneDayOnly.find('input, select').prop('disabled', true);
      oneDayOnly.hide();
      break;
    case 'Evenement':
      multiDayOnly.find('input, select').prop('disabled', true);
      multiDayOnly.hide();
      break;
  }

  prepRentalForm($('.rental'));
  nextFormStep($(this).parent());
}

function requireSepa() {
  if(userAction == 'Wijzigen') {
    if ($(this).val()) {
      $('#sepa').prop('required', true);
      $('[value=tnv]').prop('required', true);
    } else {
      $('#sepa').prop('required', false);
      $('[value=tnv]').prop('required', false);
    }
  }
}

function submitAdministration(e) {
  e.preventDefault();
  let adminForm = $('form'),
    formContents = adminForm.serializeArray();
  $('.form-prob--floating').remove();
  adminForm.addClass('loading');
  $.ajax({
    url: ajaxurl,
    data: formContents,
    method: "POST",
    dataType: "json"
  }).done(function(data) {
    if (!data['success']) {
      formFailure();
    } else {
      successMessage = "<strong>Het is gelukt!</strong>";
      successMessage += " In je mailbox vind je nog een bevestiging.";
      adminForm.html('<p class="form-success">' + successMessage + '</p>')
    }
  }).fail(formFailure).always(function() {
    adminForm.removeClass('loading');
  });
}

function formFailure() {
  let errorEl = $('<p class="form-prob form-prob--floating">' + form_failure + '</p>')
  $('body').append(errorEl);
}
