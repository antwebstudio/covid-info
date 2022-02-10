
if (typeof(window.Vue) == 'undefined') {
    // window.Vue = require('vue');
}

Vue.component('tags-fieldtype', () => import('./components/Fieldtypes/Tags/Field'))

window.Fusion.booting(function(router, store) {
	router.addRoutes([
		{
			path: '/tags',
            component: () => import('./pages/Tag/Index'),
            name: 'tag',
            meta: {
                requiresAuth: true,
                layout: 'admin'
            }
		},
		{
			path: '/tags/:id/edit',
            component: () => import('./pages/Tag/Edit'),
            name: 'tag.edit',
            meta: {
                requiresAuth: true,
                layout: 'admin'
            }
		}
		// {
		// 	path: '/tags/:tag/show',
        //     component: () => import('./pages/Tag/Show'),
        //     name: 'tag.show',
        //     meta: {
        //         requiresAuth: true,
        //         layout: 'admin'
        //     }
		// }
	])
})

window.addEventListener('DOMContentLoaded', function () {
})
