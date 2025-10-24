<?php
// config
define('SITE_NAME', 'Красоты Иркутска');
define('SITE_DESCRIPTION', 'Откройте для себя удивительную природу и архитектуру Иркутской области');

function safe_output($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Получаем запрошенную страницу
$page = $_GET['page'] ?? 'home';

// Массив достопримечательностей с реальными изображениями
$attractions = [
    [
        'id' => 1,
        'title' => 'Озеро Байкал',
        'description' => 'Самое глубокое озеро в мире, объект Всемирного наследия ЮНЕСКО. Уникальная природа и кристально чистая вода. Глубина достигает 1642 метров, содержит 20% мировых запасов пресной воды.',
        'image' => 'https://a.imgfoto.host/2025/09/20/3.-2025-09-20_222558.jpeg',
        'category' => 'природа'
    ],
    [
        'id' => 2,
        'title' => 'Река Ангара',
        'description' => 'Единственная река, вытекающая из Байкала, протекает через центр Иркутска. Красивые набережные и мосты. Зимой не замерзает благодаря сбросу теплой воды с ГЭС.',
        'image' => 'https://avatars.mds.yandex.net/i?id=0ced23b3e543844d73e883e6157a5b8e_l-5162829-images-thumbs&n=13',
        'category' => 'природа'
    ],
    [
        'id' => 3,
        'title' => '130 квартал',
        'description' => 'Исторический квартал с восстановленными деревянными зданиями XIX века. Музей под открытым небом. Здесь расположены сувенирные лавки, кафе и музеи.',
        'image' => 'https://ak.picdn.net/shutterstock/videos/27404977/thumb/1.jpg',
        'category' => 'архитектура'
    ],
    [
        'id' => 4,
        'title' => 'Иркутский острог',
        'description' => 'Реконструкция первоначальной крепости, с которой начался Иркутск в 1661 году. Воссозданы башни, стены и внутренние постройки казачьего острога.',
        'image' => 'https://avatars.mds.yandex.net/i?id=8d18647570e92bc92c5c4f0fe1feea3a_l-5463940-images-thumbs&ref=rim&n=13&w=2560&h=1440',
        'category' => 'история'
    ],
    [
        'id' => 5,
        'title' => 'Собор Богоявления',
        'description' => 'Православный храм в центре Иркутска, памятник архитектуры XVIII века. Известен уникальными изразцами и богатым внутренним убранством.',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/23/Church_of_the_Epiphany_%28Irkutsk%29.jpg/960px-Church_of_the_Epiphany_%28Irkutsk%29.jpg',
        'category' => 'архитектура'
    ],
    [
        'id' => 6,
        'title' => 'Ледокол "Ангара"',
        'description' => 'Старейший в мире сохранившийся ледокол, ныне музей на берегу Ангары. Построен в 1900 году в Англии, участвовал в Кругобайкальской железной дороге.',
        'image' => 'https://avatars.dzeninfra.ru/get-zen_doc/168601/pub_62e82fe306d92f1a03ffe0e3_62f18b7b7ba78935caf36243/scale_1200',
        'category' => 'история'
    ],
    [
        'id' => 7,
        'title' => 'Кругобайкальская железная дорога',
        'description' => 'Уникальный памятник инженерного искусства. Проходит по живописному берегу Байкала через тоннели, мосты и галереи.',
        'image' => 'https://i.pinimg.com/originals/3e/8a/b2/3e8ab2a075f5a5965b935fad85893bf1.jpg',
        'category' => 'природа'
    ],
    [
        'id' => 8,
        'title' => 'Нерпинарий',
        'description' => 'Единственный в мире нерпинарий, где можно увидеть выступления байкальских нерп - уникальных пресноводных тюленей.',
        'image' => 'https://avatars.dzeninfra.ru/get-zen_doc/931568/pub_5d408e7123371c223184c8dd_5e0f1e0543fdc000b1d65637/scale_1200',
        'category' => 'природа'
    ]
];

// Галерея изображений с реальными URL
$gallery_images = [
    [
        'title' => 'Байкал зимой', 
        'desc' => 'Ледяные гроты и прозрачный лед Байкала',
        'image' => 'https://a.imgfoto.host/2025/09/20/3.-2025-09-20_222558.jpeg'
    ],
    [
        'title' => 'Центр Иркутска', 
        'desc' => 'Историческая застройка центра города',
        'image' => 'https://a.imgfoto.host/2025/09/20/1.-2025-09-20_222558.jpeg'
    ],
    [
        'title' => 'Река Ангара', 
        'desc' => 'Вид на набережную и мосты',
        'image' => 'https://a.imgfoto.host/2025/09/20/2.-2025-09-20_222558.jpeg'
    ],
    [
        'title' => '130 квартал', 
        'desc' => 'Деревянная архитектура исторического квартала',
        'image' => 'https://a.imgfoto.host/2025/09/20/1.-2025-09-20_222558.jpeg'
    ],
    [
        'title' => 'Иркутский острог', 
        'desc' => 'Историческая реконструкция крепости',
        'image' => 'https://a.imgfoto.host/2025/09/20/4.-2025-09-20_222558.jpeg'
    ],
    [
        'title' => 'Богоявленский собор', 
        'desc' => 'Православный храм в центре города',
        'image' => 'https://a.imgfoto.host/2025/09/20/5.-2025-09-20_222558.jpeg'
    ],
    [
        'title' => 'Ледокол Ангара', 
        'desc' => 'Музей-ледокол на берегу Ангары',
        'image' => 'https://a.imgfoto.host/2025/09/20/6.-2025-09-20_222558.jpeg'
    ],
    [
        'title' => 'Зимний Байкал', 
        'desc' => 'Прозрачный лед и ледяные торосы',
        'image' => 'https://a.imgfoto.host/2025/09/20/3.-2025-09-20_222558.jpeg'
    ],
    [
        'title' => 'Архитектура', 
        'desc' => 'Декор старинных деревянных зданий',
        'image' => 'https://a.imgfoto.host/2025/09/20/1.-2025-09-20_222558.jpeg'
    ],
    [
        'title' => 'Вечерний город', 
        'desc' => 'Огни ночного Иркутска',
        'image' => 'https://a.imgfoto.host/2025/09/20/2.-2025-09-20_222558.jpeg'
    ],
    [
        'title' => 'Таежные пейзажи', 
        'desc' => 'Природа Иркутской области',
        'image' => 'https://a.imgfoto.host/2025/09/20/7.-2025-09-20_222558.jpeg'
    ],
    [
        'title' => 'Кружевные дома', 
        'desc' => 'Деревянное зодчество с резными наличниками',
        'image' => 'https://a.imgfoto.host/2025/09/20/1.-2025-09-20_222558.jpeg'
    ]
];

// Устанавливаем заголовки для корректного отображения русского текста
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php 
        echo safe_output(SITE_NAME); 
        if ($page == 'home') echo ' - Главная';
        elseif ($page == 'about') echo ' - О городе';
        elseif ($page == 'attractions') echo ' - Достопримечательности';
        elseif ($page == 'gallery') echo ' - Галерея';
        elseif ($page == 'contact') echo ' - Контакты';
    ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #2c3e50;
            background: #f8f9fa;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        header {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo::before {
            content: "🏔️";
            font-size: 2rem;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 1.5rem;
        }

        .nav-links a {
            text-decoration: none;
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.7rem 1.2rem;
            border-radius: 25px;
            border: 2px solid transparent;
        }

        .nav-links a:hover,
        .nav-links a.active {
            background: rgba(255,255,255,0.2);
            border-color: rgba(255,255,255,0.3);
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(44, 62, 80, 0.7), rgba(52, 152, 219, 0.7)), 
                        url('https://a.imgfoto.host/2025/09/20/3.-2025-09-20_222558.jpeg');
            background-size: cover;
            background-position: center;
            height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            margin-top: 80px;
            position: relative;
        }

        .hero-content h1 {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            text-shadow: 3px 3px 6px rgba(0,0,0,0.5);
            animation: fadeInUp 1s ease;
        }

        .hero-content p {
            font-size: 1.5rem;
            margin-bottom: 2.5rem;
            animation: fadeInUp 1s ease 0.3s both;
        }

        .btn {
            display: inline-block;
            background: linear-gradient(45deg, #e74c3c, #c0392b);
            color: white;
            padding: 15px 35px;
            text-decoration: none;
            border-radius: 30px;
            transition: all 0.3s ease;
            font-weight: bold;
            font-size: 1.1rem;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            animation: fadeInUp 1s ease 0.6s both;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
            background: linear-gradient(45deg, #c0392b, #a93226);
        }

        .btn-secondary {
            background: linear-gradient(45deg, #3498db, #2980b9);
        }

        .btn-secondary:hover {
            background: linear-gradient(45deg, #2980b9, #21618c);
        }

        /* Main Content */
        .main-content {
            background: white;
            min-height: 500px;
            padding: 4rem 0;
        }

        .section-title {
            text-align: center;
            font-size: 2.8rem;
            margin-bottom: 3rem;
            color: #2c3e50;
            position: relative;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: linear-gradient(45deg, #3498db, #2c3e50);
            margin: 1rem auto;
            border-radius: 2px;
        }

        /* Attractions Grid */
        .attractions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2.5rem;
            margin-top: 2rem;
        }

        .attraction-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
        }

        .attraction-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .attraction-image {
            width: 100%;
            height: 250px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            align-items: flex-end;
            justify-content: flex-start;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .attraction-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
            z-index: 1;
        }

        .attraction-title-overlay {
            position: relative;
            z-index: 2;
            padding: 1rem;
            font-size: 1.3rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .attraction-content {
            padding: 2rem;
        }

        .attraction-title {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #2c3e50;
        }

        .attraction-category {
            background: linear-gradient(45deg, #3498db, #2c3e50);
            color: white;
            padding: 0.4rem 1.2rem;
            border-radius: 20px;
            font-size: 0.9rem;
            display: inline-block;
            margin-bottom: 1rem;
            font-weight: bold;
        }

        /* Gallery */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .gallery-item {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 250px;
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .gallery-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.7), rgba(0,0,0,0.3));
            z-index: 1;
        }

        .gallery-item:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }

        .gallery-title {
            font-weight: bold;
            font-size: 1.1rem;
            text-align: center;
            padding: 0 1rem;
            position: relative;
            z-index: 2;
        }

        .gallery-desc {
            font-size: 0.9rem;
            opacity: 0.9;
            text-align: center;
            padding: 0 1rem;
            margin-top: 0.5rem;
            position: relative;
            z-index: 2;
        }

        /* Contact Form */
        .contact-form {
            max-width: 700px;
            margin: 0 auto;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .form-group {
            margin-bottom: 2rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.8rem;
            font-weight: bold;
            color: #2c3e50;
            font-size: 1.1rem;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 1rem;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        .form-group textarea {
            height: 150px;
            resize: vertical;
        }

        /* About Section */
        .about-content {
            max-width: 900px;
            margin: 0 auto;
        }

        .about-text {
            font-size: 1.2rem;
            line-height: 1.8;
            margin-bottom: 3rem;
            text-align: left;
        }

        .about-text p {
            margin-bottom: 1.5rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }

        .stat-item {
            background: linear-gradient(135deg, #3498db, #2c3e50);
            color: white;
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-5px);
        }

        .stat-number {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .feature-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }

        .feature-item {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 10px;
            border-left: 4px solid #3498db;
        }

        .feature-item h4 {
            color: #2c3e50;
            margin-bottom: 1rem;
            font-size: 1.3rem;
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            text-align: center;
            padding: 3rem 0;
            margin-top: 4rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            text-align: left;
            margin-bottom: 2rem;
        }

        .footer-section h3 {
            margin-bottom: 1.5rem;
            color: #3498db;
        }

        .footer-section a {
            color: white;
            text-decoration: none;
            display: block;
            margin-bottom: 0.5rem;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: #3498db;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 2rem;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 1rem;
            }
            
            .nav-links {
                gap: 0.5rem;
            }
            
            .nav-links a {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }
            
            .hero-content h1 {
                font-size: 2.5rem;
            }
            
            .hero-content p {
                font-size: 1.2rem;
            }
            
            .attractions-grid {
                grid-template-columns: 1fr;
            }
            
            .section-title {
                font-size: 2.2rem;
            }
            
            .contact-form {
                padding: 2rem;
            }
        }

        /* Success Message */
        .success-message {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            color: white;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            text-align: center;
            animation: fadeInUp 0.5s ease;
        }

        .filter-buttons {
            text-align: center;
            margin-bottom: 2rem;
        }

        .filter-btn {
            background: #e9ecef;
            border: none;
            padding: 0.8rem 1.5rem;
            margin: 0 0.5rem;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .filter-btn.active,
        .filter-btn:hover {
            background: linear-gradient(45deg, #3498db, #2c3e50);
            color: white;
        }

        /* 404 Page */
        .error-page {
            text-align: center;
            padding: 4rem 0;
        }

        .error-page h2 {
            font-size: 3rem;
            color: #e74c3c;
            margin-bottom: 1rem;
        }

        .error-page p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            color: #666;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <nav class="navbar">
                <a href="?page=home" class="logo"><?php echo safe_output(SITE_NAME); ?></a>
                <ul class="nav-links">
                    <li><a href="?page=home" class="<?php echo $page == 'home' ? 'active' : ''; ?>">Главная</a></li>
                    <li><a href="?page=about" class="<?php echo $page == 'about' ? 'active' : ''; ?>">О городе</a></li>
                    <li><a href="?page=attractions" class="<?php echo $page == 'attractions' ? 'active' : ''; ?>">Достопримечательности</a></li>
                    <li><a href="?page=gallery" class="<?php echo $page == 'gallery' ? 'active' : ''; ?>">Галерея</a></li>
                    <li><a href="?page=contact" class="<?php echo $page == 'contact' ? 'active' : ''; ?>">Контакты</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <?php if ($page == 'home'): ?>
    <section class="hero">
        <div class="hero-content">
            <h1>Красоты Иркутска</h1>
            <p>Откройте для себя удивительную природу и богатую историю сибирского края</p>
            <a href="?page=attractions" class="btn">Начать путешествие</a>
        </div>
    </section>
    <?php endif; ?>

    <main class="main-content">
        <div class="container">
            <?php
            // Главная страница
            if ($page == 'home') {
                echo '
                <section class="welcome">
                    <h2 class="section-title">Добро пожаловать в Иркутск</h2>
                    <div class="about-text">
                        <p>Иркутск — один из старейших и красивейших городов Сибири, основанный в 1661 году. Расположенный на берегах реки Ангары, всего в 70 км от всемирно известного озера Байкал, город сочетает в себе богатое историческое наследие и уникальную природу.</p>
                        
                        <p>Здесь вы найдете великолепные образцы деревянного зодчества, православные храмы, современные музеи и, конечно, гостеприимных местных жителей. Иркутск по праву называют "Сибирским Парижем" за его архитектурное великолепие.</p>
                    </div>

                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-number">1661</div>
                            <div>Год основания</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">70км</div>
                            <div>До озера Байкал</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">600+</div>
                            <div>Памятников архитектуры</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">1.6м</div>
                            <div>Туристов в год</div>
                        </div>
                    </div>

                    <h3 class="section-title">Популярные достопримечательности</h3>
                    <div class="attractions-grid">';
                
                $featured_attractions = array_slice($attractions, 0, 3);
                foreach ($featured_attractions as $attraction) {
                    echo '
                    <div class="attraction-card">
                        <div class="attraction-image" style="background-image: url(\'' . safe_output($attraction['image']) . '\')">
                            <div class="attraction-title-overlay">' . safe_output($attraction['title']) . '</div>
                        </div>
                        <div class="attraction-content">
                            <span class="attraction-category">' . safe_output($attraction['category']) . '</span>
                            <p>' . safe_output($attraction['description']) . '</p>
                        </div>
                    </div>';
                }
                
                echo '
                    </div>
                    <div style="text-align: center; margin-top: 3rem;">
                        <a href="?page=attractions" class="btn">Смотреть все достопримечательности</a>
                    </div>
                </section>';
            }

            // Страница "О городе"
            elseif ($page == 'about') {
                echo '
                <section class="about">
                    <h2 class="section-title">О Иркутске</h2>
                    <div class="about-content">
                        <div class="about-text">
                            <p>Иркутск — крупный административный, экономический и культурный центр Восточной Сибири, столица Иркутской области. Город расположен на берегах реки Ангары при впадении в неё реки Иркут, в 66 км к западу от озера Байкал.</p>
                            
                            <h3 style="color: #2c3e50; margin: 2rem 0 1rem 0;">Историческая справка</h3>
                            <p>Иркутск был основан как острог в 1661 году. Благодаря выгодному географическому положению город быстро стал центром торговли и ремёсел. В XVIII-XIX веках через Иркутск пролегал Великий чайный путь, что способствовало его экономическому развитию.</p>
                            
                            <h3 style="color: #2c3e50; margin: 2rem 0 1rem 0;">Архитектура</h3>
                            <p>Город знаменит своей уникальной деревянной архитектурой. Более 600 зданий в Иркутске являются памятниками архитектуры. Особенно выделяется 130-й квартал — исторический район, где сохранились и восстановлены старинные деревянные дома с резными наличниками.</p>
                            
                            <h3 style="color: #2c3e50; margin: 2rem 0 1rem 0;">Культура и наука</h3>
                            <p>В Иркутске находится один из старейших университетов Сибири — Иркутский государственный университет, основанный в 1918 году. Город также известен своими театрами, музеями и научными центрами.</p>
                            
                            <h3 style="color: #2c3e50; margin: 2rem 0 1rem 0;">Природа</h3>
                            <p>Близость к озеру Байкал — объекту Всемирного наследия ЮНЕСКО — делает Иркутск привлекательным для туристов со всего мира. Уникальная природа Байкала, его флора и фауна привлекают ученых и любителей природы.</p>
                        </div>

                        <div class="feature-list">
                            <div class="feature-item">
                                <h4>📊 География</h4>
                                <p>Иркутск расположен в Восточной Сибири, на берегах реки Ангары. Климат резко континентальный с холодной зимой и теплым летом.</p>
                            </div>
                            <div class="feature-item">
                                <h4>🏛️ Культура</h4>
                                <p>Богатое культурное наследие: театры, музеи, художественные галереи. Ежегодно проводятся международные фестивали.</p>
                            </div>
                            <div class="feature-item">
                                <h4>🌳 Экология</h4>
                                <p>Чистейший воздух, уникальная природа Байкала. Город окружен таежными лесами и горными хребтами.</p>
                            </div>
                        </div>

                        <div style="text-align: center; margin-top: 3rem;">
                            <a href="?page=gallery" class="btn btn-secondary">Посмотреть галерею</a>
                            <a href="?page=attractions" class="btn" style="margin-left: 1rem;">Исследовать достопримечательности</a>
                        </div>
                    </div>
                </section>';
            }

            // Страница достопримечательностей
            elseif ($page == 'attractions') {
                $category = $_GET['category'] ?? 'all';
                
                echo '
                <h2 class="section-title">Достопримечательности Иркутска</h2>
                
                <div class="filter-buttons">
                    <button class="filter-btn ' . ($category == 'all' ? 'active' : '') . '" onclick="window.location.href=\'?page=attractions\'">Все</button>
                    <button class="filter-btn ' . ($category == 'природа' ? 'active' : '') . '" onclick="window.location.href=\'?page=attractions&category=природа\'">Природа</button>
                    <button class="filter-btn ' . ($category == 'архитектура' ? 'active' : '') . '" onclick="window.location.href=\'?page=attractions&category=архитектура\'">Архитектура</button>
                    <button class="filter-btn ' . ($category == 'история' ? 'active' : '') . '" onclick="window.location.href=\'?page=attractions&category=история\'">История</button>
                </div>

                <div class="attractions-grid">';
                
                $filtered_attractions = $attractions;
                if ($category != 'all') {
                    $filtered_attractions = array_filter($attractions, function($attraction) use ($category) {
                        return $attraction['category'] == $category;
                    });
                }
                
                if (empty($filtered_attractions)) {
                    echo '<p style="text-align: center; grid-column: 1 / -1; font-size: 1.2rem; color: #666;">Достопримечательности не найдены</p>';
                } else {
                    foreach ($filtered_attractions as $attraction) {
                        echo '
                        <div class="attraction-card">
                            <div class="attraction-image" style="background-image: url(\'' . safe_output($attraction['image']) . '\')">
                                <div class="attraction-title-overlay">' . safe_output($attraction['title']) . '</div>
                            </div>
                            <div class="attraction-content">
                                <span class="attraction-category">' . safe_output($attraction['category']) . '</span>
                                <p>' . safe_output($attraction['description']) . '</p>
                            </div>
                        </div>';
                    }
                }
                
                echo '</div>';
            }

            // Страница галереи
            elseif ($page == 'gallery') {
                echo '
                <h2 class="section-title">Галерея Иркутска</h2>
                <p style="text-align: center; font-size: 1.2rem; margin-bottom: 2rem; color: #666;">
                    Красивые виды и достопримечательности города и области
                </p>
                <div class="gallery-grid">';
                
                foreach ($gallery_images as $image) {
                    echo '
                    <div class="gallery-item" style="background-image: url(\'' . safe_output($image['image']) . '\')">
                        <div class="gallery-title">' . safe_output($image['title']) . '</div>
                        <div class="gallery-desc">' . safe_output($image['desc']) . '</div>
                    </div>';
                }
                
                echo '</div>
                <div style="text-align: center; margin-top: 3rem;">
                    <a href="?page=attractions" class="btn">Узнать больше о достопримечательностях</a>
                </div>';
            }

            // Страница контактов
            elseif ($page == 'contact') {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $name = safe_output($_POST['name'] ?? '');
                    $email = safe_output($_POST['email'] ?? '');
                    $subject = safe_output($_POST['subject'] ?? '');
                    $message = safe_output($_POST['message'] ?? '');
                    
                    echo '
                    <div class="success-message">
                        <h3>Спасибо за ваше сообщение, ' . $name . '!</h3>
                        <p>Мы получили ваш запрос по теме "' . $subject . '" и скоро свяжемся с вами.</p>
                    </div>';
                }
                
                echo '
                <h2 class="section-title">Свяжитесь с нами</h2>
                <div class="contact-form">
                    <form method="POST">
                        <div class="form-group">
                            <label for="name">Ваше имя:</label>
                            <input type="text" id="name" name="name" required placeholder="Введите ваше имя">
                        </div>
                        <div class="form-group">
                            <label for="email">Ваш email:</label>
                            <input type="email" id="email" name="email" required placeholder="Введите ваш email">
                        </div>
                        <div class="form-group">
                            <label for="subject">Тема сообщения:</label>
                            <select id="subject" name="subject" required>
                                <option value="">Выберите тему</option>
                                <option value="Туризм">Туризм</option>
                                <option value="Экскурсии">Экскурсии</option>
                                <option value="Сотрудничество">Сотрудничество</option>
                                <option value="Вопрос">Вопрос</option>
                                <option value="Отзыв">Отзыв</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message">Сообщение:</label>
                            <textarea id="message" name="message" required placeholder="Напишите ваше сообщение..."></textarea>
                        </div>
                        <button type="submit" class="btn" style="width: 100%;">Отправить сообщение</button>
                    </form>
                </div>
                <div style="margin-top: 4rem; text-align: center;">
                    <h3 style="margin-bottom: 2rem; color: #2c3e50;">Контактная информация</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
                        <div>
                            <h4 style="color: #3498db; margin-bottom: 1rem;">📧 Email</h4>
                            <p>info@irkutsk-beauty.ru</p>
                            <p>tourism@irkutsk.ru</p>
                        </div>
                        <div>
                            <h4 style="color: #3498db; margin-bottom: 1rem;">📞 Телефоны</h4>
                            <p>+7 (3952) 123-456</p>
                            <p>+7 (3952) 789-012</p>
                        </div>
                        <div>
                            <h4 style="color: #3498db; margin-bottom: 1rem;">📍 Адрес</h4>
                            <p>г. Иркутск, ул. Ленина, 1</p>
                            <p>Туристический информационный центр</p>
                        </div>
                    </div>
                </div>';
            }

            // Если страница не найдена (404)
            else {
                echo '
                <div class="error-page">
                    <h2>Страница не найдена</h2>
                    <p>Запрошенная страница не существует.</p>
                    <a href="?page=home" class="btn">Вернуться на главную</a>
                </div>';
            }
            ?>
        </div>
    </main>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>О сайте</h3>
                    <p>' . safe_output(SITE_DESCRIPTION) . '</p>
                    <p>Мы помогаем туристам открыть для себя красоту Иркутска и его окрестностей.</p>
                </div>
                <div class="footer-section">
                    <h3>Быстрые ссылки</h3>
                    <a href="?page=home">Главная</a>
                    <a href="?page=about">О городе</a>
                    <a href="?page=attractions">Достопримечательности</a>
                    <a href="?page=gallery">Галерея</a>
                    <a href="?page=contact">Контакты</a>
                </div>
                <div class="footer-section">
                    <h3>Контакты</h3>
                    <p>📧 info@irkutsk-beauty.ru</p>
                    <p>📞 +7 (3952) 123-456</p>
                    <p>📍 г. Иркутск, ул. Ленина, 1</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; ' . date('Y') . ' ' . safe_output(SITE_NAME) . '. Все права защищены.</p>
                <p>Откройте для себя красоты Иркутска вместе с нами!</p>
            </div>
        </div>
    </footer>
</body>
</html>