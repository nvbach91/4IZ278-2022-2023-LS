import{_ as c}from"./AppLayout-3b9715ba.js";import p from"./DeleteUserForm-0d8823d8.js";import l from"./LogoutOtherBrowserSessionsForm-c9850e5c.js";import{S as s}from"./SectionBorder-3b4488e1.js";import f from"./TwoFactorAuthenticationForm-35e24aac.js";import u from"./UpdatePasswordForm-0f81ffdd.js";import _ from"./UpdateProfileInformationForm-1e3ec5ee.js";import{o,c as d,w as n,a as i,e as r,b as t,f as a,F as h}from"./app-a1795893.js";import"./_plugin-vue_export-helper-c27b6911.js";import"./DialogModal-762d105c.js";import"./SectionTitle-485bb853.js";import"./DangerButton-eb355acd.js";import"./TextInput-6671b29b.js";import"./SecondaryButton-796ec60b.js";import"./ActionMessage-1965d6a2.js";import"./PrimaryButton-604d5ba9.js";import"./InputLabel-e5d12209.js";import"./FormSection-7ae386fa.js";const g=i("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"}," Profile ",-1),$={class:"max-w-7xl mx-auto py-10 sm:px-6 lg:px-8"},w={key:0},k={key:1},y={key:2},z={__name:"Show",props:{confirmsTwoFactorAuthentication:Boolean,sessions:Array},setup(m){return(e,x)=>(o(),d(c,{title:"Profile"},{header:n(()=>[g]),default:n(()=>[i("div",null,[i("div",$,[e.$page.props.jetstream.canUpdateProfileInformation?(o(),r("div",w,[t(_,{user:e.$page.props.auth.user},null,8,["user"]),t(s)])):a("",!0),e.$page.props.jetstream.canUpdatePassword?(o(),r("div",k,[t(u,{class:"mt-10 sm:mt-0"}),t(s)])):a("",!0),e.$page.props.jetstream.canManageTwoFactorAuthentication?(o(),r("div",y,[t(f,{"requires-confirmation":m.confirmsTwoFactorAuthentication,class:"mt-10 sm:mt-0"},null,8,["requires-confirmation"]),t(s)])):a("",!0),t(l,{sessions:m.sessions,class:"mt-10 sm:mt-0"},null,8,["sessions"]),e.$page.props.jetstream.hasAccountDeletionFeatures?(o(),r(h,{key:3},[t(s),t(p,{class:"mt-10 sm:mt-0"})],64)):a("",!0)])])]),_:1}))}};export{z as default};
