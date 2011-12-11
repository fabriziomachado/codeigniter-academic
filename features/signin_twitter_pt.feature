# language: pt
# features/signin_twitter_pt.feature
Funcionalidade: Logar usando a conta do Twitter
    Para acessar as funcionalidades do sistema 
    Como um usuário do sistema que tem uma conta no twitter    
    Eu preciso ser capaz de me autenticar usando esta conta do twitter

    Contexto: Tentando logar com a conta do twitter
       Dado estar em "session/twitter"

    @javascript
    Cenario: Não autorizando o uso da conta
        Quando carrego no link "Cancelar, e retornar ao aplicativo"
        Entao devo ver "O Twitter não pode autenticar este usuário"  

    @javascript
    Cenario: Autorizando o uso da conta
        Quando preenchi o "username_or_email" com "fabriziocolombo"
        E preenchi o "password" com "123456"
        E carrego no botão "allow"
        Então devo ver "Fabrizio, está logado com sua conta do Twitter!"
