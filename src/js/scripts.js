jQuery(document).ready(onDocReady);

var userAction,
  form_failure = "Er is iets mis gegaan op de server, excuses voor het ongemak. Herlaadt de pagina en probeer het nog eens. Blijft het fout gaan? Mail dan naar helpdesk@scoutingoost1.nl.";

function onDocReady () {

  let menu = jQuery('.site-menu'),
    header = jQuery('.site-header'),
    adminForm = jQuery('.administration'),
    rentalForm = jQuery('.rental'),
    clothesForm = jQuery('.clothes'),
    checkableInputs = jQuery('input[type=radio], input[type=checkbox]'),
    textInputs = jQuery('input, textarea, select'),
    nextButtons = jQuery('.js-next'),
    speltakDefiners = jQuery('[name=Geboortedatum], [name=Geslacht]'),
    addressDefiners = jQuery('[name=Postcode], [name=Huisnummer]'),
    chooseActionButton = jQuery('.js-choose-action'),
    chooseRentalTypeButton = jQuery('.js-choose-rental-type'),
    ibanField = jQuery('[name=IBAN]');

  ajaxurl = document.head.querySelector("[name=ajaxurl]").content;

  scrollMenu(header);
  prepAdminForm(adminForm);
  prepRentalForm(rentalForm);
  prepClothesForm(clothesForm);
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
  adminForm.submit(submitForm);
  rentalForm.submit(submitForm);
  clothesForm.submit(submitForm);

  if (jQuery('.photos').length) {
    jQuery('.fancybox').fancybox({
      beforeShow: function() {
        location.hash = this.element.attr('id');
      }
    });

    if (location.hash !== undefined && location.hash !== "") {
      jQuery(location.hash).trigger('click');
    }

    jQuery('#js-slideshow-button').click(function() {
      jQuery('.fancybox').first().click();
      setTimeout(function() {
        jQuery.event.trigger({ type: 'keydown', which: 32 });
      }, 100);
    });
  }

  if (jQuery('.builder').length) {
    builderInit()
  }

}



var menuToggle = document.querySelector('.js-menu-toggle');
var menu = document.querySelector('#menu');
menuToggle.addEventListener('click', function() {
  let expanded = this.getAttribute('aria-expanded') === 'true' || false;
  this.setAttribute('aria-expanded', !expanded);
  menu.classList.toggle('opened');
});

function scrollMenu (header) {
  jQuery(window).scroll(function() {
    var scroll = jQuery(window).scrollTop();
    if (scroll > 150) {
      header.addClass("site-header--sticky");
    } else {
      header.removeClass("site-header--sticky");
    }
  });
}

var subMenus = document.querySelectorAll('.sub-menu');
subMenus.forEach(e => e.hidden = true);

var navButton = document.querySelectorAll('nav button');
navButton.forEach(e => e.addEventListener('click', function() {
  let expanded = this.getAttribute('aria-expanded') === 'true' || false;
  this.setAttribute('aria-expanded', !expanded);
  let menu = this.nextElementSibling;
  subMenus.forEach(e => {
    if (e != menu) e.hidden = true;
  });
  menu.hidden = !menu.hidden;
}));

document.onkeydown = function(evt) {
  evt = evt || window.event;
  var isEscape = false;
  if ("key" in evt) {
      isEscape = (evt.key === "Escape" || evt.key === "Esc");
  } else {
      isEscape = (evt.keyCode === 27);
  }
  if (isEscape) {
    subMenus.forEach(e => e.hidden = true);
  }
};




function prepAdminForm(form) {
  form.children('fieldset:not(.start)').hide();
}

function prepRentalForm(form) {
  form.children('fieldset:not(.start)').hide();
}

function prepClothesForm(form) {
  form.children('fieldset:not(.start)').hide();
}

function updateCheckableFieldState() {
  if (jQuery(this).prop('checked')) {
    if (jQuery(this).prop('type') === 'radio')
      jQuery(this).parent().siblings('label').removeClass('checked');
    jQuery(this).parent().addClass('checked');
  } else {
    jQuery(this).parent().removeClass('checked');
  }
}

function updateTextFieldState() {
  let targetLabel = jQuery(this).parent();

  if(jQuery(this).is('[type=radio]')) {
    targetLabel = targetLabel.parent();
  }

  if (jQuery(this).is(':valid')) {
    targetLabel.removeClass('invalid');
    targetLabel.addClass('valid');
  } else {
    targetLabel.removeClass('valid');
    targetLabel.addClass('invalid');
  }

  let step = jQuery(targetLabel).parent();
  if (checkStep(step)) {
    jQuery('.form-prob').remove();
  }
}

