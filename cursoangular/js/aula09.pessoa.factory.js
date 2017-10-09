app.factory('Pessoa', function() {
    var Pessoa = function(){
        this.nome = "Fulano";
        this.idade = 40;

        this.sayHello = function() {
            return "Hello " + this.nome + "!";
        }
    };

    return Pessoa;
});