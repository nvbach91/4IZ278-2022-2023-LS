import{d as p,C as H,o as t,e as a,a as l,r as N,b as s,w as o,g as n,t as k,B,n as g,m as O,T as Q,k as Y,q as D,c as h,K as I,f as u,u as F,F as U,h as z,O as P}from"./app-a1795893.js";import{b as G,a as W}from"./DialogModal-762d105c.js";import{_ as R,a as q}from"./TextInput-6671b29b.js";import{_ as $}from"./PrimaryButton-604d5ba9.js";import{_ as C}from"./SecondaryButton-796ec60b.js";import{_ as j}from"./DangerButton-eb355acd.js";import{_ as J}from"./InputLabel-e5d12209.js";import"./SectionTitle-485bb853.js";import"./_plugin-vue_export-helper-c27b6911.js";const X={class:"mt-4"},y={__name:"ConfirmsPassword",props:{title:{type:String,default:"Confirm Password"},content:{type:String,default:"For your security, please confirm your password to continue."},button:{type:String,default:"Confirm"}},emits:["confirmed"],setup(w,{emit:b}){const c=p(!1),e=H({password:"",error:"",processing:!1}),i=p(null),_=()=>{axios.get(route("password.confirmation")).then(r=>{r.data.confirmed?b("confirmed"):(c.value=!0,setTimeout(()=>i.value.focus(),250))})},v=()=>{e.processing=!0,axios.post(route("password.confirm"),{password:e.password}).then(()=>{e.processing=!1,d(),O().then(()=>b("confirmed"))}).catch(r=>{e.processing=!1,e.error=r.response.data.errors.password[0],i.value.focus()})},d=()=>{c.value=!1,e.password="",e.error=""};return(r,m)=>(t(),a("span",null,[l("span",{onClick:_},[N(r.$slots,"default")]),s(G,{show:c.value,onClose:d},{title:o(()=>[n(k(w.title),1)]),content:o(()=>[n(k(w.content)+" ",1),l("div",X,[s(R,{ref_key:"passwordInput",ref:i,modelValue:e.password,"onUpdate:modelValue":m[0]||(m[0]=T=>e.password=T),type:"password",class:"mt-1 block w-3/4",placeholder:"Password",autocomplete:"current-password",onKeyup:B(v,["enter"])},null,8,["modelValue","onKeyup"]),s(q,{message:e.error,class:"mt-2"},null,8,["message"])])]),footer:o(()=>[s(C,{onClick:d},{default:o(()=>[n(" Cancel ")]),_:1}),s($,{class:g(["ml-3",{"opacity-25":e.processing}]),disabled:e.processing,onClick:v},{default:o(()=>[n(k(w.button),1)]),_:1},8,["class","disabled"])]),_:1},8,["show"])]))}},Z={key:0,class:"text-lg font-medium text-gray-900"},ee={key:1,class:"text-lg font-medium text-gray-900"},te={key:2,class:"text-lg font-medium text-gray-900"},oe=l("div",{class:"mt-3 max-w-xl text-sm text-gray-600"},[l("p",null," When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone's Google Authenticator application. ")],-1),ae={key:3},se={key:0},ne={class:"mt-4 max-w-xl text-sm text-gray-600"},re={key:0,class:"font-semibold"},le={key:1},ce=["innerHTML"],ie={key:0,class:"mt-4 max-w-xl text-sm text-gray-600"},ue={class:"font-semibold"},de=["innerHTML"],me={key:1,class:"mt-4"},fe={key:1},pe=l("div",{class:"mt-4 max-w-xl text-sm text-gray-600"},[l("p",{class:"font-semibold"}," Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost. ")],-1),ve={class:"grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg"},_e={class:"mt-5"},he={key:0},ye={key:1},$e={__name:"TwoFactorAuthenticationForm",props:{requiresConfirmation:Boolean},setup(w){const b=w,c=p(!1),e=p(!1),i=p(!1),_=p(null),v=p(null),d=p([]),r=Q({code:""}),m=Y(()=>{var f;return!c.value&&((f=I().props.auth.user)==null?void 0:f.two_factor_enabled)});D(m,()=>{m.value||(r.reset(),r.clearErrors())});const T=()=>{c.value=!0,P.post(route("two-factor.enable"),{},{preserveScroll:!0,onSuccess:()=>Promise.all([L(),M(),S()]),onFinish:()=>{c.value=!1,e.value=b.requiresConfirmation}})},L=()=>axios.get(route("two-factor.qr-code")).then(f=>{_.value=f.data.svg}),M=()=>axios.get(route("two-factor.secret-key")).then(f=>{v.value=f.data.secretKey}),S=()=>axios.get(route("two-factor.recovery-codes")).then(f=>{d.value=f.data}),K=()=>{r.post(route("two-factor.confirm"),{errorBag:"confirmTwoFactorAuthentication",preserveScroll:!0,preserveState:!0,onSuccess:()=>{e.value=!1,_.value=null,v.value=null}})},E=()=>{axios.post(route("two-factor.recovery-codes")).then(()=>S())},V=()=>{i.value=!0,P.delete(route("two-factor.disable"),{preserveScroll:!0,onSuccess:()=>{i.value=!1,e.value=!1}})};return(f,A)=>(t(),h(W,null,{title:o(()=>[n(" Two Factor Authentication ")]),description:o(()=>[n(" Add additional security to your account using two factor authentication. ")]),content:o(()=>[m.value&&!e.value?(t(),a("h3",Z," You have enabled two factor authentication. ")):m.value&&e.value?(t(),a("h3",ee," Finish enabling two factor authentication. ")):(t(),a("h3",te," You have not enabled two factor authentication. ")),oe,m.value?(t(),a("div",ae,[_.value?(t(),a("div",se,[l("div",ne,[e.value?(t(),a("p",re," To finish enabling two factor authentication, scan the following QR code using your phone's authenticator application or enter the setup key and provide the generated OTP code. ")):(t(),a("p",le," Two factor authentication is now enabled. Scan the following QR code using your phone's authenticator application or enter the setup key. "))]),l("div",{class:"mt-4 p-2 inline-block bg-white",innerHTML:_.value},null,8,ce),v.value?(t(),a("div",ie,[l("p",ue,[n(" Setup Key: "),l("span",{innerHTML:v.value},null,8,de)])])):u("",!0),e.value?(t(),a("div",me,[s(J,{for:"code",value:"Code"}),s(R,{id:"code",modelValue:F(r).code,"onUpdate:modelValue":A[0]||(A[0]=x=>F(r).code=x),type:"text",name:"code",class:"block mt-1 w-1/2",inputmode:"numeric",autofocus:"",autocomplete:"one-time-code",onKeyup:B(K,["enter"])},null,8,["modelValue","onKeyup"]),s(q,{message:F(r).errors.code,class:"mt-2"},null,8,["message"])])):u("",!0)])):u("",!0),d.value.length>0&&!e.value?(t(),a("div",fe,[pe,l("div",ve,[(t(!0),a(U,null,z(d.value,x=>(t(),a("div",{key:x},k(x),1))),128))])])):u("",!0)])):u("",!0),l("div",_e,[m.value?(t(),a("div",ye,[s(y,{onConfirmed:K},{default:o(()=>[e.value?(t(),h($,{key:0,type:"button",class:g(["mr-3",{"opacity-25":c.value}]),disabled:c.value},{default:o(()=>[n(" Confirm ")]),_:1},8,["class","disabled"])):u("",!0)]),_:1}),s(y,{onConfirmed:E},{default:o(()=>[d.value.length>0&&!e.value?(t(),h(C,{key:0,class:"mr-3"},{default:o(()=>[n(" Regenerate Recovery Codes ")]),_:1})):u("",!0)]),_:1}),s(y,{onConfirmed:S},{default:o(()=>[d.value.length===0&&!e.value?(t(),h(C,{key:0,class:"mr-3"},{default:o(()=>[n(" Show Recovery Codes ")]),_:1})):u("",!0)]),_:1}),s(y,{onConfirmed:V},{default:o(()=>[e.value?(t(),h(C,{key:0,class:g({"opacity-25":i.value}),disabled:i.value},{default:o(()=>[n(" Cancel ")]),_:1},8,["class","disabled"])):u("",!0)]),_:1}),s(y,{onConfirmed:V},{default:o(()=>[e.value?u("",!0):(t(),h(j,{key:0,class:g({"opacity-25":i.value}),disabled:i.value},{default:o(()=>[n(" Disable ")]),_:1},8,["class","disabled"]))]),_:1})])):(t(),a("div",he,[s(y,{onConfirmed:T},{default:o(()=>[s($,{type:"button",class:g({"opacity-25":c.value}),disabled:c.value},{default:o(()=>[n(" Enable ")]),_:1},8,["class","disabled"])]),_:1})]))])]),_:1}))}};export{$e as default};
