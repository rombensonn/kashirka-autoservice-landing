<?php
declare(strict_types=1);

session_start();

function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function canonical_url(): string
{
    $publicUrl = trim((string) (getenv('PUBLIC_URL') ?: ''));
    if ($publicUrl !== '') {
        return rtrim($publicUrl, '/') . '/';
    }

    $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (isset($_SERVER['SERVER_PORT']) && (int) $_SERVER['SERVER_PORT'] === 443);
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

    return ($isHttps ? 'https://' : 'http://') . $host . $path;
}

$business = [
    'name' => 'Каширка',
    'subtitle' => 'Автосервис в Домодедово',
    'rating' => '5,0',
    'ratingValue' => '5.0',
    'ratingCount' => 255,
    'reviewCount' => 118,
    'phone' => '+7 (999) 997-30-00',
    'phoneHref' => '+79999973000',
    'address' => 'ул. Каширское Шоссе, 1, микрорайон Северный, Домодедово',
    'hours' => 'Ежедневно 09:00-20:00',
    'mapUrl' => 'https://yandex.ru/maps/-/CPXumU-y',
];

$serviceGroups = [
    [
        'title' => 'ТО и регулярное обслуживание',
        'summary' => 'Работы, с которых чаще всего начинают: быстро проверить состояние машины, заменить расходники и понять ближайшие рекомендации.',
        'items' => ['Замена масла', 'Фильтры', 'Полное сервисное обслуживание', 'Предрейсовый техосмотр', 'Базовое сервисное обслуживание'],
    ],
    [
        'title' => 'Диагностика и автоэлектрика',
        'summary' => 'Для случаев, когда есть ошибка, машина не заводится, пропадает зарядка, не работает оборудование или нужен точный поиск причины.',
        'items' => ['Компьютерная диагностика', 'Ремонт автоэлектрики', 'Ремонт автоэлектроники', 'Ремонт стартеров', 'Ремонт генераторов', 'Установка парктроника', 'Сигнализация'],
    ],
    [
        'title' => 'Ходовая, рулевое и тормоза',
        'summary' => 'Если появились стуки, вибрации, увод в сторону, скрипы, люфт руля или увеличился тормозной путь.',
        'items' => ['Ремонт ходовой части', 'Ремонт тормозной системы', 'Ремонт рулевых реек', 'Ремонт амортизаторов', 'Развал-схождение', 'Восстановление рычагов'],
    ],
    [
        'title' => 'Двигатель и трансмиссия',
        'summary' => 'Работы по узлам, где особенно важны диагностика, согласование списка деталей и понятная последовательность ремонта.',
        'items' => ['Ремонт двигателя', 'Ремонт ГБЦ', 'Замена ГРМ', 'Ремонт сцепления', 'Ремонт КПП', 'Ремонт АКПП', 'Ремонт DSG', 'Ремонт РКПП'],
    ],
    [
        'title' => 'Топливная система и форсунки',
        'summary' => 'Подходит при нестабильном запуске, провалах, повышенном расходе, ошибках по смеси или проблемах с подачей топлива.',
        'items' => ['Ремонт топливной системы', 'Ремонт форсунок', 'Чистка форсунок', 'Промывка инжектора', 'Ремонт карбюраторов'],
    ],
    [
        'title' => 'Кузов, выхлоп и сварка',
        'summary' => 'Работы по кузову, выпускной системе и защите автомобиля от коррозии.',
        'items' => ['Кузовной ремонт', 'Ремонт выхлопной системы', 'Сварочные работы', 'Антикор', 'Удаление катализаторов', 'Ремонт прицепов'],
    ],
];

$trustPoints = [
    [
        'title' => 'Страх переплаты',
        'answer' => 'Дополнительные работы согласуются до начала. В отзывах клиенты отдельно отмечают, что лишнее не навязывают.',
    ],
    [
        'title' => 'Непонятная цена',
        'answer' => 'Сначала описываете проблему и проходите диагностику. После этого согласуются работы, детали и ориентир по стоимости.',
    ],
    [
        'title' => 'Недоверие к качеству',
        'answer' => 'У сервиса рейтинг 5,0 на Яндекс.Картах, 255 оценок и 118 отзывов. В карточке указана гарантия.',
    ],
    [
        'title' => 'Нет времени искать детали',
        'answer' => 'Можно приехать со своими запчастями или заказать нужные после согласования.',
    ],
];

