(window.webpackJsonp=window.webpackJsonp||[]).push([[62],{gdbQ:function(t,a,e){"use strict";e.r(a);var s={data:function(){return{errors:{},flags:[{label:"None",value:""},{label:"All Access",value:"all-access"},{label:"No Access",value:"no-access"}],id:"",name:"",slug:"",description:"",special:""}},methods:{hasError:function(t){return void 0!==this.errors[t]},getError:function(t){return this.hasError(t)?this.errors[t][0]:""},submit:function(){var t=this;axios.patch("/api/roles/"+this.id,{name:this.name,slug:this.slug,description:this.description,special:this.special}).then(function(a){toast("Role successfully updated","success"),t.$router.push("/roles")}).catch(function(a){toast(a.response.data.message,"failed"),t.errors=a.response.data.errors})}},beforeRouteEnter:function(t,a,e){axios.all([axios.get("/api/roles/"+t.params.role)]).then(axios.spread(function(t){e(function(a){a.role=t.data.data,a.id=t.data.data.id,a.slug=t.data.data.slug,a.name=t.data.data.name,a.description=t.data.data.description,a.special=t.data.data.special||""})}))}},r=e("KHd+"),i=Object(r.a)(s,function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",[e("portal",{attrs:{to:"title"}},[e("app-title",{attrs:{icon:"crown"}},[t._v("Edit Role")])],1),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"content-container"},[e("form",{on:{submit:function(a){return a.preventDefault(),t.submit(a)}}},[e("p-card",[e("div",{staticClass:"row"},[e("div",{staticClass:"col xl:text-right w-full xl:w-1/3"},[e("div",{staticClass:"xl:mr-10"},[e("h3",[t._v("Basic Information")]),t._v(" "),e("p",{staticClass:"text-sm"},[t._v("What is the name and description of this role?")])])]),t._v(" "),e("div",{staticClass:"col w-full xl:w-2/3"},[e("p-input",{attrs:{name:"name",label:"Name",autocomplete:"off","has-error":t.hasError("name"),"error-message":t.getError("name"),autofocus:"",required:""},model:{value:t.name,callback:function(a){t.name=a},expression:"name"}}),t._v(" "),e("p-slug",{attrs:{name:"slug",label:"Slug",autocomplete:"off","has-error":t.hasError("slug"),"error-message":t.getError("slug"),required:"",watch:t.name},model:{value:t.slug,callback:function(a){t.slug=a},expression:"slug"}}),t._v(" "),e("p-input",{attrs:{name:"description",label:"Description",autocomplete:"off","has-error":t.hasError("description"),"error-message":t.getError("description"),required:""},model:{value:t.description,callback:function(a){t.description=a},expression:"description"}})],1)]),t._v(" "),e("hr"),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col xl:text-right w-full xl:w-1/3"},[e("div",{staticClass:"xl:mr-10"},[e("h3",[t._v("Attributes")]),t._v(" "),e("p",{staticClass:"text-sm"},[t._v("Assign any additional attribute values for your role.")])])]),t._v(" "),e("div",{staticClass:"col w-full xl:w-2/3"},[e("p-select",{attrs:{name:"special",label:"Special Flag",options:t.flags,autocomplete:"off","has-error":t.hasError("special"),"error-message":t.getError("special"),required:""},model:{value:t.special,callback:function(a){t.special=a},expression:"special"}})],1)])]),t._v(" "),e("portal",{attrs:{to:"actions"}},[e("router-link",{staticClass:"button mr-3",attrs:{to:{name:"roles"}}},[t._v("Cancel")]),t._v(" "),e("button",{staticClass:"button button--primary",attrs:{type:"submit"},on:{click:function(a){return a.preventDefault(),t.submit(a)}}},[t._v("Save Role")])],1)],1)])])],1)},[],!1,null,null,null);a.default=i.exports}}]);