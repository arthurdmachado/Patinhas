A AUmigos é uma pet shop que realiza serviços de banho, tosa, consultas e outros cuidados para animais de estimação.

Atualmente, os dados dos clientes e de seus animais são registrados de forma desorganizada, dificultando o controle dos pets atendidos pela empresa.

Para solucionar esse problema, você foi contratado para desenvolver um sistema web para realizar o cadastro e gerenciamento dos clientes e seus animais.

A AUmigos precisa saber quem é o responsável pelo animal e quais animais pertencem a cada cliente.

Objetivo

Desenvolver um sistema CRUD utilizando PHP e MySQL!

O sistema deverá possuir duas tabelas:

clientes
animais

Um cliente poderá possuir vários animais, porém cada animal deverá estar relacionado a apenas um cliente.

Funcionalidades

CRUD de Clientes

O sistema deverá permitir:

Cadastrar clientes;
Listar clientes;
Editar clientes;
Excluir clientes;
Visualizar os dados de um cliente.
CRUD de Animais

O sistema deverá permitir:

Cadastrar animais;
Listar animais;
Editar animais;
Excluir animais;
Associar um animal a um cliente;
Exibir o nome do responsável pelo animal.
No cadastro do animal, o cliente deverá ser selecionado por meio de uma lista de opções.

Regras do sistema

1. Todo animal deve possuir um responsável.
2. Um cliente pode possuir vários animais.
3. Um animal pertence a apenas um cliente.
4. Não deve ser possível cadastrar um animal sem informar seu responsável.
5. Os dados devem ser armazenados no MySQL.
6. Todas as operações de CRUD devem funcionar.
7. A listagem dos animais deverá apresentar o nome do responsável, e não apenas o ID do cliente.
8. O sistema deverá utilizar corretamente a chave primária e a chave estrangeira.

Entrega

O projeto deverá conter:

Código-fonte completo;
Script SQL do banco de dados;
CRUD de clientes;
CRUD de animais;
Relacionamento entre as tabelas;
README com instruções para execução;
Sistema funcionando no ambiente local.