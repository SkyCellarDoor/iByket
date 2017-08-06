var vue = new Vue({
    el: '#app',
    data: {
        todos: [
            {text: 'Best'},
            {text: 'Bested'}
        ]
    },

    method: {
        clickMe: function () {
            alert('dsadasdas');
        }
    }
});