$processSteps = [
    ['title' => 'Звонок или заявка', 'text' => 'Коротко описываете автомобиль, симптом и удобное время. Для срочных случаев быстрее звонить.'],
    ['title' => 'Приемка и диагностика', 'text' => 'Мастер уточняет жалобы, проверяет машину и фиксирует, что нужно сделать сейчас, а что можно оставить в рекомендациях.'],
    ['title' => 'Согласование', 'text' => 'До ремонта обсуждаются работы, запчасти, срок и стоимость. Свои детали подходят, заказ деталей тоже возможен.'],
    ['title' => 'Ремонт и выдача', 'text' => 'После работ вы забираете автомобиль, получаете пояснения по выполненному ремонту и дальнейшим рекомендациям.'],
];

$reviews = [
    [
        'name' => 'Геннадий',
        'date' => '26 января 2025',
        'tag' => 'Без навязывания',
        'text' => '«Без согласования никаких допработ не производят». Клиент также отметил, что спрашивают о замечаниях по автомобилю.',
    ],
    [
        'name' => 'Анна Машкова',
        'date' => '5 апреля 2025',
        'tag' => 'ТО и подвеска',
        'text' => '«Ничего не навязывали, говорили по делу». Отдельно отмечены запчасти, зона ожидания и кофе.',
    ],
    [
        'name' => 'Joseppe',
        'date' => '8 апреля 2025',
        'tag' => 'Подвеска и колодки',
        'text' => 'Клиент пишет, что подвеску и колодки сделали быстро и качественно, а цены назвал демократичными.',
    ],
    [
        'name' => 'Андрей Лаврентьев',
        'date' => '25 апреля 2025',
        'tag' => 'Срочный ремонт',
        'text' => 'Отметил, что приняли без очереди после поломки на трассе и оперативно помогли продолжить поездку.',
    ],
    [
        'name' => 'Петр Васечкин',
        'date' => '5 марта 2024',
        'tag' => 'Парковка и сроки',
        'text' => 'Упоминает большую парковку, вежливый персонал и ситуацию, когда машину отдали после закрытия.',
    ],
    [
        'name' => 'Константин Несмеянов',
        'date' => '28 декабря 2023',
        'tag' => 'Диагностика',
        'text' => 'Пишет про полный спектр диагностики и ремонта, а также помощь с подбором и покупкой запчастей.',
    ],
];

$faq = [
    [
        'question' => 'Можно ли приехать со своими запчастями?',
        'answer' => 'Да. По отзывам и данным карточки, сервис может работать с вашими запчастями. Если деталей нет, их могут подобрать и заказать после согласования.',
    ],
    [
        'question' => 'Делают ли дополнительные работы без звонка клиенту?',
        'answer' => 'Ключевой тезис из отзывов: дополнительные работы не делают без согласования. На приемке лучше сразу попросить озвучивать все новые работы до ремонта.',
    ],
    [
        'question' => 'Можно ли узнать цену по телефону?',
        'answer' => 'По телефону можно получить ориентир, если вы опишете марку, модель, год, симптом и желаемую услугу. Точная стоимость зависит от диагностики, деталей и состояния узла.',
    ],
    [
        'question' => 'Нужна ли предварительная запись?',
        'answer' => 'Да, в карточке указана предварительная запись. Это особенно важно для диагностики, автоэлектрики, ремонта ходовой и работ с заказом запчастей.',
    ],
    [
        'question' => 'Есть ли где подождать машину?',
        'answer' => 'В карточке указаны Wi-Fi, парковка и оплата картой. В отзывах клиенты также упоминают зону ожидания и кофе.',
    ],
    [
        'question' => 'Есть ли гарантия?',
        'answer' => 'В карточке бизнеса указана гарантия. Условия гарантии лучше уточнить при записи и зафиксировать в заказ-наряде.',
    ],
];

