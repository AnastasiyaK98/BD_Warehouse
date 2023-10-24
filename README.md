# База данных "Склад"
Склад. Имеется несколько складов. Для каждого склада известен владелец и название. На каждом складе хранятся товары. Одинаковые товары могут храниться на разных складах. Некоторые склады могут временно пустовать. Известна вместимость каждого склада в тоннах. Складов без владельцев не бывает.\
Товар хранится на складе определенный период времени, по истечении которого списывается и увозится на полигон отходов. Во время хранения товар отпускается по заявкам магазинов.
О каждом товаре известно его наименование, уникальный номер-артикул.\
Товары на склады привозятся на автомашинах. О каждой автомашине известна ее марка, грузоподъемность в тоннах и фамилия владельца. Машин без владельцев не бывает. Имеется информация о поступлениях, показывающая, какая машина, какой товар, на какой склад привозит, в каком количестве (в тоннах).\
Товары в магазины отвозятся теми же автомашинами.\
Разработайте реляционную базу данных для решения задачи учета товаров, имеющихся на складах, изменение его стоимости с учетом времени хранения и учетом поставок в магазины.

В проекте используется СУБД - MS SQL, в качестве локального сеервера используется XAMPP.
