###Тестовое задание по laravel:
Есть студенты, есть классы, и есть лекции.

У студента есть имя и email (уникальный).
У класса есть название (уникальное).
У лекции есть тема (уникальная) и описание.

Студент может состоять только в одном классе.
В классе может быть много студентов.
У каждого класса есть учебный план состоящий из разных лекций, в учебном плане лекции не могут повторяться.
Разные классы проходят лекции в разном порядке.

Сделать API, в котором будут реализованы следующие методы:
1) получить список всех студентов
   
`GET api/student/all` 
2) получить информацию о конкретном студенте (имя, email + класс + прослушанные лекции)
   
`GET api/student/{id}`

3) создать студента, 4) обновить студента (имя, принадлежность к классу)
   
`POST api/student/set в теле запроса name, email(авторизация), group_id`
5) удалить студента

`DELETE api/student/{id}`
6) получить список всех классов
   
`GET /api/class/all`
7) получить информацию о конкретном классе (название + студенты класса)
   
`GET /api/class/{id}`
8) получить учебный план (список лекций) для конкретного класса
   
`GET /api/plan/{id}`
9) создать/обновить учебный план (очередность и состав лекций) для конкретного класса
   
`POST /api/plan/set в теле запроса group_id + lecture_id(авторизация), order`
10) создать класс, 11) обновить класс (название)
    
`POST /api/class/set в теле запроса id(авторизация), title`

12) удалить класс (при удалении класса, привязанные студенты должны открепляться от класса, но не удаляться полностью из системы)

`DELETE api/class/{id}`
13) получить список всех лекций
    
`GET /api/lecture/all`
14) получить информацию о конкретной лекции (тема, описание + какие классы прослушали лекцию(полностью) + какие студенты прослушали лекцию)
    
`GET /api/lecture/{id}`
15) создать лекцию, 16) обновить лекцию (тема, описание)
    
`POST /api/lecture/set в теле запроса id(авторизация), title, description`
17) удалить лекцию