$brands = ['ВАЗ', 'Kia', 'Hyundai', 'Toyota', 'Volkswagen', 'Volvo', 'BMW', 'Audi', 'Mercedes-Benz', 'Ford', 'Chevrolet', 'Renault', 'Nissan', 'Mitsubishi', 'Mazda', 'Opel', 'Peugeot', 'Skoda', 'Subaru', 'Suzuki', 'Lexus', 'Honda', 'Citroen', 'Daewoo', 'SsangYong', 'Genesis', 'китайские', 'корейские', 'японские', 'европейские', 'отечественные', 'коммерческие'];

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(24));
}

$formErrors = [];
$old = [
    'name' => '',
    'phone' => '',
    'car' => '',
    'service' => '',
    'message' => '',
];

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $old['name'] = trim((string) ($_POST['name'] ?? ''));
    $old['phone'] = trim((string) ($_POST['phone'] ?? ''));
    $old['car'] = trim((string) ($_POST['car'] ?? ''));
    $old['service'] = trim((string) ($_POST['service'] ?? ''));
    $old['message'] = trim((string) ($_POST['message'] ?? ''));
    $token = (string) ($_POST['csrf_token'] ?? '');
    $honeypot = trim((string) ($_POST['website'] ?? ''));

    if (!hash_equals($_SESSION['csrf_token'], $token)) {
        $formErrors['form'] = 'Форма устарела. Обновите страницу и отправьте заявку еще раз.';
    }

    if ($honeypot !== '') {
        $formErrors['form'] = 'Заявка не отправлена. Попробуйте еще раз.';
    }

    if (mb_strlen($old['name']) < 2) {
        $formErrors['name'] = 'Укажите имя, чтобы мастер понимал, как к вам обратиться.';
    }

    $phoneDigits = preg_replace('/\D+/', '', $old['phone']);
    if ($phoneDigits === null || strlen($phoneDigits) < 10) {
        $formErrors['phone'] = 'Укажите телефон в формате +7 или 8, чтобы сервис мог перезвонить.';
    }

    if (!isset($_POST['consent'])) {
        $formErrors['consent'] = 'Подтвердите согласие на обработку данных для обратного звонка.';
    }

    if ($formErrors === []) {
        $dataDir = __DIR__ . DIRECTORY_SEPARATOR . 'data';
        if (!is_dir($dataDir)) {
            mkdir($dataDir, 0775, true);
        }

        $leadFile = $dataDir . DIRECTORY_SEPARATOR . 'leads.csv';
        $isNewFile = !file_exists($leadFile);
        $handle = fopen($leadFile, 'ab');

        if ($handle !== false) {
            if ($isNewFile) {
                fputcsv($handle, ['created_at', 'name', 'phone', 'car', 'service', 'message'], ';');
            }

            fputcsv($handle, [
                date('c'),
                $old['name'],
                $old['phone'],
                $old['car'],
                $old['service'],
                $old['message'],
            ], ';');

            fclose($handle);
        }

        $leadEmail = getenv('LEAD_EMAIL') ?: '';
        if (filter_var($leadEmail, FILTER_VALIDATE_EMAIL)) {
            $subject = 'Новая заявка с лендинга Каширка';
            $body = implode("\n", [
                'Имя: ' . $old['name'],
                'Телефон: ' . $old['phone'],
                'Автомобиль: ' . ($old['car'] !== '' ? $old['car'] : 'не указан'),
                'Услуга: ' . ($old['service'] !== '' ? $old['service'] : 'не выбрана'),
                'Сообщение: ' . ($old['message'] !== '' ? $old['message'] : 'нет'),
            ]);
            @mail($leadEmail, $subject, $body, 'Content-Type: text/plain; charset=UTF-8');
        }

        $_SESSION['csrf_token'] = bin2hex(random_bytes(24));
        $_SESSION['flash'] = 'Заявка отправлена. Данные сохранены, сервис сможет связаться с вами для уточнения записи.';

        $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
        header('Location: ' . $path . '?sent=1#lead-form');
        exit;
    }
}

$flash = (string) ($_SESSION['flash'] ?? '');
unset($_SESSION['flash']);

