/******/!function(e){function t(r){if(n[r])return n[r].exports;var o=n[r]={exports:{},id:r,loaded:!1};return e[r].call(o.exports,o,o.exports,t),o.loaded=!0,o.exports}// webpackBootstrap
/******/
var n={};t.m=e,t.c=n,t.p="",t(0)}([function(e,t,n){n(1),n(3),n(2),n(4),n(8),n(9),n(10),n(11),n(12),n(13),n(14),n(15),n(16),n(17),n(19),n(20),e.exports=n(21)},function(e,t,n){"use strict";function r(e,t,n,r,o){e.decorator("$exceptionHandler",["$delegate","$injector",function(e,t){return function(n,r){e(n,r);t.get("logger").getLogger("exceptionHandler").error(n+(r?" ("+r+")":""))}}]),e.decorator("$log",["$delegate",function(e){return o.environment.debug||(e.log=angular.noop,e.debug=angular.noop),e}]),t.debugInfoEnabled(o.environment.debug),n.hashPrefix(""),r.errorOnUnhandledRejections(!1)}r.$inject=["$provide","$compileProvider","$locationProvider","$qProvider","config"],Object.defineProperty(t,"__esModule",{value:!0});n(2).default.config(r)},function(e,t){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),angular.module("translations",[]),t.default=angular.module("app",["translations","gettext","ngAnimate","ngSanitize","ui.router","ui.bootstrap"])},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});n(2).default.constant("config",{version:"1.0.0",environment:{debug:!1,server:{url:"",route:"api"}},supportedLanguages:["en-US","fr-FR"]})},function(e,t,n){"use strict";function r(e,t,r){t.otherwise("/"),e.state("app",{template:n(5),controller:"shellController as shell"}).state("app.home",{url:"/",template:n(6),controller:"homeController as vm",data:{title:r("Home")}}).state("app.about",{url:"/about",template:n(7),controller:"aboutController as vm",data:{title:r("About")}})}r.$inject=["$stateProvider","$urlRouterProvider","gettext"],Object.defineProperty(t,"__esModule",{value:!0});n(2).default.config(r)},function(e,t){e.exports='<section id="shell" class="shell">\x3c!--Header--\x3e<header><nav class="navbar navbar-static-top navbar-inverse"><div class="container-fluid"><div class="navbar-header"><button type="button" class="navbar-toggle" ng-click="shell.toggleMenu()" aria-expanded="{{!shell.menuHidden}}"><span class="sr-only" translate>Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button> <a class="navbar-brand" href="https://github.com/angular-starter-kit"><span translate>APP_NAME</span></a></div><div class="navbar-collapse" uib-collapse="shell.menuHidden"><ul class="nav navbar-nav"><li ng-class="{ active: shell.stateContains(\'app.home\') }"><a class="nav-item text-uppercase" ui-sref="app.home"><i class="fa fa-home"></i> <span translate>Home</span></a></li><li ng-class="{ active: shell.stateContains(\'app.about\') }"><a class="nav-item text-uppercase" ui-sref="app.about"><i class="fa fa-question-circle"></i> <span translate>About</span></a></li></ul><div class="navbar-form navbar-right"><div class="form-group" uib-dropdown><button type="button" class="btn btn-default" uib-dropdown-toggle aria-haspopup="true" aria-expanded="false">{{shell.currentLocale.id}} <span class="caret"></span></button><ul class="dropdown-menu"><li ng-repeat="language in ::shell.languages"><a href ng-click="setLanguage(language)">{{language}}</a></li></ul></div></div></div></div></nav></header>\x3c!--View content--\x3e<div ui-view></div></section>'},function(e,t){e.exports='<section id="home-screen" class="home-screen container-fluid"><div class="jumbotron text-center"><h1><img class="logo" src="images/angularjs-logo.png" alt="angularjs logo"> <span translate>Hello world !</span></h1><div ui-loading="vm.isLoading"></div><p><em class="quote">{{vm.quote}}</em></p></div></section>'},function(e,t){e.exports='<section id="about-screen" class="container-fluid"><div class="jumbotron text-center"><h1 translate>APP_NAME</h1><p><i class="fa fa-bookmark-o"></i> <span translate>Version</span> {{vm.version}}</p></div></section>'},function(e,t,n){"use strict";function r(e,t,n,r,o,a,i,s){function l(e){c.pageTitle=o.getString("APP_NAME"),e&&(c.pageTitle+=" | "+o.getString(e))}var c=n;c.pageTitle="",c.setLanguage=function(n){n=n||e.localStorage.getItem("language");a.includes(i.supportedLanguages,n)||(n="en-US"),o.setCurrentLanguage(n),t.id=n,e.localStorage.setItem("language",n)},c.$on("$stateChangeSuccess",function(e,t){l(t.data?t.data.title:null)}),c.$on("gettextLanguageChanged",function(){l(r.current.data?r.current.data.title:null)}),o.debug=i.environment.debug,c.setLanguage(),s.setServer(i.environment.server)}r.$inject=["$window","$locale","$rootScope","$state","gettextCatalog","_","config","restService"],Object.defineProperty(t,"__esModule",{value:!0});n(2).default.run(r)},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});n(2).default.constant("_",_)},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r=n(2),o=function(){function e(e,t,n,r,o){this.$state=e,this._=n,this.currentLocale=t,this.logger=o.getLogger("shell"),this.languages=r.supportedLanguages,this.menuHidden=!0,this.logger.log("init")}return e.$inject=["$state","$locale","_","config","logger"],e.prototype.toggleMenu=function(){this.menuHidden=!this.menuHidden},e.prototype.stateContains=function(e){return this._.startsWith(this.$state.current.name,e)},e}();t.ShellController=o,r.default.controller("shellController",o)},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r=n(2),o=function(){function e(e,t){this.$window=e,this.cachedData={},this.storage=null,this.logger=t.getLogger("cacheService"),this.loadCacheData()}return e.$inject=["$window","logger"],e.prototype.setCacheData=function(e,t,n,r){var o=this.getCacheKey(e,t);this.cachedData[o]={date:r||new Date,data:n},this.logger.log('Cache set for key: "'+o+'"'),this.saveCacheData()},e.prototype.getCacheData=function(e,t){var n=this.getCacheKey(e,t),r=this.cachedData[n];return r?(this.logger.log('Cache hit for key: "'+n+'"'),r.data):null},e.prototype.getCacheDate=function(e,t){var n=this.getCacheKey(e,t),r=this.cachedData[n];return r?r.date:null},e.prototype.clearCacheData=function(e,t){var n=this.getCacheKey(e,t);this.cachedData[n]=void 0,this.logger.log('Cache cleared for key: "'+n+'"'),this.saveCacheData()},e.prototype.cleanCache=function(e){var t=this;e?angular.forEach(this.cachedData,function(n,r){e>=n.date&&(t.cachedData[r]=void 0)}):this.cachedData={},this.saveCacheData()},e.prototype.setPersistence=function(e){this.cleanCache(),this.storage="local"===e||"session"===e?this.$window[e+"Storage"]:null,this.loadCacheData()},e.prototype.getCacheKey=function(e,t){return e+(t?angular.toJson(t):"")},e.prototype.saveCacheData=function(){this.storage&&(this.storage.cachedData=angular.toJson(this.cachedData))},e.prototype.loadCacheData=function(){var e=this.storage?this.storage.cachedData:null;this.cachedData=e?angular.fromJson(e):{}},e}();t.CacheService=o,r.default.service("cacheService",o)},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r=n(2),o=function(){function e(e){this.logger=e.getLogger("contextService")}return e.$inject=["logger"],e.prototype.inject=function(e,t){var n=this;if(this.logger.log("Injecting context in: "+e),!t)throw"inject: context must be defined";var r=e.match(/(:\w+)/g);return angular.forEach(r,function(r){var o=r.substring(1),a=t[o];if(void 0===a)throw"inject: context."+o+" expected but undefined";a=encodeURIComponent(a),e=e.replace(r,a),n.logger.log("Injected "+a+" for "+r)}),this.logger.log("Resulting REST API: "+e),e},e}();t.ContextService=o,r.default.service("contextService",o)},function(e,t,n){"use strict";function r(e,t,n,r,o){n(t?"["+t+"]":"",e,""),angular.forEach(a,function(n){n(e,t,r,o)})}Object.defineProperty(t,"__esModule",{value:!0});var o=n(2),a=[],i=function(){function e(e,t,n){this.$log=e,this.moduleName=t,this.logFunc=n}return e.prototype.log=function(e,t){this.logFunc(e,this.moduleName,this.$log.log,"log",t)},e.prototype.info=function(e,t){this.logFunc(e,this.moduleName,this.$log.info,"info",t)},e.prototype.warning=function(e,t){this.logFunc(e,this.moduleName,this.$log.warn,"warning",t)},e.prototype.error=function(e,t){this.logFunc(e,this.moduleName,this.$log.error,"error",t)},e}(),s=function(){function e(e){this.$log=e}return e.$inject=["$log"],e.prototype.getLogger=function(e){return new i(this.$log,e,r)},e.prototype.addObserver=function(e){a.push(e)},e}();t.LoggerService=s,o.default.service("logger",s)},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r=n(2),o=function(){function e(e,t,n,r){this.$q=e,this.$http=t,this.cacheService=n,this.server=null,this.baseUrl="",this.defaultConfig={headers:{"content-type":"application/json","Access-Control-Allow-Headers":"content-type"}},this.cacheHandler=angular.identity,this.logger=r.getLogger("restService")}return e.$inject=["$q","$http","cacheService","logger"],e.prototype.get=function(e,t,n,r){var o=this,a=this.baseUrl+e,i=function(){return o.$http.get(a,{params:t})};if(n){var s="force"===n?null:this.cacheService.getCacheData(e,t);if(null!==s&&(s=this.cacheHandler(s)),null===s)return this.logger.log("GET request: "+e),this.createRequest(i,r).then(function(n){return o.cacheService.setCacheData(e,t,n,null),angular.copy(n)});var l=this.$q.defer();return l.resolve(angular.copy(s)),this.errorHandler(l.promise,r)}return this.createRequest(i,r)},e.prototype.put=function(e,t,n){var r=this;this.logger.log("PUT request: "+e,null);return this.createRequest(function(){return r.$http.put(r.baseUrl+e,t,r.defaultConfig)},n)},e.prototype.post=function(e,t,n){var r=this;this.logger.log("POST request: "+e,null);return this.createRequest(function(){return r.$http.post(r.baseUrl+e,t,r.defaultConfig)},n)},e.prototype.delete=function(e,t){var n=this;this.logger.log("DELETE request: "+e,null);return this.createRequest(function(){return n.$http.delete(n.baseUrl+e,n.defaultConfig)},t)},e.prototype.setServer=function(e){this.server=e,this.baseUrl=e.url+e.route},e.prototype.getServer=function(){return this.server},e.prototype.getBaseUrl=function(){return this.baseUrl},e.prototype.setRequestHandler=function(e){this.requestHandler=e},e.prototype.getRequestHandler=function(){return this.requestHandler},e.prototype.setErrorHandler=function(e){this.errorHandler=e},e.prototype.getErrorHandler=function(){return this.errorHandler},e.prototype.setCacheHandler=function(e){this.cacheHandler=e},e.prototype.getCacheHandler=function(){return this.cacheHandler},e.prototype.requestHandler=function(e,t){return e(t)},e.prototype.errorHandler=function(e,t){var n=this;return t&&t.skipErrors||e.catch(function(e){var t;if(404===e.status)t="Server unavailable or URL does not exist";else if(e.data){var r=e.data.message?e.data.message:null,o=e.data.error?e.data.error:null;t=r||o||angular.toJson(e.data)}return t&&n.logger.error(t,null),n.$q.reject(e)}),e},e.prototype.createRequest=function(e,t){return this.errorHandler(this.requestHandler(e,t),t)},e}();t.RestService=o,r.default.service("restService",o)},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r=n(2),o=function(){function e(e,t){this.logger=e.getLogger("about"),this.version=t.version,this.logger.log("init")}return e.$inject=["logger","config"],e}();t.AboutController=o,r.default.controller("aboutController",o)},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r=n(2),o=function(){function e(e,t){var n=this;this.isLoading=!0,this.quote=null,this.logger=e.getLogger("home"),this.quoteService=t,this.logger.log("init"),this.quoteService.getRandomJoke({category:"nerdy"}).then(function(e){n.quote=e}).finally(function(){n.isLoading=!1})}return e.$inject=["logger","quoteService"],e}();t.HomeController=o,r.default.controller("homeController",o)},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r=n(2),o=function(){return function(){this.restrict="A",this.template=n(18),this.scope={message:"<",isLoading:"<uiLoading"}}}();t.LoadingDirective=o,r.default.directive("uiLoading",function(){return new o})},function(e,t){e.exports='<div ng-show="isLoading" class="text-center"><i class="fa fa-cog fa-spin fa-3x"></i> <span>{{message}}</span></div>'},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r=n(2),o=function(){function e(e,t,n){this.$q=e,this.restService=t,this.contextService=n,this.ROUTES={randomJoke:"/jokes/random?escape=javascript&limitTo=[:category]"}}return e.$inject=["$q","restService","contextService"],e.prototype.getRandomJoke=function(e){var t=this;return this.restService.get(this.contextService.inject(this.ROUTES.randomJoke,e),null,!0).then(function(e){return e.data&&e.data.value?e.data.value.joke:t.$q.reject()}).catch(function(){return"Error, could not load joke :-("})},e}();t.QuoteService=o,r.default.service("quoteService",o)},function(e,t){angular.module("translations").run(["gettextCatalog",function(e){e.setStrings("en-US",{About:"About",APP_NAME:"inverscoin","Hello world !":"Hello world !",Home:"Home","Toggle navigation":"Toggle navigation",Version:"Version"})}])},function(e,t){angular.module("translations").run(["gettextCatalog",function(e){e.setStrings("fr-FR",{About:"A propos",APP_NAME:"inverscoin","Hello world !":"Bonjour le monde !",Home:"Accueil","Toggle navigation":"Basculer la navigation",Version:"Version"})}])}]);