function laserbear_people(callback) {
    return jQuery.get('wp-json/laserbear/v1/people', callback);
}

function laserbear_person(id, callback) {
    return jQuery.get('wp-json/laserbear/v1/people/' + id, callback);
}

