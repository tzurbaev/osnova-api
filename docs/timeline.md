# Лента записей (Timeline)

[< К оглавлению](readme.md)

- [Использование](#usage)
    - [Параметры запроса](#request)
        - [Сортировка](#sorting)
        - [Пагинация](#pagination)
    - [Создание сервиса](#instantiation)
    - [Получение ленты записей из категории](#category-timeline)
    - [Получение ленты записей по хэштегу](#hashtag-timeline)
    - [Поиск записей](#entires-search)
    - [Получение ленты записей из подсайта](#subsite-timeline)
    - [Получение ленты новостей](#news-timeline)
    - [Получение записи по ID](#entry-by-id)
    - [Работа из экземпляра сайта](#resource-timeline-usage)
        - [Получение ленты записей из экземпляра сайта](#resource-timeline)
        - [Поиск записей](#resource-search)
        - [Получение ленты новостей из экземпляра сайта](#resource-news-timeline)
        - [Получение записи из экземпляра сайта](#entry-by-id-from-resource)

Сервис ленты записей предоставляет возможность получать записи как из категорий,
так и из подсайтов сайта.

## Использование {#usage}

Для получения записей необходимо использовать метод `Timeline::getTimleine`.
Этот метод принимает в себя экземпляр владельца ленты записей (`TimelineOwnerInterface`)
и экземпляр параметров запроса (`TimelineRequest`).

В случае успешного ответа, метод `Timeline::getTimeline` вернёт массив объектов
`Osnova\Services\Entries\Entry`. Подробная информация о том, что умеет делать
этот класс - [здесь](entry.md).

### Параметры запроса {#request}

Класс `TimelineRequest` позволяет указывать параметры запросов к API.

#### Сортировка {#sorting}
Если вам необходимо указать сортировку ленты записей, передайте тип сортировки
в качестве первого аргумента конструктора класса `TimelineRequest`.

```php
<?php

use Osnova\Services\Timeline\Enums\TimelineSorting;
use Osnova\Services\Timeline\Requests\TimelineRequest;

$request = new TimelineRequest(TimelineSorting::POPULAR);
```

#### Пагинация {#pagination}
Если вам необходимо указать количество возвращаемых записей и/или сдвиг,
передайте эти значения в качестве второго и/или третьего аргументов
конструктора класса `TimelineRequest`.

```php
<?php

use Osnova\Services\Timeline\Enums\TimelineSorting;
use Osnova\Services\Timeline\Requests\TimelineRequest;

$request = new TimelineRequest(TimelineSorting::POPULAR, 20, 1);
```

### Создание сервиса {#instantiation}

Как и все остальные [сервисы](services.md), лента записей требует передачи
экземпляра `ApiProvider`.

```php
<?php

use Osnova\Api\ApiProvider;
use Osnova\Services\Timeline\Timeline;

$timeline = new Timeline(new ApiProvider());
```

### Получение ленты записей из категории {#category-timeline}

```php
<?php

use Osnova\Api\ApiProvider;
use Osnova\Services\Timeline\Timeline;
use Osnova\Services\Timeline\Owners\TimelineCategory;
use Osnova\Services\Timeline\Requests\TimelineRequest;

$timeline = new Timeline(new ApiProvider());
$category = new TimelineCategory('mainpage');

$entries = $timeline->getTimeline($category, new TimelineRequest());
```

### Получение ленты записей по хэштегу {#hashtag-timeline}

```php
<?php

use Osnova\Api\ApiProvider;
use Osnova\Services\Timeline\Timeline;
use Osnova\Services\Timeline\Owners\TimelineHashtag;
use Osnova\Services\Timeline\Requests\TimelineRequest;

$timeline = new Timeline(new ApiProvider());
$hashtag = new TimelineHashtag('политика');

$entries = $timeline->getTimeline($hashtag, new TimelineRequest());
```

> Обратите внимание: класс `TimelineHashtag` реализует интерфейс `ModifiesTimelineRequestInterface`,
> который позволяет модифицировать переданный запрос до непосредственной
> его отправки в API.
>
> Это означает, что сервис будет использовать не оригинально переданный `TimelineRequest`,
> а модифицированный хэштегом `HashtagTimelineRequest`.

### Поиск записей {#entires-search}

```php
<?php

use Osnova\Api\ApiProvider;
use Osnova\Services\Timeline\Timeline;
use Osnova\Services\Timeline\Enums\TimelineSearchOrder;

$timeline = new Timeline(new ApiProvider());

$entries = $timeline->getTimelineSearchResults('навальный', TimelineSearchOrder::RELEVANT, 1);
```

### Получение ленты записей из подсайта {#subsite-timeline}

```php
<?php

use Osnova\Api\ApiProvider;
use Osnova\Services\Subsites\Subsite;
use Osnova\Services\Timeline\Timeline;
use Osnova\Services\Timeline\Requests\TimelineRequest;

$timeline = new Timeline(new ApiProvider());
$subsite = new Subsite(['id' => 1]);

$entries = $timeline->getTimeline($subsite, new TimelineRequest());
```

### Получение ленты новостей {#news-timeline}

```php
<?php

use Osnova\Api\ApiProvider;
use Osnova\Services\Timeline\Timeline;
use Osnova\Services\Timeline\Requests\TimelineRequest;

$timeline = new Timeline(new ApiProvider());

$entries = $timeline->getNewsTimeline(new TimelineRequest());
```

### Получение записи по ID {#entry-by-id}

```php
<?php

use Osnova\Api\ApiProvider;
use Osnova\Services\Timeline\Timeline;

$timeline = new Timeline(new ApiProvider());

$entry = $timeline->getTimelineEntry(81131);
```

### Работа из экземпляра сайта {#resource-timeline-usage}

Кроме использования ленты напрямую, вы можете вызывать её методы
непосредственно из экземпляра нужного сайта.

#### Получение ленты записей из экземпляра сайта {#resource-timeline}

```php
<?php

use Osnova\Api\ApiProvider;
use Osnova\Services\Timeline\Owners\TimelineCategory;
use Osnova\Services\Timeline\Requests\TimelineRequest;
use Osnova\TJournal;

$tj = new TJournal(new ApiProvider());

$category = new TimelineCategory('gamedev');
$request = new TimelineRequest();

$entries = $tj->getTimelineEntries($category, $request);
```

#### Поиск записей {#resource-search}

```php
<?php

use Osnova\Api\ApiProvider;
use Osnova\TJournal;

$tj = new TJournal(new ApiProvider());

$entries = $tj->getTimelineSearchResults('навальный', 'relevant', 1);
```

#### Получение ленты новостей из экземпляра сайта {#resource-news-timeline}

```php
<?php

use Osnova\Api\ApiProvider;
use Osnova\Services\Timeline\Requests\TimelineRequest;
use Osnova\TJournal;

$tj = new TJournal(new ApiProvider());

$entries = $tj->getNewsTimeline(new TimelineRequest());
```

#### Получение записи из экземпляра сайта {#entry-by-id-from-resource}

```php
<?php

use Osnova\Api\ApiProvider;
use Osnova\TJournal;

$tj = new TJournal(new ApiProvider());

$entry = $tj->getTimelineEntry(81131);
```

[< К оглавлению](readme.md)
