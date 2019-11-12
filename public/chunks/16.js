(window.webpackJsonp=window.webpackJsonp||[]).push([[16],{ke3Z:function(e,t,a){"use strict";function n(e,t){for(var a=0;a<t.length;a++){var n=t[a];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}var s=function(){function e(){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.errors={}}var t,a,s;return t=e,(a=[{key:"has",value:function(e){return this.errors.hasOwnProperty(e)}},{key:"any",value:function(){return Object.keys(this.errors).length>0}},{key:"get",value:function(e){if(this.errors[e])return this.errors[e][0]}},{key:"record",value:function(e){this.errors=e.errors}},{key:"clear",value:function(e){e?delete this.errors[e]:this.errors={}}}])&&n(t.prototype,a),s&&n(t,s),e}(),i=a("5fFP");function r(e,t){for(var a=0;a<t.length;a++){var n=t[a];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}a.d(t,"a",(function(){return o}));var o=function(){function e(t){var a=arguments.length>1&&void 0!==arguments[1]&&arguments[1];for(var n in function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.errors=new s,this.originalData=t,this.hasChanges=!1,this.preventNavigation=a,t)this[n]=t[n]}var t,a,n;return t=e,(a=[{key:"set",value:function(e,t){this.data[e]=t}},{key:"get",value:function(e){return this.data[e]}},{key:"reset",value:function(){for(var e in this.originalData)this[e]=this.originalData[e];this.errors.clear()}},{key:"data",value:function(){var e={};for(var t in this.originalData)e[t]=this[t];return e}},{key:"post",value:function(e){return this.submit("post",e)}},{key:"patch",value:function(e){return this.submit("patch",e)}},{key:"put",value:function(e){return this.submit("put",e)}},{key:"delete",value:function(e){return this.submit("delete",e)}},{key:"submit",value:function(e,t){var a=this;return new Promise((function(n,s){axios[e](t,a.data()).then((function(e){a.onSuccess(e.data),i.a.commit("form/setPreventNavigation",!1),n(e.data)})).catch((function(e){a.onFailure(e.response.data),s(e.response.data)}))}))}},{key:"onSuccess",value:function(e){}},{key:"onFailure",value:function(e){this.errors.record(e)}},{key:"onFirstChange",value:function(e){this.hasChanges=!0,this.preventNavigation&&i.a.commit("form/setPreventNavigation",!0)}}])&&r(t.prototype,a),n&&r(t,n),e}()},uPdR:function(e,t,a){"use strict";a.r(t);var n=a("ke3Z"),s={data:function(){return{id:null,sections:[],originalSections:[],hasChanges:!1,loaded:!1,form:new n.a({name:"",handle:""},!0)}},methods:{submit:function(){var e=this;this.form.patch("/api/fieldsets/"+this.id).then((function(t){var a={};a.sections=e.sections,axios.post("/api/fieldsets/".concat(e.id,"/sections"),a).then((function(t){toast("Fieldset successfully updated","success"),e.$router.push("/fieldsets")}))})).catch((function(e){toast(e.response.data.message,"failed")}))},sectionsChanged:function(e){this.loaded&&!this.hasChanges&&(_.isEqual(this.originalSections,e)||(this.hasChanges=!0,this.form.onFirstChange()))}},beforeRouteEnter:function(e,t,a){axios.all([axios.get("/api/fieldsets/"+e.params.fieldset)]).then(axios.spread((function(e){a((function(t){t.id=e.data.data.id,t.sections=e.data.data.sections,t.originalSections=_.cloneDeep(t.sections),t.form.name=e.data.data.name,t.form.handle=e.data.data.handle,t.loaded=!0}))}))).catch((function(e){a("/fieldsets"),toast("The requested fieldset could not be found","warning")}))}},i=a("KHd+"),r=Object(i.a)(s,(function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",[a("portal",{attrs:{to:"title"}},[a("app-title",{attrs:{icon:"ballot"}},[e._v("Edit Fieldset")])],1),e._v(" "),a("form",{on:{"~input":function(t){return e.form.onFirstChange(t)}}},[a("p-card",[a("div",{staticClass:"row"},[a("div",{staticClass:"col xxl:text-right w-full xxl:w-1/3 xxxl:w-1/4"},[a("div",{staticClass:"xxl:mr-10"},[a("h3",[e._v("General")]),e._v(" "),a("p",{staticClass:"text-sm"},[e._v("What will this fieldset be called?")])])]),e._v(" "),a("div",{staticClass:"col w-full xxl:w-2/3"},[a("p-input",{attrs:{name:"name",label:"Name",help:"What this fieldset will be called.",autocomplete:"off",autofocus:"",required:"","has-error":e.form.errors.has("name"),"error-message":e.form.errors.get("name")},model:{value:e.form.name,callback:function(t){e.$set(e.form,"name",t)},expression:"form.name"}}),e._v(" "),a("p-slug",{attrs:{name:"handle",label:"Handle",help:"A developer-friendly variant of the fieldset's name.",autocomplete:"off",required:"",delimiter:"_",watch:e.form.name,"has-error":e.form.errors.has("handle"),"error-message":e.form.errors.get("handle")},model:{value:e.form.handle,callback:function(t){e.$set(e.form,"handle",t)},expression:"form.handle"}})],1)])]),e._v(" "),a("section-builder",{staticClass:"mt-6",on:{input:e.sectionsChanged},model:{value:e.sections,callback:function(t){e.sections=t},expression:"sections"}}),e._v(" "),a("portal",{attrs:{to:"actions"}},[a("router-link",{staticClass:"button mr-3",attrs:{to:{name:"fieldsets"}}},[e._v("Go Back")]),e._v(" "),a("button",{staticClass:"button button--primary",attrs:{type:"submit"},on:{click:function(t){return t.preventDefault(),e.submit(t)}}},[e._v("Save Fieldset")])],1)],1)],1)}),[],!1,null,null,null);t.default=r.exports}}]);