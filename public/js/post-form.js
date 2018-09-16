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
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/post-form.js":
/***/ (function(module, exports) {

var FIG = FIG || {};

FIG.postForm = {

    autoSlug: true,

    listen: function listen() {

        // FYI setting this as jQuery will take over "this" depending on context.
        var self = this;

        // URL slug auto-population
        self.slugAutoPopulate();

        // Delete Confirmation
        $("a[role=deletePost]").on("click", function (event) {
            self.confirmDelete($(this), event);
        });
    },

    /**
     * Check the user wants to actually delete the article they say.
     *
     * @param <jQuery element> $el - A link
     * @param <JavaScript event>
     * @return <void>
     */
    confirmDelete: function confirmDelete($el, event) {
        var res = confirm("Are you sure you want to delete '" + $el.data('title') + "'?");

        if (!res) {
            event.preventDefault();
        }
    },

    /**
     * As soon as the user types in the slug field, set a data attribute so we
     * know to stop auto populating.
     *
     * @return {[type]} [description]
     */
    slugSet: function slugSet() {
        var self = this;
        var $form = $("#postForm");
        var $slug = $("[name=slug]", $form);

        $slug.on("focus", function () {
            self.autoSlug = false;
        });
    },

    slugAutoPopulate: function slugAutoPopulate() {

        var self = this;

        self.slugSet();

        var $form = $("#postForm");
        var $postId = $("[name=postId]", $form);
        var $title = $("[name=title]", $form);
        var $slug = $("[name=slug]", $form);

        // If this page has a post ID in the form, we're editing an existing
        // blog post - so we don't want to touch the value.
        if ($postId.val() != "") {
            self.autoSlug = false;
        }

        $title.on("keyup", function () {

            if (self.autoSlug == false) {
                return;
            }

            var value = $title.val();
            value = value.toLowerCase();
            value = value.replace(/[^\w ]+/g, '');
            value = value.replace(/ +/g, '-');

            $slug.val(value);
        });
    }

};

$(function () {
    FIG.postForm.listen();
});

/***/ }),

/***/ 3:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./resources/assets/js/post-form.js");


/***/ })

/******/ });