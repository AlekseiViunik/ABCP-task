1. 🇷🇺 [Задание](#тестовое-задание-для-разработчика-на-php)
2. 🇷🇺 [Изменения](#внесенные-исправления)
3. 🇬🇧 [Assignment](#test-assignment-for-php-developer)
4. 🇬🇧 [Changes](#changes-made)

### Тестовое задание для разработчика на PHP
Мы ожидаем, что Вы найдете все возможные ошибки (синтаксические, проектирования, безопасности и т.д.)

### Внесенные исправления
 
1. Файл 1.php:
- Добавлен импорт `Exception` и `InvalidArgumentException`.
- Константа `LIMIT` записана капсом и для нее добавлен модификатор доступа.
- Добавлен модификатор доступа для метода `getUsers`.
- Метод `getUsers` объявлен с типом `int` для параметра `ageFrom`, поэтому нет необходимости приводить его к целочисленному типу в теле функции, отсекая лишние проблемы. Строка `$ageFrom = (int)trim($ageFrom);` в таком случае кажется избыточной и поэтому удалена.
- Метод `getByNames` не требует статического контекста, поэтому модификатор `static` удален.
- Добавлена строка `@param array $names` в PHPDoc метода `getByNames`.
- Сам параметр также добавлен для метода `getByNames` вместо того, чтобы использовать глобальную переменную. Это необходимо для чистоты кода, сохранения принципа инкапсуляции, придания гибкости методу и защиты от таких уязвимостей как XSS.
- Добавлено использование `array_map` в метод `getByNames` для лаконичности и улучшения читаемости
- Указание типа параметра для `users` в PHPDoc метода `users`
- Добавление аннотации `@throws Exception`
- Переименование метода `users` в `addUsersToDataBase`. Наименование функции должно передавать ее назначение.
- Указание типа передаваемого параметра для метода `addUsersToDataBase`
- Добавлено присвоение экземпляра класса `\Gateway\User` переменной `gateway`. Теперь везде, где используется `\Gateway\User::getInstance()`, вместо этого мы можем обращаться к переменной.
- Создание метода `validateUser` для валидации передаваемых данных и его вызов для каждого отдельного юзера перед попыткой записать его в базу.
- Нет смысла коммитить транзакцию после добавления каждого пользователя. Коммит транзакции вынесен за пределы цикла. Пользователи либо будут добавлены все, либо не будет добавлено ни одного.
- Выбрасываем пойманное исключение сразу после отката транзакции.
- Приведение кода к стандарту PSR-12 с помощью Code Sniffer.

2. Файл 2.php:
- Создание `.env` файла с секретами.
- Создание `env_loader` файла с загрузкой секретов.
- Использование метода `getenv` для получения данных для подключения к БД.
- Атрибут `ATTR_ERRMODE` установлен в значение `ERRMODE_EXCEPTION` чтобы выбрасывать исключения при возникновении ошибок в базе данных, а не использовать стандартные предупреждения.
- Добавление именованных параметров `:ageFrom` и `:limit` в SQL-запросе для предотвращения SQL инъекций.
- Добавление `true` в `json_decode`, чтобы декодировать JSON-строку в ассоциативный массив, а не в объект.
- Установка значения `null` для `'key' => $settings['key']`, если ключ не найден. Это позволяет избежать ошибок доступа к несуществующему ключу и гарантирует, что значение всегда будет определено, даже если ключ отсутствует.
- Строки, длина которых превышает 120 символов, разделены на несколько строк покороче
- Добавление именованного параметра `:name` в SQL-запросе для предотвращения SQL инъекций.
- Метод `user` переименован в `getUserByName`
- Метод `add` переименован в `addUserToDataBase`
- В SQL запросе метода `addUserToDataBase` для VALUES последовательность значений изменена на правильную.
- Приведение кода к стандарту PSR-12 с помощью Code Sniffer.


### Test Assignment for PHP Developer
We expect you to find all possible errors (syntax, design, security, etc.)

### Changes Made
1. File 1.php:
- Added import for `Exception` and `InvalidArgumentException`.
- The constant `LIMIT` is written in uppercase and has an access modifier added.
- Added access modifier for the `getUsers` method.
- The `getUsers` method is declared with the `int` type for the `ageFrom` parameter, so there's no need to cast it to an integer in the function body, avoiding unnecessary issues. The line `$ageFrom = (int)trim($ageFrom);` was therefore removed as redundant.
- The `getByNames` method does not require a static context, so the `static` modifier was removed.
- Added the line `@param array $names` in the PHPDoc for the `getByNames` method.
- The parameter itself was also added to the `getByNames` method instead of using a global variable. This is necessary for code cleanliness, preserving encapsulation, providing method flexibility, and protecting against vulnerabilities like XSS.
- Added the use of `array_map` in the `getByNames` method for conciseness and improved readability.
- Specified the parameter type for `users` in the PHPDoc for the `users` method.
- Added the `@throws Exception` annotation.
- Renamed the `users` method to `addUsersToDataBase`. The function name should convey its purpose.
- Specified the type for the parameter passed to the `addUsersToDataBase` method.
- Added the assignment of an instance of the `\Gateway\User` class to the `$gateway` variable. Now, wherever `\Gateway\User::getInstance()` was used, we can refer to the variable instead.
- Created a `validateUser` method for validating the passed data and called it for each individual user before attempting to write them to the database.
- There's no need to commit the transaction after adding each user. The transaction commit was moved outside the loop. Users will either all be added, or none will be.
- Rethrow the caught exception immediately after rolling back the transaction.
- Brought the code to PSR-12 standard using Code Sniffer.

2. File 2.php:
- Created a `.env` file with secrets.
- Created an `env_loader` file to load secrets.
- Used the `getenv` method to retrieve database connection details.
- Set the `ATTR_ERRMODE` attribute to `ERRMODE_EXCEPTION` to throw exceptions on database errors instead of using standard warnings.
- Added named parameters `:ageFrom` and `:limit` in the SQL query to prevent SQL injection.
- Added `true` in `json_decode` to decode the JSON string into an associative array instead of an object.
- Set the value to `null` for `'key' => $settings['key']` if the key is not found. This avoids errors when accessing a non-existent key and ensures that the value is always defined, even if the key is absent.
- Split lines longer than 120 characters into shorter lines.
- Added the named parameter `:name` in the SQL query to prevent SQL injection.
- Renamed the `user` method to `getUserByName`.
- Renamed the `add` method to `addUserToDataBase`.
- In the SQL query of the `addUserToDataBase` method, corrected the sequence of values in VALUES.
- Brought the code to PSR-12 standard using Code Sniffer.