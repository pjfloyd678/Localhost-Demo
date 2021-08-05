var DEBUG = 1;

var pagePreferences = [ 'tracking_update', 'thirdparty_update', 'other_update' ];

// Event Listeners
document.addEventListener("DOMContentLoaded", function(evt) { 
    evt.preventDefault();
    var cookie = getCookie( 'aecdaily_user' );
    var userid = parseInt( cookie );
    if ( ( typeof userid === 'undefined' ) || isNaN( userid ) ) {
        document.getElementById( "tracking_no" ).checked = 1;
        return false;
    }
    if ( userid > 0 ) {
        getUser( userid, true );
    } else {
        setNonUserCookes();
        var allPreferences = [ "1", "1", "1" ];
        changePreferences( allPreferences );
    }
});
var elementExists =  document.getElementById('give_all');
if ( typeof( elementExists ) !== 'undefined' && elementExists !== null) {
    document.getElementById("give_all").addEventListener("click", function( evt ) {
        evt.preventDefault();
        setNonUserCookes();
        var allPreferences = [ "1", "1", "1" ];
        changePreferences( allPreferences );
    });
}
var getUser = function( userid, use_api ) {
    if ( userid > 0 ) {
        var url = getURL("cookies/get/" + userid );
        if ( use_api ) {
            url = url + "/1";
        }
        if ( !use_api ) {
            window.location.href = url;
        } else {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    var data = JSON.parse(this.responseText);
                    var preferences = data.preferences;
                    updateLoginStatus( true );
                    changePreferences( preferences );
                    setAllCookies( data );
                    displayCookieBanner( false );
                }
            };
            xhttp.open("GET", url, true);
            xhttp.send();
        }
    }
    return false;
};

var changePreferences = function( preferences ) {
    for( var indx = 0; indx < preferences.length; indx++ ) {
        if ( parseInt( preferences[ indx ] ) === 1 ) {
            document.getElementById( pagePreferences[ indx ] ).checked = true;
        } else {
            document.getElementById( pagePreferences[ indx ] ).checked = false;
        }
    }
};

var setNonUserCookes = function() {
    var days        = 10;
    var name        = "aecdaily_user";
    var userID      = 0;
    setCookie( name, userID, days );
    var prefCookie  = "preference_" + userID;
    var preferences = 7;
    setCookie( prefCookie, preferences, days );
};

var setAllCookies = function( data ) {
    var days        = 10;
    var name        = "aecdaily_user";
    var userID      = data.user_info[ 0 ][ 'user_ID' ];
    setCookie( name, userID, days );
    var prefCookie  = "preference_" + userID;
    var preferences = data.user_info[ 0 ][ 'preferences' ];
    setCookie( prefCookie, preferences, days );
};

var removeAllCookies = function( user_id ) {
    document.cookie = "aecdaily_user=;expires=Thu, 01 Jan 1970";
    document.cookie = "preference_" + user_id + "=;expires=Thu, 01 Jan 1970";
};

var getCookie = function( cname ) {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) === ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) === 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
};

var setCookie = function(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  var expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
};


var displayCookieBanner = function( display ) {
    if ( display ) {
        document.getElementById( "cookiebanner" ).style.display = "block";
    } else {
        document.getElementById( "cookiebanner" ).style.display = "none";
    }
}