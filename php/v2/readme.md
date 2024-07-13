## Оглавление / Table of Contents

1. 🇷🇺 [Задание](#тестовое-задание-для-разработчика-на-php)
2. 🇷🇺 [Назначение](#назначение-кода)
3. 🇷🇺 [Изменения](#внесенные-исправления)
4. 🇬🇧 [Assignment](#test-assignment-for-php-developer)
5. 🇬🇧 [Code Purpose](#code-purpose)
6. 🇬🇧 [Changes](#changes-made)

### Тестовое задание для разработчика на PHP
Мы ожидаем, что Вы:
* найдете и исправите все возможные ошибки (синтаксические, проектирования, безопасности и т.д.);
* отрефакторите код файла `ReturnOperation.php` в лучший по вашему мнению вид;
* напишите в комментарии краткое резюме по коду: назначение кода и его качество.

### Назначение кода
Основной класс и вспомогательные в совокупности Он обрабатывают запросы, проверяет данные и отправляет уведомления по email и SMS.<br><br>
Конкретней:
- Класс `Contractor` и его наследники (Seller, Employee):<br>
Эти классы представляют собой модель данных для подрядчиков, продавцов и сотрудников. Класс Contractor имеет свойства id, type и name, а также методы для получения полного имени и поиска по идентификатору.

- Класс `Status`:<br>
Этот класс содержит статические данные о статусах и метод для получения имени статуса по идентификатору.

- Класс `ReferencesOperation`:<br>
Абстрактный класс для операций, с методом `doOperation`, который должен быть реализован в подклассах. Также включает метод для получения данных запроса.

- Класс `NotificationEvents`:<br>
Содержит константы событий уведомлений.

- Класс `NotificationManager`:<br>
Содержит методы для отправки различных уведомлений/сообщений

- Класс `EmailHelper`:<br>
Сюда перенесены внеклассовые методы, которые служат для получения электронных почтовых адресов посредника и работников

- Основной класс `ReturnOperation`:<br>
    - используя метод `getRequest` абстрактного класса-родителя получает данные.
    - в случае, если данные пусты или каких-то данных не хватает - выбрасывает исключение.
    - готовит шаблон для возвращения ответа.
    - используя метод `Contractor::getById` и id полученные ранее, получает информацию по посреднику и заказчику, изготовителю и эксперту.
    - используя метод `__` формирует сообщение об изменениях в процессе на необходимом языке.
    - все полученные в предыдущих шагах данные используются для формирования шаблона данных. Если хоть одна переменная в шаблоне не задана, выбрасывается исключение.
    - получает почтовый адрес с которого будет отослано письмо и адреса сотрудников, которым будет отослано письмо.
    - используя метод `EmailHelper::sendMessage` отправляет письмо каждому сотруднику. Обновляет результат для ответа.
    - если статус был изменен, то шлет письмо так же клиенту. Обновляет результат для ответа.
    - если у клиента есть еще и телефон, то отправляет еще и туда. Если отправить не удалось, возвращает информацию об ошибке.
    - возвращает результат.

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
- Реализован класс `NotificationManager` и его метод `send`.


### Test Assignment for PHP Developer
We expect you to:
* find and fix all possible errors (syntax, design, security, etc.);
* refactor the code of the ReturnOperation.php file into the best form in your opinion;
* write a brief summary in the comments about the code: its purpose and quality.

### Code Purpose
The main class and its helper classes collectively handle requests, validate data, and send notifications via email and SMS.<br><br>
Specifically:

- Contractor Class and its inheritors (Seller, Employee):<br>
These classes represent data models for contractors, sellers, and employees. The Contractor class has properties id, type, and name, as well as methods for getting the full name and searching by ID.

- Status Class:<br>
This class contains static data about statuses and a method to get the name of a status by its ID.

- ReferencesOperation Class:<br>
An abstract class for operations with a doOperation method that must be implemented in subclasses. It also includes a method for retrieving request data.

- NotificationEvents Class:<br>
Contains constants for notification events.

- NotificationManager Class:<br>
Contains methods for sending various notifications/messages.

- EmailHelper Class:<br>
Non-class methods that were previously used for retrieving intermediary and employee email addresses have been moved here.

- Main ReturnOperation Class:<br>

  - Uses the getRequest method of the abstract parent class to retrieve data.
  - Throws an exception if the data is empty or incomplete.
  - Prepares a template for the response.
  - Uses the Contractor::getById method and previously obtained IDs to get information about the intermediary, customer, creator, and expert.
  - Uses the __ method to generate a message about process changes in the required language.
  - All data obtained in previous steps is used to form the data template. If any variable in the template is not set, an exception is thrown.
  - Retrieves the email address from which the email will be sent and the addresses of the employees to whom the email will be sent.
  - Uses the EmailHelper::sendMessage method to send an email to each employee. Updates the result for the response.
  - If the status was changed, also sends an email to the client. Updates the result for the response.
  - If the client also has a phone number, sends an SMS as well. If sending fails, returns error information.
  - Returns the result.

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
- Implemented the `NotificationManager` class and its `send` method.
