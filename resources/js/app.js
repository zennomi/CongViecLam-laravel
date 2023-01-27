require('./bootstrap');

window.Vue = require('vue');

Vue.component("application-kanban-board", require("./components/Company/ApplicationKanbanBoard.vue").default);

const app = new Vue({
    el: '#app',
});