$canonical = canonical_url();
$schema = [
    '@context' => 'https://schema.org',
    '@type' => 'AutoRepair',
    '@id' => $canonical . '#autoservice',
    'name' => $business['name'],
    'description' => 'Автосервис Каширка в Домодедово: ТО, диагностика, автоэлектрика, ремонт ходовой, двигателя, КПП, АКПП, кузовные и сварочные работы.',
    'url' => $canonical,
    'telephone' => $business['phone'],
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => 'ул. Каширское Шоссе, 1, микрорайон Северный',
        'addressLocality' => 'Домодедово',
        'addressCountry' => 'RU',
    ],
    'openingHoursSpecification' => array_map(
        static fn (string $day): array => [
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => $day,
            'opens' => '09:00',
            'closes' => '20:00',
        ],
        ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']
    ),
    'aggregateRating' => [
        '@type' => 'AggregateRating',
        'ratingValue' => $business['ratingValue'],
        'bestRating' => '5',
        'ratingCount' => $business['ratingCount'],
        'reviewCount' => $business['reviewCount'],
    ],
    'paymentAccepted' => 'Cash, Credit Card',
    'priceRange' => '₽₽',
    'sameAs' => [$business['mapUrl']],
    'hasOfferCatalog' => [
        '@type' => 'OfferCatalog',
        'name' => 'Услуги автосервиса Каширка',
        'itemListElement' => array_map(
            static fn (array $group): array => [
                '@type' => 'OfferCatalog',
                'name' => $group['title'],
                'itemListElement' => array_map(
                    static fn (string $item): array => [
                        '@type' => 'Offer',
                        'itemOffered' => [
                            '@type' => 'Service',
                            'name' => $item,
                        ],
                    ],
                    $group['items']
                ),
            ],
            $serviceGroups
        ),
    ],
];
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Каширка автосервис в Домодедово — ремонт авто, диагностика и ТО</title>
    <meta name="description" content="Автосервис Каширка в Домодедово: рейтинг 5,0, 255 оценок. ТО, диагностика, автоэлектрика, ходовая, двигатель, КПП, АКПП, кузов, сварка. Запись по телефону +7 (999) 997-30-00.">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?= h($canonical) ?>">
    <meta property="og:type" content="business.business">
    <meta property="og:title" content="Каширка — автосервис в Домодедово">
    <meta property="og:description" content="Ремонт и диагностика авто с согласованием работ до начала ремонта. Ежедневно 09:00-20:00.">
    <meta property="og:url" content="<?= h($canonical) ?>">
    <meta name="theme-color" content="#11161c">
    <link rel="preload" as="image" href="assets/images/kashirka-hero-industrial.jpg">
    <link rel="stylesheet" href="assets/styles.css">
    <script type="application/ld+json"><?= json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?></script>
</head>
<body>
<a class="skip-link" href="#main">К содержанию</a>

<header class="site-header" id="top">
    <div class="container header-inner">
        <a class="brand" href="#top" aria-label="Каширка, автосервис в Домодедово">
            <span class="brand-mark" aria-hidden="true">К</span>
            <span>
                <strong><?= h($business['name']) ?></strong>
                <small><?= h($business['subtitle']) ?></small>
            </span>
        </a>
        <nav class="nav" aria-label="Основная навигация">
            <a href="#services">Услуги</a>
            <a href="#process">Как проходит ремонт</a>
            <a href="#reviews">Отзывы</a>
            <a href="#contacts">Контакты</a>
        </nav>
        <div class="header-actions">
            <a class="phone-link" href="tel:<?= h($business['phoneHref']) ?>" aria-label="Позвонить в автосервис Каширка">
                <svg aria-hidden="true" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.4 19.4 0 0 1-6-6A19.8 19.8 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.9.32 1.77.6 2.61a2 2 0 0 1-.45 2.11L8 9.69a16 16 0 0 0 6.31 6.31l1.25-1.25a2 2 0 0 1 2.11-.45c.84.28 1.71.48 2.61.6A2 2 0 0 1 22 16.92Z"/></svg>
                <span><?= h($business['phone']) ?></span>
            </a>
            <a class="button button-primary" href="#lead-form">Записаться</a>
        </div>
    </div>
</header>

