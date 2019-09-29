jQuery(document).ready(onDocReady);

function onDocReady () {

	var $ = jQuery;

	ajaxurl = document.head.querySelector("[name=ajaxurl]").content;

	menuToggler();

}



function menuToggler () {

	var menuToggle = $('.js-menu-toggle'),
		menu = $('.primary-menu');

	menuToggle.click(function () {
		menu.toggleClass('opened');
		menuToggle.toggleClass('opened');
	});

}
