(window.webpackJsonp=window.webpackJsonp||[]).push([[70],{"qt+H":function(e,t,n){"use strict";n.r(t);var a=n("VrN/"),i=n.n(a);n("RKCW"),n("mki7"),n("19Vz");var r={name:"markdown-fieldtype",data:function(){return{codemirror:null}},props:{field:{type:Object,required:!0},value:{required:!1,default:""}},mounted:function(){var e=this;this.codemirror=i.a.fromTextArea(document.getElementById(this.field.handle),{theme:"fusion",mode:{name:"gfm",highlightFormatting:!0,fencedCodeBlockHighlighting:!0},lineWrapping:!0,viewportMargin:1/0,keyMap:"sublime"}),this.codemirror.on("change",(function(t){e.$emit("input",t.getValue())}))}},l=n("KHd+"),o=Object(l.a)(r,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"form__group"},[n("label",{staticClass:"form__label",attrs:{for:e.field.handle},domProps:{innerHTML:e._s(e.field.name)}}),e._v(" "),n("textarea",{directives:[{name:"model",rawName:"v-model",value:e.value,expression:"value"}],attrs:{name:e.field.handle,id:e.field.handle,cols:"30",rows:"10"},domProps:{value:e.value},on:{input:function(t){t.target.composing||(e.value=t.target.value)}}})])}),[],!1,null,null,null);t.default=o.exports}}]);