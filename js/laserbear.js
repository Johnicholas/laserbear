"use strict";

function laserbear_people(callback) {
    return jQuery.get('/wp-json/laserbear/v1/people', callback);
}

function laserbear_person(id, callback) {
    return jQuery.get('/wp-json/laserbear/v1/people/' + id, callback);
}

function laserbear_remove_children(elem) {
    while (elem.lastChild) {
	elem.removeChild(elem.lastChild);
    }
}

function laserbear_focus_on(which) {
    return function () {
	laserbear_person(which, function (person) {
	    var first, last, out, text;

	    first = person.first;
	    last = person.last;
	    out = document.getElementById('laserbear_person');
	    text = document.createTextNode(first + " " + last);

	    laserbear_remove_children(out);
	    out.appendChild(text);
	});
    };
}

function laserbear_refresh() {
    laserbear_people(function (people) {
	var i, list, item, text;

	list = document.getElementById('laserbear_people');
	laserbear_remove_children(list);
	for (i = 0; i < people.length; i += 1) {
	    item = document.createElement('li');
	    text = document.createTextNode(people[i]);
	    item.appendChild(text);
	    item.onclick = laserbear_focus_on(i);
	    list.appendChild(item);
	}
    });
}

jQuery(document).ready(function () {
    document.getElementById('laserbear_refresh').onclick = laserbear_refresh;
});
