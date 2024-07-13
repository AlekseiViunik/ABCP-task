### Тестовое задание для разработчика на PHP
Мы ожидаем, что Вы:
* найдете и исправите все возможные ошибки (синтаксические, проектирования, безопасности и т.д.);
* отрефакторите код файла `ReturnOperation.php` в лучший по вашему мнению вид;
* напишите в комментарии краткое резюме по коду: назначение кода и его качество.

### Внесенные исправления
1. Файл others.php:
- Для каждого класса создан отдельный файл.
- Для внеклассовых функций создан отдельный класс и помещен в отдельный файл.
- Изменена структура хранения файлов в папке `v2`.

2. Класс Contractor:
- Добавлен PHPDoc для класса и атрибутов.
- Добавлен конструктор.
- Добавлен PHPDoc для `getById` и `getFullName`.

3. Класс Employee:
- Добавлен PHPDoc для класса.

4. Класс Seller:
- Добавлен PHPDoc для класса.

5. Класс Status:
- Добавлен PHPDoc для класса и атрибутов.
- Для атрибутов указан тип.
- Добавлен конструктор.
- Добавлен PHPDoc для `getName`.
- В `getName` изменено название переменной на более понятное.
- Добавлена обработка возвращения результата, если переданный в `getName` ключ отсутствует.

6. Класс ReferencesOperation:
- Добавлен PHPDoc для класса и методов.
- Изменено наименование передаваемого в `getRequest` параметра.
- Для метода `getRequest` добавлено возвращение `null`, если параметр не найден.

7. Класс NotificationEvents:
- Добавлен PHPDoc для класса.

8. Внеклассовые методы:
- Методы `getResellerEmailFrom` и `getEmailsByPermit` перенесены в класс `EmailHelper`.
- Для методов и нового класса добавлен PHPDoc.
- В `EmailHelper` также добавлен новый метод `sendMessage`, который используется вместо `MessagesClient::sendMessage` в `ReturnOperation.php`.
- Для `getResellerEmailFrom` добавлены параметр и тип возвращаемого значения.
- Для `getEmailsByPermit` указаны типы параметров и тип возвращаемого значения.

9. Файл ReturnOperation.php:
- Импорт `Exception`.
- Добавлена константа `EVENT = 'tsGoodsReturn'`.
- Метод `doOperation` возвращает массив вместо ничего.
- Добавлено использование методов `EmailHelper` вместо внеклассовых функций.
- Переменные `cFullName`, `cr` и `et` переименованны.
- Добавлен/обновлен PHPDoc для класс и метода.
- Выбрасывается исключение, если при вызове `getRequest` не получено никаких данных.
- Некоторые условия на проверку, что переменная пустая или ===null заменены на проверку `if (!$var)`.
- `resellerId` приводится к `int` при первичном получении. Последующие приведения к `int` удалены как ненужные
- Приведение кода к стандарту PSR-12 с помощью Code Sniffer.
- Переименование класса.


### Test Assignment for PHP Developer
We expect you to:
* find and fix all possible errors (syntax, design, security, etc.);
* refactor the code of the ReturnOperation.php file into the best form in your opinion;
* write a brief summary in the comments about the code: its purpose and quality.

### Changes Made
1. File others.php:
- Created a separate file for each class.
- Created a separate class for non-class functions and placed it in a separate file.
- Changed the file structure in the `v2` folder.

2. Contractor Class:
- Added PHPDoc for the class and attributes.
- Added a constructor.
- Added PHPDoc for `getById` and `getFullName`.

3. Employee Class:
- Added PHPDoc for the class.

4. Seller Class:
- Added PHPDoc for the class.

5. Status Class:
- Added PHPDoc for the class and attributes.
- Specified types for the attributes.
- Added a constructor.
- Added PHPDoc for `getName`.
- Changed the variable name in `getName` to a more descriptive one.
- Added handling for returning a result if the key passed to `getName` is not found.

6. ReferencesOperation Class:
- Added PHPDoc for the class and methods.
- Changed the name of the parameter passed to `getRequest`.
- Added returning `null` in `getRequest` if the parameter is not found.

7. NotificationEvents Class:
- Added PHPDoc for the class.

8. Non-class Methods:
- Moved the `getResellerEmailFrom` and `getEmailsByPermit` methods to the `EmailHelper` class.
- Added PHPDoc for the methods and the new class.
- Added a new `sendMessage` method to `EmailHelper`, which is used instead of `MessagesClient::sendMessage` in `ReturnOperation.php`.
- Added parameter and return type for `getResellerEmailFrom`.
- Specified parameter types and return type for `getEmailsByPermit`.

9. File ReturnOperation.php:
- Imported `Exception`.
- Added the constant `EVENT = 'tsGoodsReturn'`.
- The `doOperation` method now returns an array instead of void.
- Replaced non-class functions with methods from `EmailHelper`.
- Renamed variables `cFullName`, `cr`, and `et`.
- Added/updated PHPDoc for the class and method.
- Throws an exception if no data is received when calling `getRequest`.
- Some conditions checking if a variable is empty or ===null were replaced with `if (!$var)`.
- `resellerId` is cast to `int` upon initial retrieval. Subsequent casts to `int` were removed as unnecessary.
- Brought the code to PSR-12 standard using Code Sniffer.
- Renamed the class.
