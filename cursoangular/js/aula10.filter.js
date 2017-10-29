app.filter('sayHello', function() {
    return function(nome) {
        return "Hello " + nome + "!";
    }
});