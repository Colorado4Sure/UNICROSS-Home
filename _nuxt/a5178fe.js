(window.webpackJsonp=window.webpackJsonp||[]).push([[139],{952:function(t,e,r){"use strict";r.r(e);r(28),r(20),r(27),r(30),r(23),r(31);var a=r(14),i=r(8),n=r(68);function o(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);e&&(a=a.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,a)}return r}var c=Object(i.c)({name:"Learn",serverPrefetch:function(){var t=this.$config.ctfLearnId,e=this.$i18n.locale,r=this.searchQueryParams;return this.$store.dispatch("learn/getData",{id:t,search:r,locale:e})},head:function(){return{title:"".concat(this.seoTitle),meta:[{property:"og:title",content:"".concat(this.seoTitle),template:function(t){return"".concat(t," - Ditepay")},vmid:"og:title"}]}},computed:function(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?o(Object(r),!0).forEach((function(e){Object(a.a)(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):o(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}({},Object(n.b)("learn",["data","seoTitle"]))}),s=r(15),l=Object(s.a)(c,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{key:"content"},[t.data?[r("lazy-learn-hero",{attrs:{description:t.data.introductoryDescription,image:t.data.introductoryBackgroundImage,link:t.data.introductionVideoUrl,title:t.data.introductoryTitle}}),t._v(" "),r("lazy-learn-resources",{attrs:{heading:t.data.infoHeading,image:t.data.infoArtwork,"sub-heading":t.data.infoDescription}}),t._v(" "),r("lazy-learn-article",{attrs:{"button-text":t.data.searchButtonText,"epistle-heading":t.data.otherEpisodeHeading,"featured-articles":t.data.featuredWebinarArticle,heading:t.data.editorsHeading,lists:t.data.editorsArticlesCollection.items,"other-articles":t.data.otherEpisodeArticlesCollection.items,sections:t.data.sectionsCollection.items,"webinar-heading":t.data.featuredWebinarHeading}})]:t._e()],2)}),[],!1,null,null,null);e.default=l.exports}}]);