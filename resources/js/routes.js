window.Vue = require('vue');

const files = require.context('./components/global', true, /\.vue$/i);
let Components = {};
files.keys().map(key => {
    let name = key.split('/').pop().split('.')[0];
    Components[name] = Vue.component(name, files(key).default);
})


export const nativeroutes = [
    {
        path: '/',
        redirect: '/app/client'
    },
    {
        path: '/login',
        name: 'login',
        component: Components.Login,
    },
    {
        path: '/app',
        redirect: '/app/client',
        component: Components.MainPage,
        children: [
            {
                path: 'client',
                component: Components.Client,
            },
            {
                path: 'client/:clientId/edit',
                component: Components.ClientEdit,
            },
            {
                path: 'client/:clientId/access',
                component: Components.Access,
            },
            {
                path: 'client/:clientId/access/:accessId/edit',
                component: Components.AccessEdit,
            },
            {
                path: 'template',
                component: Components.Template,
            },
            {
                path: 'template/:templateId/edit',
                component: Components.TemplateEdit,
            },
        ]
    },
    {
        path: '/allelem',
        name: 'allelem',
        component: Components.AllElem,
    },
];
