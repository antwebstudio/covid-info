(window.webpackJsonp=window.webpackJsonp||[]).push([[31],{EACl:function(e,n,t){"use strict";n.a={props:{value:{type:Object,required:!0}},computed:{settings:function(){return this.value.settings||{}},errors:function(){return this.value.errors||{}}}}},zzBO:function(e,n,t){"use strict";t.r(n);var i={name:"radio-fieldtype",mixins:[t("EACl").a],props:{field:{type:Object,required:!0},value:{required:!1,default:null}}},l=t("KHd+"),r=Object(l.a)(i,(function(){var e=this,n=e.$createElement,t=e._self._c||n;return t("div",[t("p-radio-group",{attrs:{name:e.field.name,label:e.field.name,help:e.field.help,inline:"row"==e.field.settings.display}},e._l(e.field.settings.options,(function(n){return t("p-radio",{key:e.field.name+n.label,attrs:{name:e.field.name,id:n.value,value:n.value,checked:n.value==e.value},on:{input:function(t){return e.$emit("input",n.value)}}},[e._v("\n                "+e._s(n.label)+"\n            ")])})),1)],1)}),[],!1,null,null,null);n.default=r.exports}}]);