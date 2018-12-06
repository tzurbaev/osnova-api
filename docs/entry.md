# Запись

[< К ленте записей](timeline.md) | [< К оглавлению](readme.md)

- [Доступные методы](#available-methods)
    - [Геттеры](#getters)
    - [Работа с API](#api-methods)
        - [Список популярных записей для текущей записи](#api-popular-entries)
        - [Список комментариев](#api-comments-list)

[Сервисная сущность](entities.md) **"Запись"** хранит в себе данные и 
предоставляет функциональность для работы с записями из подсайтов.

## Доступные методы {#available-methods}

### Геттеры {#getters}

| Метод                   | Возвращаемый тип  | Описание                                               |
|-------------------------|-------------------|--------------------------------------------------------|
| getId                   | integer           | Возвращает ID записи                                   |
| getAuthor               | Author            | Возвращает объект автора записи                        |
| getSubsite              | Subsite           | Возвращает объект подсайта записи                      |
| getTitle                | string            | Возвращает заголовок записи                            |
| getIntro                | string            | Возвращает вводный текст записи                        |
| getIntroInFeed          | string            | Возвращает значение поля introInFeed                   |
| getCover                | CoverImage        | Возвращает объект обложки записи                       |
| getContent              | EntryContent      | Возвращает объект контента записи                      |
| getHitsCount            | integer           | Возвращает количество просмотров записи                |
| getCommentsCount        | integer           | Возвращает количество комментариев к записи            |
| getFavoritesCount       | integer           | Возвращает количество добавлений записи в избранное    |
| getLikesCount           | integer           | Возвращает количество лайков записи                    |
| getLikesSum             | integer           | Возвращает сумму лайков записи (?)                     |
| getBadges               | array             | Возвращает список бейджей записи                       |
| getDate                 | DateTimeImmutable | Возвращает дату публикации записи                      |
| getLastModificationDate | DateTimeImmutable | Возвращает дату последнего изменения записи            |
| likesEnabled            | boolean           | Определяет, включены ли лайки у записи                 |
| commentsEnabled         | boolean           | Определяет, включены ли комментарии у записи           |
| isLiked                 | boolean           | Определяет, лайкнул ли пользователь запись             |
| isFavorited             | boolean           | Определяет, добавил ли пользователь запись в избранное |
| isPinned                | boolean           | Определяет, является ли запись закреплённой            |
| isEditorial             | boolean           | Определяет, является ли запись редакционной            |
| getCommentatorsAvatars  | array             | Возвращает массив URL аватарок комментаторов           |
| getUrl                  | string            | Возвращает URL записи                                  |
| getWebviewUrl           | string            | Возвращает URL записи для WebView (приложение)         |
| getAudioUrl             | string            | Возвращает URL аудио-версии записи                     |

### Работа с API {#api-methods}

Кроме базовых геттеров класс предоставляет возможность работать с API записей.

> Внимание: работа с API доступна только в том случае, если объект записи
> был создан с передачей параметра `ApiProvider`!

> Всем объектам записей, созданным с помощью сервиса записей (`Timeline`),
> доступна такая возможность автоматически.

#### Список популярных записей для текущей записи {#api-popular-entries}

Метод `Entry::getPopularEntries()` позволяет получить список популярных записей
для текущей записи.

```php
<?php

use Osnova\Services\Timeline\Entry;

/** @var Entry $entry */
$popularEntries = $entry->getPopularEntries();
```

#### Список комментариев {#api-comments-list}

Метод `Entry::getComments()` позволяет получить список [комментариев](comment.md)
текущей записи.

```php
<?php

use Osnova\Services\Timeline\Entry;

/** @var Entry $entry */
$comments = $entry->getComments('recent');
```

[< К ленте записей](timeline.md) | [< К оглавлению](readme.md)