<main id="main">
    <section class="hero" aria-labelledby="hero-title">
        <img class="hero-bg" src="assets/images/kashirka-hero-industrial.jpg" alt="" width="1920" height="820" fetchpriority="high">
        <div class="container hero-grid">
            <div class="hero-copy">
                <p class="eyebrow">Домодедово • <?= h($business['hours']) ?></p>
                <h1 id="hero-title">Каширка — автосервис, где ремонт согласуют до начала работ</h1>
                <p class="hero-lead">ТО, диагностика, автоэлектрика, ходовая, двигатель, КПП, АКПП, кузовные и сварочные работы. Можно приехать со своими запчастями или заказать детали после согласования.</p>
                <div class="hero-actions">
                    <a class="button button-primary button-large" href="tel:<?= h($business['phoneHref']) ?>">
                        <svg aria-hidden="true" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.4 19.4 0 0 1-6-6A19.8 19.8 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.9.32 1.77.6 2.61a2 2 0 0 1-.45 2.11L8 9.69a16 16 0 0 0 6.31 6.31l1.25-1.25a2 2 0 0 1 2.11-.45c.84.28 1.71.48 2.61.6A2 2 0 0 1 22 16.92Z"/></svg>
                        Позвонить
                    </a>
                    <a class="button button-secondary button-large" href="#lead-form">
                        <svg aria-hidden="true" viewBox="0 0 24 24"><path d="M8 2v4M16 2v4M3 10h18M5 4h14a2 2 0 0 1 2 2v13a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Z"/></svg>
                        Оставить заявку
                    </a>
                    <a class="button button-ghost button-large" href="<?= h($business['mapUrl']) ?>" target="_blank" rel="noopener">
                        <svg aria-hidden="true" viewBox="0 0 24 24"><path d="M12 21s7-5.1 7-11a7 7 0 1 0-14 0c0 5.9 7 11 7 11Z"/><circle cx="12" cy="10" r="2.5"/></svg>
                        Маршрут
                    </a>
                </div>
                <dl class="hero-facts" aria-label="Ключевые факты">
                    <div>
                        <dt><?= h($business['rating']) ?></dt>
                        <dd>рейтинг на Яндекс.Картах</dd>
                    </div>
                    <div>
                        <dt><?= h((string) $business['ratingCount']) ?></dt>
                        <dd>оценок</dd>
                    </div>
                    <div>
                        <dt><?= h((string) $business['reviewCount']) ?></dt>
                        <dd>отзывов</dd>
                    </div>
                    <div>
                        <dt>7 дней</dt>
                        <dd>работают без выходных</dd>
                    </div>
                </dl>
            </div>

            <aside class="hero-panel" aria-labelledby="fast-record-title">
                <div class="panel-content">
                    <div class="panel-kicker">
                        <span class="status-dot" aria-hidden="true"></span>
                        Приемка 09:00-20:00
                    </div>
                    <h2 id="fast-record-title">Запись без лишних кругов</h2>
                    <p class="panel-lead">Мастер быстрее сориентируется, если сразу назвать 4 вещи.</p>
                    <ul class="check-list">
                        <li>Марка, модель и год автомобиля</li>
                        <li>Симптом: звук, ошибка, течь, вибрация или нужная услуга</li>
                        <li>Есть ли свои запчасти или нужен подбор</li>
                        <li>Когда удобно приехать на приемку</li>
                    </ul>
                    <div class="work-order">
                        <span>Ключевое правило</span>
                        <strong>Допработы только после согласования</strong>
                    </div>
                </div>
            </aside>
        </div>
    </section>

    <section class="proof-strip" aria-label="Условия сервиса">
        <div class="container proof-strip-inner">
            <span>Оплата картой и наличными</span>
            <span>Парковка</span>
            <span>Wi-Fi</span>
            <span>Предварительная запись</span>
            <span>Гарантия указана в карточке</span>
        </div>
    </section>

    <section class="section" id="trust" aria-labelledby="trust-title">
        <div class="container trust-layout">
            <div class="trust-copy">
                <div class="section-heading">
                    <p class="eyebrow">Контроль до ремонта</p>
                    <h2 id="trust-title">Сначала диагностика и согласование. Потом работа.</h2>
                    <p>Визуальный акцент здесь не на обещании «дёшево», а на понятном процессе: проблему проверяют, список работ обсуждают, запчасти согласуют, лишнее не добавляют без звонка.</p>
                </div>
                <div class="objection-grid">
                    <?php foreach ($trustPoints as $point): ?>
                        <article class="info-card">
                            <h3><?= h($point['title']) ?></h3>
                            <p><?= h($point['answer']) ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
            <figure class="industrial-photo diagnostics-photo">
                <img src="assets/images/kashirka-diagnostics.jpg" alt="Диагностика автомобиля в индустриальном автосервисе" width="1536" height="1024">
                <figcaption>
                    <span>Диагностика</span>
                    <strong>Причина неисправности важнее догадок</strong>
                </figcaption>
            </figure>
        </div>
    </section>

    <section class="section section-muted" id="process" aria-labelledby="process-title">
        <div class="container">
            <div class="section-heading compact">
                <p class="eyebrow">Порядок работ</p>
                <h2 id="process-title">Как проходит ремонт без лишней неопределенности</h2>
            </div>
            <div class="process-grid">
                <?php foreach ($processSteps as $index => $step): ?>
                    <article class="process-step">
                        <span class="step-number"><?= h((string) ($index + 1)) ?></span>
                        <h3><?= h($step['title']) ?></h3>
                        <p><?= h($step['text']) ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section" id="services" aria-labelledby="services-title">
        <div class="container">
            <div class="section-heading">
                <p class="eyebrow">Услуги</p>
                <h2 id="services-title">Не общий список, а понятные группы работ</h2>
                <p>Выберите блок по симптомам автомобиля. Если не уверены, опишите проблему в заявке или позвоните мастеру.</p>
            </div>
            <div class="services-grid">
                <?php foreach ($serviceGroups as $group): ?>
                    <article class="service-card">
                        <h3><?= h($group['title']) ?></h3>
                        <p><?= h($group['summary']) ?></p>
                        <ul class="tag-list" aria-label="<?= h($group['title']) ?>">
                            <?php foreach ($group['items'] as $item): ?>
                                <li><?= h($item) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section section-split" aria-labelledby="parts-title">
        <div class="container split-grid">
            <div>
                <p class="eyebrow">Запчасти и сроки</p>
                <h2 id="parts-title">Можно со своими деталями или с подбором через сервис</h2>
                <p>Это важный сценарий для клиентов, которые не хотят переплачивать или уже купили запчасти. Если деталей нет, сервис может помочь с заказом после согласования.</p>
                <div class="note-box">
                    <strong>Важно:</strong> срок ремонта зависит от диагностики, наличия деталей и загрузки боксов. Для точного времени лучше записаться заранее и описать проблему по телефону.
                </div>
            </div>
            <div class="parts-stack">
                <figure class="industrial-photo parts-photo">
                    <img src="assets/images/kashirka-parts-approval.jpg" alt="Запчасти и заказ-наряд перед согласованием ремонта" width="1536" height="1024">
                    <figcaption>
                        <span>Запчасти</span>
                        <strong>Свои или под заказ после согласования</strong>
                    </figcaption>
                </figure>
                <div class="mini-checks" aria-label="Что уточнить перед визитом">
                    <div>
                        <span class="check-icon" aria-hidden="true"></span>
                        <p>Нужна ли диагностика до заказа запчастей</p>
                    </div>
                    <div>
                        <span class="check-icon" aria-hidden="true"></span>
                        <p>Какие детали вы привозите сами</p>
                    </div>
                    <div>
                        <span class="check-icon" aria-hidden="true"></span>
                        <p>Какие работы нужно согласовывать отдельно</p>
                    </div>
                    <div>
                        <span class="check-icon" aria-hidden="true"></span>
                        <p>Как фиксируются рекомендации после ремонта</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" aria-labelledby="brands-title">
        <div class="container">
            <div class="section-heading compact">
                <p class="eyebrow">Автомобили</p>
                <h2 id="brands-title">Работают с популярными марками и типами авто</h2>
            </div>
            <ul class="brand-list" aria-label="Марки автомобилей">
                <?php foreach ($brands as $brand): ?>
                    <li><?= h($brand) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <section class="section section-muted" id="reviews" aria-labelledby="reviews-title">
        <div class="container">
            <div class="reviews-top">
                <div class="section-heading compact">
                    <p class="eyebrow">Отзывы</p>
                    <h2 id="reviews-title">Что чаще всего отмечают клиенты</h2>
                </div>
                <div class="rating-card" aria-label="Рейтинг на Яндекс.Картах">
                    <strong><?= h($business['rating']) ?></strong>
                    <span><?= h((string) $business['ratingCount']) ?> оценок • <?= h((string) $business['reviewCount']) ?> отзывов</span>
                    <a href="<?= h($business['mapUrl']) ?>" target="_blank" rel="noopener">Открыть карточку</a>
                </div>
            </div>
            <div class="reviews-grid">
                <?php foreach ($reviews as $review): ?>
                    <article class="review-card">
                        <div class="review-meta">
                            <strong><?= h($review['name']) ?></strong>
                            <span><?= h($review['date']) ?></span>
                        </div>
                        <span class="review-tag"><?= h($review['tag']) ?></span>
                        <p><?= h($review['text']) ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section" id="faq" aria-labelledby="faq-title">
        <div class="container faq-grid">
            <div class="section-heading compact">
                <p class="eyebrow">FAQ</p>
                <h2 id="faq-title">Короткие ответы перед записью</h2>
                <p>Эти вопросы снимают основную неопределенность до звонка или визита.</p>
            </div>
            <div class="faq-list">
                <?php foreach ($faq as $item): ?>
                    <details>
                        <summary><?= h($item['question']) ?></summary>
                        <p><?= h($item['answer']) ?></p>
                    </details>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section section-contact" id="contacts" aria-labelledby="contacts-title">
        <div class="container contact-grid">
            <div class="contact-copy">
                <p class="eyebrow">Запись и контакты</p>
                <h2 id="contacts-title">Позвоните или оставьте заявку на удобное время</h2>
                <p>Для срочной поломки лучше звонить. Для планового ТО, диагностики или ремонта можно оставить заявку, и сервис уточнит детали.</p>

                <div class="contact-list">
                    <a href="tel:<?= h($business['phoneHref']) ?>">
                        <svg aria-hidden="true" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.4 19.4 0 0 1-6-6A19.8 19.8 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.9.32 1.77.6 2.61a2 2 0 0 1-.45 2.11L8 9.69a16 16 0 0 0 6.31 6.31l1.25-1.25a2 2 0 0 1 2.11-.45c.84.28 1.71.48 2.61.6A2 2 0 0 1 22 16.92Z"/></svg>
                        <span><?= h($business['phone']) ?></span>
                    </a>
                    <a href="<?= h($business['mapUrl']) ?>" target="_blank" rel="noopener">
                        <svg aria-hidden="true" viewBox="0 0 24 24"><path d="M12 21s7-5.1 7-11a7 7 0 1 0-14 0c0 5.9 7 11 7 11Z"/><circle cx="12" cy="10" r="2.5"/></svg>
                        <span><?= h($business['address']) ?></span>
                    </a>
                    <p>
                        <svg aria-hidden="true" viewBox="0 0 24 24"><path d="M12 6v6l4 2M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                        <span><?= h($business['hours']) ?></span>
                    </p>
                </div>

                <div class="access-note">
                    <strong>Доступность:</strong> в карточке указана парковка для людей с инвалидностью; вход на инвалидной коляске отмечен как недоступный.
                </div>
            </div>

            <form class="lead-form" id="lead-form" method="post" action="#lead-form" novalidate>
                <input type="hidden" name="csrf_token" value="<?= h($_SESSION['csrf_token']) ?>">
                <div class="hidden-field" aria-hidden="true">
                    <label for="website">Сайт</label>
                    <input id="website" type="text" name="website" tabindex="-1" autocomplete="off">
                </div>

                <div class="form-head">
                    <h3>Заявка на запись</h3>
                    <p>Ответьте на несколько вопросов, чтобы мастер быстрее сориентировался.</p>
                </div>

                <?php if ($flash !== ''): ?>
                    <div class="form-alert success" role="status"><?= h($flash) ?></div>
                <?php endif; ?>

                <?php if (isset($formErrors['form'])): ?>
                    <div class="form-alert error" role="alert"><?= h($formErrors['form']) ?></div>
                <?php endif; ?>

                <div class="field">
                    <label for="name">Имя</label>
                    <input id="name" name="name" type="text" autocomplete="name" value="<?= h($old['name']) ?>" required>
                    <?php if (isset($formErrors['name'])): ?><span class="field-error"><?= h($formErrors['name']) ?></span><?php endif; ?>
                </div>

                <div class="field">
                    <label for="phone">Телефон</label>
                    <input id="phone" name="phone" type="tel" autocomplete="tel" placeholder="+7 (___) ___-__-__" value="<?= h($old['phone']) ?>" required>
                    <?php if (isset($formErrors['phone'])): ?><span class="field-error"><?= h($formErrors['phone']) ?></span><?php endif; ?>
                </div>

                <div class="field">
                    <label for="car">Автомобиль</label>
                    <input id="car" name="car" type="text" placeholder="Например: Kia Rio 2018" value="<?= h($old['car']) ?>">
                </div>

                <div class="field">
                    <label for="service">Что нужно сделать</label>
                    <select id="service" name="service">
                        <option value="">Выберите услугу, если знаете</option>
                        <?php foreach ($serviceGroups as $group): ?>
                            <option value="<?= h($group['title']) ?>" <?= $old['service'] === $group['title'] ? 'selected' : '' ?>><?= h($group['title']) ?></option>
                        <?php endforeach; ?>
                        <option value="Не знаю, нужна диагностика" <?= $old['service'] === 'Не знаю, нужна диагностика' ? 'selected' : '' ?>>Не знаю, нужна диагностика</option>
                    </select>
                </div>

                <div class="field">
                    <label for="message">Коротко опишите проблему</label>
                    <textarea id="message" name="message" rows="4" placeholder="Например: стук спереди справа, нужен осмотр подвески"><?= h($old['message']) ?></textarea>
                </div>

                <label class="consent">
                    <input type="checkbox" name="consent" value="1" required>
                    <span>Согласен на обработку данных для обратного звонка по заявке.</span>
                </label>
                <?php if (isset($formErrors['consent'])): ?><span class="field-error consent-error"><?= h($formErrors['consent']) ?></span><?php endif; ?>

                <button class="button button-primary button-large form-submit" type="submit">
                    <svg aria-hidden="true" viewBox="0 0 24 24"><path d="M22 2 11 13"/><path d="m22 2-7 20-4-9-9-4 20-7Z"/></svg>
                    Отправить заявку
                </button>
                <p class="form-note">Заявки сохраняются на сервере в PHP-файл данных. Для мгновенной записи звоните: <a href="tel:<?= h($business['phoneHref']) ?>"><?= h($business['phone']) ?></a>.</p>
            </form>
        </div>
    </section>
