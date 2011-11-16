snavi.setup = function ( layout, template, data ) {
  $('.content').text(template.replace('#CONTENT#', data.content));
  document.title = data.title;
}

snavi.teardown = function ( layout ) {
}

snavi.templater = function ( layout, url, callback ) {
  callback('Hello there you #CONTENT#!');
}

snavi.data = function ( url, layout, callback ) {
  $.get(url + '&format=json', {}, callback);
}

$(document).on('click', 'a', null, function (e) {
  snavi.navigate($(this).attr('href'), 'normal');
  e.preventDefault();
} );
