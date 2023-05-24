import{S as w}from"./SectionTitle-485bb853.js";import{o as h,e as p,b as c,w as n,r as o,a as s,q as v,s as x,x as _,k as g,c as y,l as r,A as m,z as u,n as b,f as $,D as k}from"./app-a1795893.js";const B={class:"md:grid md:grid-cols-3 md:gap-6"},S={class:"mt-5 md:mt-0 md:col-span-2"},C={class:"px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg"},q={__name:"ActionSection",setup(e){return(a,t)=>(h(),p("div",B,[c(w,null,{title:n(()=>[o(a.$slots,"title")]),description:n(()=>[o(a.$slots,"description")]),_:3}),s("div",S,[s("div",C,[o(a.$slots,"content")])])]))}},E={class:"fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50","scroll-region":""},W=s("div",{class:"absolute inset-0 bg-gray-500 opacity-75"},null,-1),z=[W],D={__name:"Modal",props:{show:{type:Boolean,default:!1},maxWidth:{type:String,default:"2xl"},closeable:{type:Boolean,default:!0}},emits:["close"],setup(e,{emit:a}){const t=e;v(()=>t.show,()=>{t.show?document.body.style.overflow="hidden":document.body.style.overflow=null});const l=()=>{t.closeable&&a("close")},i=d=>{d.key==="Escape"&&t.show&&l()};x(()=>document.addEventListener("keydown",i)),_(()=>{document.removeEventListener("keydown",i),document.body.style.overflow=null});const f=g(()=>({sm:"sm:max-w-sm",md:"sm:max-w-md",lg:"sm:max-w-lg",xl:"sm:max-w-xl","2xl":"sm:max-w-2xl"})[t.maxWidth]);return(d,A)=>(h(),y(k,{to:"body"},[c(m,{"leave-active-class":"duration-200"},{default:n(()=>[r(s("div",E,[c(m,{"enter-active-class":"ease-out duration-300","enter-from-class":"opacity-0","enter-to-class":"opacity-100","leave-active-class":"ease-in duration-200","leave-from-class":"opacity-100","leave-to-class":"opacity-0"},{default:n(()=>[r(s("div",{class:"fixed inset-0 transform transition-all",onClick:l},z,512),[[u,e.show]])]),_:1}),c(m,{"enter-active-class":"ease-out duration-300","enter-from-class":"opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95","enter-to-class":"opacity-100 translate-y-0 sm:scale-100","leave-active-class":"ease-in duration-200","leave-from-class":"opacity-100 translate-y-0 sm:scale-100","leave-to-class":"opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"},{default:n(()=>[r(s("div",{class:b(["mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto",f.value])},[e.show?o(d.$slots,"default",{key:0}):$("",!0)],2),[[u,e.show]])]),_:3})],512),[[u,e.show]])]),_:3})]))}},M={class:"px-6 py-4"},N={class:"text-lg font-medium text-gray-900"},T={class:"mt-4 text-sm text-gray-600"},V={class:"flex flex-row justify-end px-6 py-4 bg-gray-100 text-right"},O={__name:"DialogModal",props:{show:{type:Boolean,default:!1},maxWidth:{type:String,default:"2xl"},closeable:{type:Boolean,default:!0}},emits:["close"],setup(e,{emit:a}){const t=()=>{a("close")};return(l,i)=>(h(),y(D,{show:e.show,"max-width":e.maxWidth,closeable:e.closeable,onClose:t},{default:n(()=>[s("div",M,[s("div",N,[o(l.$slots,"title")]),s("div",T,[o(l.$slots,"content")])]),s("div",V,[o(l.$slots,"footer")])]),_:3},8,["show","max-width","closeable"]))}};export{D as _,q as a,O as b};