</main>

<footer class="site-footer">
    <div class="container footer-inner">
        <p>© <?= date('Y') ?> <?= h($business['name']) ?>. Данные основаны на карточке бизнеса в Яндекс.Картах.</p>
        <a href="<?= h($business['mapUrl']) ?>" target="_blank" rel="noopener">Открыть карточку на Яндекс.Картах</a>
    </div>
</footer>

<div class="mobile-cta" aria-label="Быстрые действия">
    <a href="tel:<?= h($business['phoneHref']) ?>">
        <svg aria-hidden="true" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.4 19.4 0 0 1-6-6A19.8 19.8 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.9.32 1.77.6 2.61a2 2 0 0 1-.45 2.11L8 9.69a16 16 0 0 0 6.31 6.31l1.25-1.25a2 2 0 0 1 2.11-.45c.84.28 1.71.48 2.61.6A2 2 0 0 1 22 16.92Z"/></svg>
        Звонок
    </a>
    <a href="#lead-form">
        <svg aria-hidden="true" viewBox="0 0 24 24"><path d="M8 2v4M16 2v4M3 10h18M5 4h14a2 2 0 0 1 2 2v13a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Z"/></svg>
        Запись
    </a>
    <a href="<?= h($business['mapUrl']) ?>" target="_blank" rel="noopener">
        <svg aria-hidden="true" viewBox="0 0 24 24"><path d="M12 21s7-5.1 7-11a7 7 0 1 0-14 0c0 5.9 7 11 7 11Z"/><circle cx="12" cy="10" r="2.5"/></svg>
        Маршрут
    </a>
</div>
</body>
</html>
