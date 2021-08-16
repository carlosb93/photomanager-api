(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["js/Administracion"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/Configuraciones.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/Configuraciones.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _config__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../config */ "./resources/js/config.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var element_ui__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! element-ui */ "./node_modules/element-ui/lib/element-ui.common.js");
/* harmony import */ var element_ui__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(element_ui__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _Notifications_NotificationTemplate__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./Notifications/NotificationTemplate */ "./resources/js/pages/Notifications/NotificationTemplate.vue");
/* harmony import */ var _components_BaseAlert__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../components/BaseAlert */ "./resources/js/components/BaseAlert.vue");
var _components;

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//





var URL_API_SUBASTA = _config__WEBPACK_IMPORTED_MODULE_0__["default"].url_api.URL_API_SUBASTA;
var URL_API_CENTRAL = _config__WEBPACK_IMPORTED_MODULE_0__["default"].url_api.URL_API_CENTRAL;
/**
 * Arma la URL de el servicio
 */

function buildURL(api) {
  var resource = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "";

  if (api == "URL_API_CENTRAL") {
    return URL_API_CENTRAL + resource;
  } else {
    return URL_API_SUBASTA + resource;
  }
}

/* harmony default export */ __webpack_exports__["default"] = ({
  components: (_components = {
    BaseAlert: _components_BaseAlert__WEBPACK_IMPORTED_MODULE_4__["default"]
  }, _defineProperty(_components, element_ui__WEBPACK_IMPORTED_MODULE_2__["DatePicker"].name, element_ui__WEBPACK_IMPORTED_MODULE_2__["DatePicker"]), _defineProperty(_components, element_ui__WEBPACK_IMPORTED_MODULE_2__["TimeSelect"].name, element_ui__WEBPACK_IMPORTED_MODULE_2__["TimeSelect"]), _components),
  data: function data() {
    return {
      stado0: "default",
      LogoFile: '',
      LogoName: '',
      errors_validation: [],
      titulo_app: localStorage.getItem('name_app'),
      name_app: '',
      logo_app: '',
      email_app: '',
      telef_app: '',
      parametros: '',
      isProcessing: false,
      errors: {},
      type: ["", "info", "success", "warning", "danger"],
      notifications: {
        topCenter: false
      }
    };
  },
  created: function created() {},
  methods: {
    validatorName: function validatorName() {
      this.errors_validation = [];

      if (!this.name_app) {
        this.errors_validation.push("El nombre de la app no puede estar vacio.");
      }

      if (this.errors_validation.length === 0) {
        this.sendConfigName();
      } else {}
    },
    sendConfigName: function sendConfigName() {
      var _this = this;

      this.isProcessing = true;
      var formData = new FormData();
      formData.append('name_app', this.name_app);
      var config = {
        headers: {
          'content-type': 'multipart/form-data'
        }
      };
      axios__WEBPACK_IMPORTED_MODULE_1___default.a.post(buildURL("URL_API_SUBASTA", "set_name_app"), formData, config).then(function (res) {
        _this.isProcessing = false;

        _this.$notify({
          message: 'Cambio realizado con éxito',
          title: _this.titulo_app,
          component: _Notifications_NotificationTemplate__WEBPACK_IMPORTED_MODULE_3__["default"],
          icon: "tim-icons icon-bell-55",
          type: 'success',
          timeout: 4000
        });
      })["catch"](function (err) {
        _this.isProcessing = false;
        console.log(err);
      });
    },
    validatorEmail: function validatorEmail() {
      this.errors_validation = [];

      if (!this.email_app) {
        this.errors_validation.push("El email de contacto no puede estar vacio.");
      }

      if (this.errors_validation.length === 0) {
        this.sendConfigEmail();
      } else {}
    },
    sendConfigEmail: function sendConfigEmail() {
      var _this2 = this;

      this.isProcessing = true;
      var formData = new FormData();
      formData.append('email_app', this.email_app);
      var config = {
        headers: {
          'content-type': 'multipart/form-data'
        }
      };
      axios__WEBPACK_IMPORTED_MODULE_1___default.a.post(buildURL("URL_API_SUBASTA", "set_email_app"), formData, config).then(function (res) {
        _this2.isProcessing = false;

        _this2.$notify({
          message: 'Cambio realizado con éxito',
          title: _this2.titulo_app,
          component: _Notifications_NotificationTemplate__WEBPACK_IMPORTED_MODULE_3__["default"],
          icon: "tim-icons icon-bell-55",
          type: 'success',
          timeout: 4000
        });
      })["catch"](function (err) {
        _this2.isProcessing = false;
        console.log(err);
      });
    },
    validatorTelef: function validatorTelef() {
      this.errors_validation = [];

      if (!this.telef_app) {
        this.errors_validation.push("El telefono de contacto no puede estar vacio.");
      }

      if (this.errors_validation.length === 0) {
        this.sendConfigTelef();
      } else {}
    },
    sendConfigTelef: function sendConfigTelef() {
      var _this3 = this;

      this.isProcessing = true;
      var formData = new FormData();
      formData.append('telef_app', this.telef_app);
      var config = {
        headers: {
          'content-type': 'multipart/form-data'
        }
      };
      axios__WEBPACK_IMPORTED_MODULE_1___default.a.post(buildURL("URL_API_SUBASTA", "set_telef_app"), formData, config).then(function (res) {
        _this3.isProcessing = false;

        _this3.$notify({
          message: 'Cambio realizado con éxito',
          title: _this3.titulo_app,
          component: _Notifications_NotificationTemplate__WEBPACK_IMPORTED_MODULE_3__["default"],
          icon: "tim-icons icon-bell-55",
          type: 'success',
          timeout: 4000
        });
      })["catch"](function (err) {
        _this3.isProcessing = false;
        console.log(err);
      });
    },
    validatorLogo: function validatorLogo() {
      this.errors_validation = [];

      if (!this.LogoFile) {
        this.errors_validation.push("El logo de la app no puede estar vacio.");
      }

      if (this.errors_validation.length === 0) {
        this.sendConfigLogo();
      } else {}
    },
    sendConfigLogo: function sendConfigLogo() {
      var _this4 = this;

      this.isProcessing = true;
      var formData = new FormData();
      formData.append('LogoFile', this.LogoFile);
      formData.append('LogoName', this.LogoName);
      var config = {
        headers: {
          'content-type': 'multipart/form-data'
        }
      };
      axios__WEBPACK_IMPORTED_MODULE_1___default.a.post(buildURL("URL_API_SUBASTA", "set_logo_app"), formData, config).then(function (res) {
        _this4.isProcessing = false;

        _this4.$notify({
          message: 'Cambio realizado con éxito',
          title: _this4.titulo_app,
          component: _Notifications_NotificationTemplate__WEBPACK_IMPORTED_MODULE_3__["default"],
          icon: "tim-icons icon-bell-55",
          type: 'success',
          timeout: 4000
        });
      })["catch"](function (err) {
        _this4.isProcessing = false;
        console.log(err);
      });
    },
    handleLogo: function handleLogo(e) {
      this.LogoFile = e.target.files[0];
      this.LogoName = e.target.files[0].name;
      this.stado0 = "info";
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/Configuraciones.vue?vue&type=template&id=5463a09c&":
/*!*************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/Configuraciones.vue?vue&type=template&id=5463a09c& ***!
  \*************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "card",
    {
      staticStyle: {
        "border-bottom": "3px inset rgb(253, 185, 19)",
        "border-bottom-left-radius": "10px",
        "border-bottom-right-radius": "10px"
      }
    },
    [
      _c(
        "h5",
        { staticClass: "title", attrs: { slot: "header" }, slot: "header" },
        [
          _c(
            "router-link",
            { attrs: { to: "/home" } },
            [
              _c(
                "base-button",
                {
                  staticStyle: {
                    color: "rgba(82, 95, 127, 0.56)",
                    "border-color": "rgba(82, 95, 127, 0.56)"
                  },
                  attrs: {
                    icon: "",
                    round: "",
                    simple: "",
                    "data-toggle": "tooltip",
                    "data-placement": "top",
                    title: "Atras"
                  }
                },
                [
                  _c("i", {
                    staticClass: "mdi mdi-keyboard-backspace text-black",
                    staticStyle: {
                      "font-size": "35px",
                      color: "rgba(82, 95, 127, 0.56)"
                    }
                  })
                ]
              )
            ],
            1
          ),
          _vm._v(" Configuración de App\n  ")
        ],
        1
      ),
      _vm._v(" "),
      _vm.errors_validation.length
        ? _c("div", [
            _c("b", [
              _vm._v("Por favor, corrija el(los) siguiente(s) error(es):")
            ]),
            _vm._v(" "),
            _c(
              "ul",
              _vm._l(_vm.errors_validation, function(error) {
                return _c("li", [
                  _c("p", { staticStyle: { color: "#ff8578" } }, [
                    _vm._v(_vm._s(error))
                  ])
                ])
              }),
              0
            )
          ])
        : _vm._e(),
      _vm._v(" "),
      _c("label", { staticClass: "control-label" }, [
        _vm._v("Nombre de la app")
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "row" }, [
        _c("div", { staticClass: "col-md-6 px-md-1" }, [
          _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.name_app,
                expression: "name_app"
              }
            ],
            staticClass: "form-control",
            staticStyle: { "margin-top": "5px" },
            attrs: {
              "aria-describedby": "addon-right addon-left",
              placeholder: "Nombre"
            },
            domProps: { value: _vm.name_app },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.name_app = $event.target.value
              }
            }
          })
        ]),
        _vm._v(" "),
        _c(
          "div",
          { staticClass: "col-md-6 px-md-1" },
          [
            _c(
              "base-button",
              {
                attrs: {
                  slot: "footer",
                  type: "info",
                  fill: "",
                  disabled: _vm.isProcessing
                },
                on: { click: _vm.validatorName },
                slot: "footer"
              },
              [_vm._v("Guardar")]
            )
          ],
          1
        )
      ]),
      _vm._v(" "),
      _c("label", { staticClass: "control-label" }, [
        _vm._v("Correo de contacto Empresa")
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "row" }, [
        _c("div", { staticClass: "col-md-6 px-md-1" }, [
          _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.email_app,
                expression: "email_app"
              }
            ],
            staticClass: "form-control",
            staticStyle: { "margin-top": "5px" },
            attrs: {
              "aria-describedby": "addon-right addon-left",
              placeholder: "Email"
            },
            domProps: { value: _vm.email_app },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.email_app = $event.target.value
              }
            }
          })
        ]),
        _vm._v(" "),
        _c(
          "div",
          { staticClass: "col-md-6 px-md-1" },
          [
            _c(
              "base-button",
              {
                attrs: {
                  slot: "footer",
                  type: "info",
                  fill: "",
                  disabled: _vm.isProcessing
                },
                on: { click: _vm.validatorEmail },
                slot: "footer"
              },
              [_vm._v("Guardar")]
            )
          ],
          1
        )
      ]),
      _vm._v(" "),
      _c("label", { staticClass: "control-label" }, [
        _vm._v("Teléfono de contacto Empresa")
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "row" }, [
        _c("div", { staticClass: "col-md-6 px-md-1" }, [
          _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.telef_app,
                expression: "telef_app"
              }
            ],
            staticClass: "form-control",
            staticStyle: { "margin-top": "5px" },
            attrs: {
              "aria-describedby": "addon-right addon-left",
              placeholder: "Telefono"
            },
            domProps: { value: _vm.telef_app },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.telef_app = $event.target.value
              }
            }
          })
        ]),
        _vm._v(" "),
        _c(
          "div",
          { staticClass: "col-md-6 px-md-1" },
          [
            _c(
              "base-button",
              {
                attrs: {
                  slot: "footer",
                  type: "info",
                  fill: "",
                  disabled: _vm.isProcessing
                },
                on: { click: _vm.validatorTelef },
                slot: "footer"
              },
              [_vm._v("Guardar")]
            )
          ],
          1
        )
      ]),
      _vm._v(" "),
      _c("label", { staticClass: "control-label" }, [_vm._v("Logo de app")]),
      _vm._v(" "),
      _c("div", { staticClass: "row" }, [
        _c(
          "div",
          { staticClass: "col-md-2 px-md-1" },
          [
            _c("input", {
              ref: "LogoFile",
              staticStyle: { display: "none" },
              attrs: { type: "file" },
              on: { change: _vm.handleLogo }
            }),
            _vm._v(" "),
            _c(
              "base-button",
              {
                attrs: { round: "", type: _vm.stado0, simple: "" },
                on: {
                  click: function($event) {
                    return _vm.$refs.LogoFile.click()
                  }
                }
              },
              [
                _c("i", {
                  staticClass: "mdi mdi-cloud-upload-outline",
                  staticStyle: { "font-size": "19px" }
                }),
                _vm._v(" Logo de la App")
              ]
            )
          ],
          1
        ),
        _vm._v(" "),
        _c(
          "div",
          { staticClass: "col-md-10 px-md-1" },
          [
            _c(
              "base-button",
              {
                attrs: {
                  slot: "footer",
                  type: "info",
                  fill: "",
                  disabled: _vm.isProcessing
                },
                on: { click: _vm.validatorLogo },
                slot: "footer"
              },
              [_vm._v("Guardar")]
            )
          ],
          1
        )
      ])
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/pages/Configuraciones.vue":
/*!************************************************!*\
  !*** ./resources/js/pages/Configuraciones.vue ***!
  \************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Configuraciones_vue_vue_type_template_id_5463a09c___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Configuraciones.vue?vue&type=template&id=5463a09c& */ "./resources/js/pages/Configuraciones.vue?vue&type=template&id=5463a09c&");
/* harmony import */ var _Configuraciones_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Configuraciones.vue?vue&type=script&lang=js& */ "./resources/js/pages/Configuraciones.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Configuraciones_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Configuraciones_vue_vue_type_template_id_5463a09c___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Configuraciones_vue_vue_type_template_id_5463a09c___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/pages/Configuraciones.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/pages/Configuraciones.vue?vue&type=script&lang=js&":
/*!*************************************************************************!*\
  !*** ./resources/js/pages/Configuraciones.vue?vue&type=script&lang=js& ***!
  \*************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Configuraciones_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Configuraciones.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/Configuraciones.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Configuraciones_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/pages/Configuraciones.vue?vue&type=template&id=5463a09c&":
/*!*******************************************************************************!*\
  !*** ./resources/js/pages/Configuraciones.vue?vue&type=template&id=5463a09c& ***!
  \*******************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Configuraciones_vue_vue_type_template_id_5463a09c___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./Configuraciones.vue?vue&type=template&id=5463a09c& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/Configuraciones.vue?vue&type=template&id=5463a09c&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Configuraciones_vue_vue_type_template_id_5463a09c___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Configuraciones_vue_vue_type_template_id_5463a09c___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);