function nextFormStep(backupEl = false) {
  let thisStep = jQuery(this).parent();
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
    thisStep.children('.form-prob').remove();
    thisStep.append("<p class='form-prob'>Nog niet alle velden zijn goed ingevuld. Gaat er iets mis? Mail helpdesk@scoutingoost1.nl.</p>");
  }
}

function checkStep(step) {
  let fields = step.find('input, select'),
    fieldsOK = true;
  fields.each(function() {
    if(!jQuery(this)[0].checkValidity()) {
      fieldsOK = false;
    }
  });
  return fieldsOK;
}

function updateSpeltak() {
  let dob = jQuery('[name=Geboortedatum]').val(),
    geslacht = jQuery('[name=Geslacht]:checked').val();

  if (dob && geslacht) {

    let dobDate = new Date(dob),
      ageDifMs = Date.now() - dobDate.getTime(),
      ageDate = new Date(ageDifMs),
      age = Math.abs(ageDate.getUTCFullYear() - 1970),
      probSpeltak;

    if (age < 7) {
        probSpeltak = 'Bevers';
    } else if (age < 11) {
      if (geslacht === 'Meisje') {
        probSpeltak = 'Kabouters';
      } else if (geslacht === 'Jongen') {
        probSpeltak = 'Welpen';
      }
    } else if (age < 15) {
      if (geslacht === 'Meisje') {
        probSpeltak = 'Gidsen';
      } else if (geslacht === 'Jongen') {
        probSpeltak = 'Verkenners';
      }
    } else if (age < 18) {
      probSpeltak = 'Explos';
    } else {
      probSpeltak = 'Stam';
    }
    jQuery('[name=Speltak]').val(probSpeltak).change();
  }
}

function updateAddress() {
  let postcode = jQuery('[name=Postcode]').val(),
    number = jQuery('[name=Huisnummer]').val();

  if (postcode && number) {
    jQuery.ajax({
      url: ajaxurl,
      data: { postcode: postcode, number: number, action: 'address' },
      method: "GET",
      dataType: "json"
    }).done(function(data) {
      jQuery('[name=Straat]').val(data['street']);
      jQuery('[name=Stad]').val(data['city']);
    });
  }
}

function updateFormOverview() {
  let overviewDiv = jQuery('.form-overview'),
    formContents = jQuery('form').serializeArray(),
    overviewHtml = jQuery('<table class="form-overview__table"></table>');

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
  userAction = jQuery('[name=Actie]:checked').val();

  jQuery('input:not([name=url]), select').prop('required', true);
  let nonDelSteps = jQuery('fieldset:not(.act-delete)'),
    nonChangeSteps = jQuery('.non-changing');
  nonDelSteps.find('input, select').prop('disabled', false);
  nonChangeSteps.find('input, select').prop('disabled', false);

  switch (userAction) {
    case 'Wijzigen':
      jQuery('input:not(.identifying), select:not(.identifying)').prop('required', false);
      nonChangeSteps.find('input, select').prop('disabled', true);
      nonChangeSteps.hide();
      break;
    case 'Afmelden':
      nonDelSteps.find('input, select').prop('disabled', true);
      nonDelSteps.hide();
      break;
  }
  jQuery('[name=submit]').text(userAction);

  jQuery('input:not(.optional)').prop('required', false);

  prepAdminForm(jQuery('.administration'));
  nextFormStep(jQuery(this).parent());
}

function chooseRentalType() {
  userAction = jQuery('[name="Soort verhuur"]:checked').val();

  jQuery('input:not([name=url]), select').prop('required', true);
  let multiDayOnly = jQuery('fieldset:not(.one-day)'),
    oneDayOnly = jQuery('fieldset:not(.multi-day)');
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

  prepRentalForm(jQuery('.rental'));
  nextFormStep(jQuery(this).parent());
}

function requireSepa() {
  if(userAction == 'Wijzigen') {
    if (jQuery(this).val()) {
      jQuery('#sepa').prop('required', true);
      jQuery('[value=tnv]').prop('required', true);
    } else {
      jQuery('#sepa').prop('required', false);
      jQuery('[value=tnv]').prop('required', false);
    }
  }
}

function submitForm(e) {
  e.preventDefault();
  let submittedForm = jQuery('form'),
    formContents = submittedForm.serializeArray();
  jQuery('.form-prob--floating').remove();
  submittedForm.addClass('loading');
  jQuery.ajax({
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
      submittedForm.html('<p class="form-success">' + successMessage + '</p>')
    }
  }).fail(formFailure).always(function() {
    submittedForm.removeClass('loading');
  });
}

function formFailure() {
  let errorEl = jQuery('<p class="form-prob form-prob--floating">' + form_failure + '</p>')
  jQuery('body').append(errorEl);
}
