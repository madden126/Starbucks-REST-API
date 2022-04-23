Projecto desenvolvido por Nuno Correia
Linguagem escolhida: PHP.


# Methods created

Return all drinks ordered by category

    GET /api/readProducts.php


Create a new order

    POST /api/createOrder.php


    Possible parameters
    Parameter | Parameter Type | Description 
    -------------------------------------------------------
    product   | string	       | Drink you want to order
    extras    | array	       | Extras to add to the drink
    money     | string	       | Money to pay the order	

    Example:

    {
        "product":"Latte",
        "extras" : ["Cinnamon", "Syrup"],
        "money" : "6.20"
    }

O método acima faz as seguintes validações:\
    - Verifica se a bebida introduzida em "product" existe.
    - Verifica se há stock da bebida escolhida.\
    - Calcula o total do pedido (bebida + extras caso estes tenham sido escolhidos).\
    - Verifica se o dinheiro dado em "money" é suficiente para cobrir o preço total do pedido.


# DB Structure

    BD criada com 3 tabelas (categories, extras e products), entre elas apenas existe a ligação entre a tabela products e categories através das colunas "idCategory" e "id" respetivamente

    ->foi feito um dump da BD só com as tabelas e os dados de modo a ser possivel testar. -> ficheiro "starbucks.sql"


# Folders & files

>config/

    Database.php -> Configuração da ligação a BD

>api/

    createOrder.php -> Metodo utilizado para criar um pedido novo.

    readProducts.php -> Metodo utilizador para retornar todas as bebidas existentes organizadas por categoria

>class/

    Categories.php
    Extras.php
    Products.php

    Ficheiros com os objetos utilizados, nestes estão presentes propriedades e metodos utilizados geralmente para interação com a BD.

>lib/

    functions.php -> Ficheiro com funções criadas e utilizadas nos ficheiros dos metodos.
