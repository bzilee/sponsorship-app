/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
/*
import CountDownComponent from './components/CountDownComponent';
import RegisterComponent from './components/StepperComponent2';
import VueStar1 from './components/VueStartComponent';
import VueStar2 from 'vue-star';
import SingleCountDownComponent from './components/SingleCountDownComponent';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
/*
Vue.filter('two_digits', (value) => {
    if (value < 0) {
      return '00';
    }
    if (value.toString().length <= 1) {
      return `0${value}`;
    }
    return value;
  });


const app = new Vue({
    el: '#app',
    components: {
        "countdown" : CountDownComponent,
        'register' : RegisterComponent,
        'vue-star' : VueStar1,
        'SingleCountDown' : SingleCountDownComponent,

    }
});
*/
var height_container = $('#app').height();
var height_viewport =  $(window).height();

$(document).ready(function () {

    let button_register = $('#s-btn-submitting');
    let button_home_page = $('#home-page');
    let button_show_profile = $('#show-profile');

    height_container = $('#app').height();
    height_viewport = $(window).height();

    button_register.on('click', function (e) {
        e.preventDefault();
        window.location.replace(button_register.attr("url"));
    });
    button_home_page.on('click', function (e) {
        e.preventDefault();
        window.location.replace(button_home_page.attr("url"));
    });
    button_show_profile.on('click', function (e) {
        e.preventDefault();
        window.location.replace(button_show_profile.attr("url"));
    });

    $(window).on('resize', function () {
        height_container = $('#app').height();
        height_viewport = $(window).height();

        if (height_container < height_viewport) {
            resizeObjects(height_container,height_viewport);

        } else {
            $('#thumbnail-logo-iai').removeAttr('style');
        }

    })

    if (height_container < height_viewport) {
        resizeObjects();
    }
    //AnimateRotate(45,"infinite");
});

if (height_container < height_viewport) {
    resizeObjects();
}

function resizeObjects() {
        $('.thumbnail-logo-iai').css('position','fixed')
        .css('left',0)
        .css('right',0)
        .css('bottom',0)
        .css('margin-bottom','calc( 100vh - 95vh )');
}

function AnimateRotate(angle,repeat) {
    var duration= 1000;
    setTimeout(function() {
        if(repeat && repeat == "infinite") {
            AnimateRotate(angle,repeat);
        } else if ( repeat && repeat > 1) {
            AnimateRotate(angle, repeat-1);
        }
    },duration)
    var $elem = $('.icon-repeat');

    $({deg: 0}).animate({deg: angle}, {
        duration: duration,
        step: function(now) {
            $elem.css({
                'transform': 'rotate('+ now +'deg)'
            });
        }
    });
}
//AnimateRotate(45,"infinite");
