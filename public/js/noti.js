/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */,
/* 1 */,
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(3);


/***/ }),
/* 3 */
/***/ (function(module, exports, __webpack_require__) {

///////////////////////////// start get new noti if exist /////////////////////
function newNotiCount() {
    var userId = $('meta[name=dash]').attr('content');
    var token = $('meta[name=csrf-token]').attr('content');
    var count = $("input[name=temp]").val();
    console.log(count);
    $.ajax({
        type: 'POST',
        url: '/newNotiCount',

        data: {
            _token: token,
            userId: userId,
            count: count
        },
        success: function success(data) {
            if (data.status == 'true') {
                //$('#notiLoop').load('/getNoti').fadeIn('slow');
                $('#notiPlace').load('/getNoti').fadeIn('slow');

                $("input[name=temp]").val(data.count);
                console.log($("input[name=temp]").val());
                $("#noti-count").html(data.count);
                if (data.unreadNoti > 0) {
                    console.log('data.unreadNoti' + data.unreadNoti);
                    $("#noti-count").html(data.unreadNoti);
                } else {
                    $("#noti-count").hide();
                }
                var NotiAudio = $('#NotiAudio');
                NotiAudio[0].play();
                console.log('new notification' + unreadNoti);
            } else {
                console.log('no new notification');
            }
        }
    });
}
$(document).ready(function () {

    setInterval(newNotiCount, 10000);
});
///////////////////////////// end get new noti if exist /////////////////////
/////////////////////////////// start delete all ///////////////////////////
$(document).on('click', ".noti_delete_all", function (e) {
    e.stopPropagation();
    console.log('delete all');
    var userId = $('meta[name=dash]').attr('content');
    var token = $('meta[name=csrf-token]').attr('content');
    var count = $("input[name=temp]").val();
    console.log(count);
    $.ajax({
        type: 'POST',
        url: '/deleteAllNoti',

        data: {
            _token: token,
            userId: userId
        },
        success: function success(data) {
            if (data.status == 'deleted') {
                $('#notiPlace').load('/getNoti').fadeIn('slow');
                $("input[name=temp]").val(data.count);
                console.log($("input[name=temp]").val());
                if (data.unreadNoti > 0) {
                    $("#noti-count").html(data.unreadNoti);
                } else {
                    $("#noti-count").hide();
                }
            } else {
                console.log('no new notification');
            }
        }
    });
    console.log('delete all');
});
/////////////////////////////// end delete all ///////////////////////////
/////////////////////////////// start all as read ///////////////////////////
$(document).on('click', ".noti_all_as-read", function (e) {
    e.stopPropagation();
    var userId = $('meta[name=dash]').attr('content');
    var token = $('meta[name=csrf-token]').attr('content');
    var count = $("input[name=temp]").val();
    console.log(count);
    $.ajax({
        type: 'POST',
        url: '/markAllAsReadNoti',

        data: {
            _token: token,
            userId: userId
        },
        success: function success(data) {
            if (data.status == 'all_marked_as_read') {
                $('#notiPlace').load('/getNoti').fadeIn('slow');
                $("input[name=temp]").val(data.count);
                console.log($("input[name=temp]").val());
                if (data.unreadNoti > 0) {
                    $("#noti-count").html(data.unreadNoti);
                } else {
                    $("#noti-count").hide();
                }
            } else {
                console.log('no new notification');
            }
        }
    });
    console.log('delete all');
});
/////////////////////////////// end all as read ///////////////////////////
/////////////////////////////// start delete one noti ///////////////////////////
$(document).on('click', ".noti_delete", function (e) {
    e.stopPropagation();
    var id = $(this).attr('id');
    var noti = id.replace('_delete', '');
    var userId = $('meta[name=dash]').attr('content');
    var token = $('meta[name=csrf-token]').attr('content');
    var count = $("input[name=temp]").val();
    console.log(count);
    $.ajax({
        type: 'POST',
        url: '/deleteNoti',

        data: {
            _token: token,
            userId: userId,
            count: count,
            noti: noti
        },
        success: function success(data) {
            if (data.status == 'deleted') {
                $('#notiPlace').load('/getNoti').fadeIn('slow');
                $("input[name=temp]").val(data.count);
                console.log($("input[name=temp]").val());
                if (data.unreadNoti > 0) {
                    $("#noti-count").html(data.unreadNoti);
                } else {
                    $("#noti-count").hide();
                }
            } else {
                console.log('no new notification');
            }
        }
    });
});
/////////////////////////////// end delete one noti ///////////////////////////
/////////////////////////////// start as read one noti ///////////////////////////
$(document).on('click', ".noti_as-read", function (e) {
    e.stopPropagation();
    var id = $(this).attr('id');
    var noti = id.replace('_noti_as-read', '');
    var userId = $('meta[name=dash]').attr('content');
    var token = $('meta[name=csrf-token]').attr('content');
    var count = $("input[name=temp]").val();
    console.log(count);
    $.ajax({
        type: 'POST',
        url: '/markAsReadNoti',

        data: {
            _token: token,
            userId: userId,
            count: count,
            noti: noti
        },
        success: function success(data) {
            if (data.status == 'marked_as_read') {
                //$('#notiLoop').load('/getNoti').fadeIn('slow');
                $('#notiPlace').load('/getNoti').fadeIn('slow');
                $("input[name=temp]").val(data.count);
                console.log($("input[name=temp]").val());
                if (data.unreadNoti > 0) {
                    $("#noti-count").html(data.unreadNoti);
                } else {
                    $("#noti-count").hide();
                }
            } else {
                console.log('no new notification');
            }
        }
    });
    console.log('delete all');
});
//////////////////////////////// end as read one noti ////////////////////////////
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

__webpack_require__(4);

/* $(document).ready(function () {
    var notification = [];
    var userId = $('meta[name=dash]').attr('content');
    console.log(userId);
     Echo.private('App.Model.User.' + userId)
         .notification((notification) => {
             notification = notification;
             console.log(notification);
             console.log(userId);
         });

    
}); */

//window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/*Vue.component('example', require('./components/Example.vue'));
*/
/* const app = new Vue({
    el: '#app',
    data: {
        notification:'',
    },
    mounted(){
        var userId = $('meta[name=dash]').attr('content');
        console.log(userId);
        Echo.private('App.Model.User.' + userId)
            .notification((notification) => {
                notification = notification ;
                console.log(notification);
            });
    }

}); */

/***/ }),
/* 4 */
/***/ (function(module, exports) {


//window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

/* try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap-sass');
} catch (e) {} */

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

/* window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
 */
/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

/* let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
} */

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

/* import Echo from 'laravel-echo'

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '4990e2a8cb33991c99b2',
    cluster: 'eu',
    encrypted: true
}); */

/***/ })
/******/ ]);