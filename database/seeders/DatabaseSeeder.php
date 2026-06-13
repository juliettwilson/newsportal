<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\News;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@news.kz',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);


        $authors = [
            User::create([
                'name' => 'Айгүл Қасымова',
                'email' => 'aigul@news.kz',
                'password' => bcrypt('password'),
                'role' => 'author',
            ]),
            User::create([
                'name' => 'Бауыржан Омаров',
                'email' => 'baurzhan@news.kz',
                'password' => bcrypt('password'),
                'role' => 'author',
            ]),
            User::create([
                'name' => 'Динара Сейтова',
                'email' => 'dinara@news.kz',
                'password' => bcrypt('password'),
                'role' => 'author',
            ]),
        ];

        $categories = [
            [
                'name_kk' => 'Саясат',
                'name_ru' => 'Политика',
                'name_en' => 'Politics',
                'slug' => 'politics',
                'color' => '#1e40af',
                'icon' => 'globe',
                'description_kk' => 'Ішкі және сыртқы саяси жаңалықтар',
            ],
            [
                'name_kk' => 'Экономика',
                'name_ru' => 'Экономика',
                'name_en' => 'Economy',
                'slug' => 'economy',
                'color' => '#15803d',
                'icon' => 'trending-up',
                'description_kk' => 'Қаржы, бизнес және экономикалық жаңалықтар',
            ],
            [
                'name_kk' => 'Спорт',
                'name_ru' => 'Спорт',
                'name_en' => 'Sport',
                'slug' => 'sport',
                'color' => '#b91c1c',
                'icon' => 'trophy',
                'description_kk' => 'Спорттық жарыстар мен нәтижелер',
            ],
            [
                'name_kk' => 'Технология',
                'name_ru' => 'Технологии',
                'name_en' => 'Technology',
                'slug' => 'technology',
                'color' => '#7c3aed',
                'icon' => 'cpu',
                'description_kk' => 'IT және технологиялық инновациялар',
            ],
            [
                'name_kk' => 'Мәдениет',
                'name_ru' => 'Культура',
                'name_en' => 'Culture',
                'slug' => 'culture',
                'color' => '#ea580c',
                'icon' => 'palette',
                'description_kk' => 'Өнер, мәдениет және көңіл көтеру',
            ],
            [
                'name_kk' => 'Қоғам',
                'name_ru' => 'Общество',
                'name_en' => 'Society',
                'slug' => 'society',
                'color' => '#0891b2',
                'icon' => 'users',
                'description_kk' => 'Қоғамдық өмір және әлеуметтік мәселелер',
            ],
            [
                'name_kk' => 'Денсаулық',
                'name_ru' => 'Здоровье',
                'name_en' => 'Health',
                'slug' => 'health',
                'color' => '#16a34a',
                'icon' => 'heart',
                'description_kk' => 'Медицина және денсаулық сақтау',
            ],
            [
                'name_kk' => 'Білім',
                'name_ru' => 'Образование',
                'name_en' => 'Education',
                'slug' => 'education',
                'color' => '#9333ea',
                'icon' => 'book',
                'description_kk' => 'Білім беру саласындағы жаңалықтар',
            ],
        ];

        $newsData = [
            'politics' => [
                [
                    'title_kk' => 'Қазақстан мен Қытай арасындағы визасыз режимнің нәтижелері талқыланды',
                    'title_ru' => 'Обсуждены результаты безвизового режима между Казахстаном и Китаем',
                    'title_en' => 'Results of visa-free regime between Kazakhstan and China discussed',
                    'content_kk' => 'Екі ел арасындағы туристік ағын соңғы жылы едәуір өсті. Ресми мәліметтер бойынша, визасыз режим енгізілгелі бері өзара сапарлар саны 30%-ға артқан. Бұл экономикалық ынтымақтастық пен мәдени алмасуға жаңа серпін беруде.',
                    'excerpt_kk' => 'Визасыз режим енгізілгелі бері өзара сапарлар саны 30%-ға артқан.',
                    'is_featured' => true,
                    'image_keyword' => 'china-kazakhstan',
                ],
                [
                    'title_kk' => 'Парламент су тасқынынан зардап шеккендерге көмек туралы жаңа заңды мақұлдады',
                    'title_ru' => 'Парламент одобрил новый закон о помощи пострадавшим от паводков',
                    'title_en' => 'Parliament approved new law on aid for flood victims',
                    'content_kk' => 'Мәжіліс депутаттары төтенше жағдай кезінде азаматтарды әлеуметтік қорғау тетіктерін күшейтуге бағытталған заң жобасын қабылдады. Жаңа құжат бойынша өтемақы төлеу мерзімі қысқарып, баспанасыз қалғандарға жаңа үй салуға бюджеттен қосымша қаражат бөлінеді.',
                    'excerpt_kk' => 'Жаңа құжат бойынша өтемақы төлеу мерзімі қысқарып, көмек көлемі артады.',
                    'is_featured' => false,
                    'image_keyword' => 'parliament',
                ],
            ],
            'economy' => [
                [
                    'title_kk' => 'Қазақстанның ЖІӨ өсімі 2024 жылдың бірінші тоқсанында 3,9%-ды құрады',
                    'title_ru' => 'Рост ВВП Казахстана в первом квартале 2024 года составил 3,9%',
                    'title_en' => 'Kazakhstan\'s GDP growth in Q1 2024 amounted to 3.9%',
                    'content_kk' => 'Ұлттық экономика министрлігінің хабарлауынша, өсім негізінен құрылыс, көлік және байланыс салалары есебінен қамтамасыз етілді. Инфляция деңгейі де біртіндеп төмендеп келеді, бұл базалық мөлшерлеменің төмендеуіне негіз болуы мүмкін.',
                    'excerpt_kk' => 'Өсім негізінен құрылыс, көлік және байланыс салалары есебінен қамтамасыз етілді.',
                    'is_featured' => true,
                    'image_keyword' => 'economy-growth',
                ],
                [
                    'title_kk' => 'Теңге бағамы мұнай бағасының ауытқуына қарамастан тұрақтылық танытуда',
                    'title_ru' => 'Курс тенге сохраняет стабильность, несмотря на колебания цен на нефть',
                    'title_en' => 'Tenge exchange rate remains stable despite oil price fluctuations',
                    'content_kk' => 'Ұлттық Банк интервенцияларсыз-ақ валюта нарығындағы тепе-теңдікті сақтап тұр. Мұнайдың бір баррелі 80 доллардан жоғары болуы бюджет түсімдеріне оң әсер етуде. Сарапшылар жыл соңына дейін күрт ауытқулар болмайтынын болжайды.',
                    'excerpt_kk' => 'Мұнайдың бір баррелі 80 доллардан жоғары болуы теңгеге оң әсер етуде.',
                    'is_featured' => false,
                    'image_keyword' => 'currency',
                ],
            ],
            'sport' => [
                [
                    'title_kk' => 'Қазақстандық спортшылар Олимпиада жолдамалары үшін күресуде',
                    'title_ru' => 'Казахстанские спортсмены борются за олимпийские лицензии',
                    'title_en' => 'Kazakhstani athletes are fighting for Olympic licenses',
                    'content_kk' => 'Бокс, күрес және жеңіл атлетикадан іріктеу турнирлері шешуші кезеңге өтті. Қазіргі таңда Қазақстан қоржынында 30-дан астам жолдама бар. Бапкерлер штабы биылғы додадан жоғары нәтижелер күтеді.',
                    'excerpt_kk' => 'Қазіргі таңда Қазақстан қоржынында 30-дан астам жолдама бар.',
                    'is_featured' => true,
                    'image_keyword' => 'olympics',
                ],
                [
                    'title_kk' => '«Астана» футбол клубы Еурокубоктардағы қарсыластарын анықтады',
                    'title_ru' => 'Футбольный клуб «Астана» узнал соперников в Еврокубках',
                    'title_en' => 'FC Astana found out its opponents in the European Cups',
                    'content_kk' => 'Жеребе қорытындысы бойынша елордалық ұжым мықты топқа түсті. Бас бапкердің айтуынша, команда дайындықты күшейтіп, плей-офф кезеңіне шығуды мақсат етіп отыр. Жанкүйерлердің қолдауы маңызды рөл атқармақ.',
                    'excerpt_kk' => 'Елордалық ұжым Еурокубоктарда мықты топқа түсті.',
                    'is_featured' => false,
                    'image_keyword' => 'football',
                ],
            ],
            'technology' => [
                [
                    'title_kk' => 'Қазақстанда жасанды интеллектіні дамытудың ұлттық стратегиясы қабылданды',
                    'title_ru' => 'В Казахстане принята национальная стратегия развития искусственного интеллекта',
                    'title_en' => 'National strategy for AI development adopted in Kazakhstan',
                    'content_kk' => 'Үкімет ЖИ технологияларын экономиканың барлық салаларына енгізуді жоспарлап отыр. Осы мақсатта Астанада арнайы есептеу орталығы ашылып, отандық мамандарды оқытуға гранттар бөлінеді. Бұл елдің цифрлық бәсекеге қабілеттілігін арттырады.',
                    'excerpt_kk' => 'Үкімет ЖИ технологияларын экономиканың барлық салаларына енгізуді жоспарлауда.',
                    'is_featured' => true,
                    'image_keyword' => 'artificial-intelligence',
                ],
                [
                    'title_kk' => 'Отандық ғарышкерлер жаңа ғылыми эксперименттерді сәтті аяқтады',
                    'title_ru' => 'Отечественные космонавты успешно завершили новые научные эксперименты',
                    'title_en' => 'Domestic cosmonauts successfully completed new scientific experiments',
                    'content_kk' => 'Ғарыш мониторингі арқылы жер ресурстарын тиімді пайдалану жолдары зерттелді. Алынған мәліметтер ауыл шаруашылығы мен экология салаларында қолданылатын болады. Бұл ғылым мен өндірістің байланысын нығайтады.',
                    'excerpt_kk' => 'Ғарыш мониторингі арқылы жер ресурстарын тиімді пайдалану жолдары зерттелді.',
                    'is_featured' => false,
                    'image_keyword' => 'space',
                ],
            ],
            'culture' => [
                [
                    'title_kk' => 'Алматыда қазақ киносының жаңа фестивалі басталды',
                    'title_ru' => 'В Алматы стартовал новый фестиваль казахского кино',
                    'title_en' => 'A new Kazakh film festival has started in Almaty',
                    'content_kk' => 'Фестиваль аясында отандық режиссерлердің 20-дан астам жаңа туындылары көрсетіледі. Шараның басты мақсаты – жас таланттарды қолдау және ұлттық кинематографияны халықаралық деңгейге шығару.',
                    'excerpt_kk' => 'Фестиваль аясында отандық режиссерлердің 20-дан астам туындылары көрсетіледі.',
                    'is_featured' => true,
                ],
                [
                    'title_kk' => 'Түркістандағы тарихи кесенелер ЮНЕСКО тізіміне ұсынылмақ',
                    'title_ru' => 'Исторические мавзолеи Туркестана будут предложены в список ЮНЕСКО',
                    'title_en' => 'Historical mausoleums of Turkestan to be proposed to the UNESCO list',
                    'content_kk' => 'Мәдениет министрлігі ортағасырлық сәулет ескерткіштерін сақтау бойынша жаңа бағдарлама қабылдады. Алдағы уақытта Түркістан облысындағы бірқатар тарихи нысандар әлемдік мұра тізіміне енуі мүмкін.',
                    'excerpt_kk' => 'Ортағасырлық сәулет ескерткіштерін сақтау бойынша бағдарлама қабылданды.',
                    'is_featured' => false,
                ],
            ],
            'society' => [
                [
                    'title_kk' => 'Қазақстанда көпбалалы отбасыларға берілетін жәрдемақы көлемі артты',
                    'title_ru' => 'В Казахстане увеличен размер пособий для многодетных семей',
                    'title_en' => 'The size of allowances for large families increased in Kazakhstan',
                    'content_kk' => 'Жаңа заңнамалық өзгерістерге сәйкес, әлеуметтік төлемдер 15%-ға өсті. Сондай-ақ, тұрғын үй кезегінде тұрған отбасыларға жеңілдетілген ипотекалық бағдарламалар ұсынылмақ.',
                    'excerpt_kk' => 'Жаңа заңнамалық өзгерістерге сәйкес, әлеуметтік төлемдер 15%-ға өсті.',
                    'is_featured' => true,
                ],
                [
                    'title_kk' => 'Еріктілер қозғалысы экологиялық акцияларды жалғастыруда',
                    'title_ru' => 'Волонтерское движение продолжает экологические акции',
                    'title_en' => 'Volunteer movement continues ecological campaigns',
                    'content_kk' => 'Бүкіл ел аумағында «Таза табиғат» акциясы аясында мыңдаған тонна қоқыс жиналды. Жастар ұйымдары бұл бастаманы тұрақты түрде өткізіп тұруды жоспарлап отыр.',
                    'excerpt_kk' => 'Бүкіл ел аумағында «Таза табиғат» акциясы аясында қоқыс жиналды.',
                    'is_featured' => false,
                ],
            ],
            'health' => [
                [
                    'title_kk' => 'Астанада жаңа ғылыми-медициналық орталық ашылды',
                    'title_ru' => 'В Астане открылся новый научно-медицинский центр',
                    'title_en' => 'A new scientific and medical center opened in Astana',
                    'content_kk' => 'Заманауи құрал-жабдықтармен қамтамасыз етілген орталық күрделі оталарды жасауға және сирек кездесетін ауруларды зерттеуге бағытталған. Бұл шетелдік клиникаларға тәуелділікті азайтады.',
                    'excerpt_kk' => 'Орталық күрделі оталарды жасауға және сирек кездесетін ауруларды зерттеуге бағытталған.',
                    'is_featured' => true,
                ],
                [
                    'title_kk' => 'Ауылдық жерлерде медициналық қызмет сапасы жақсаруда',
                    'title_ru' => 'Качество медицинских услуг в сельской местности улучшается',
                    'title_en' => 'The quality of medical services in rural areas is improving',
                    'content_kk' => '«Ауылдағы денсаулық сақтауды жаңғырту» ұлттық жобасы аясында 300-ден астам жаңа фельдшерлік-акушерлік пункт салынды. Сондай-ақ, жас мамандарды ауылға тарту бағдарламасы жұмыс істеуде.',
                    'excerpt_kk' => 'Ұлттық жоба аясында 300-ден астам жаңа фельдшерлік-акушерлік пункт салынды.',
                    'is_featured' => false,
                ],
            ],
            'education' => [
                [
                    'title_kk' => 'Қазақстандық оқушылар халықаралық математика олимпиадасында жеңіске жетті',
                    'title_ru' => 'Казахстанские школьники победили на международной олимпиаде по математике',
                    'title_en' => 'Kazakhstani students won the international math olympiad',
                    'content_kk' => 'Лондонда өткен білім додасында біздің құрама 3 алтын және 2 күміс медаль жеңіп алды. Ел президенті дарынды жастарды құттықтап, оларға арнайы гранттар тағайындады.',
                    'excerpt_kk' => 'Лондонда өткен білім додасында біздің құрама 3 алтын және 2 күміс медаль жеңіп алды.',
                    'is_featured' => true,
                ],
                [
                    'title_kk' => 'Жоғары оқу орындарында жаңа IT мамандықтары ашылуда',
                    'title_ru' => 'В вузах открываются новые ИТ-специальности',
                    'title_en' => 'New IT specialties are opening in universities',
                    'content_kk' => 'Еңбек нарығындағы сұранысқа байланысты университеттер киберқауіпсіздік және жасанды интеллект бағыттары бойынша жаңа білім беру бағдарламаларын іске қосты. Шетелдік профессорлар да дәріс оқитын болады.',
                    'excerpt_kk' => 'Университеттер жасанды интеллект бағыты бойынша жаңа бағдарламалар іске қосты.',
                    'is_featured' => false,
                ],
            ],
        ];


        $images = [
            'politics' => ['1529107386315-e1a2ed48a620', '1555848962-6e79363ec58f', '1450133064473-71024230f91b'],
            'economy' => ['1611974717434-d39129c1eb7a', '1590283603911-99a50cca297b', '1526303323156-6d88c2739459'],
            'sport' => ['1461896702790-a5f27f0a1ea2', '1517649763962-0c623066013b', '1574629810360-7efbbe195018'],
            'technology' => ['1485827404703-89b55fcc595e', '1518770660439-4636190af475', '1550751827-4bd374c3f58b'],
            'culture' => ['1460667341246-dd07480d67e3', '1513364775202-b6369134b223', '1561149835-9372836c84ee'],
            'society' => ['1491438590914-bc09fcaaf77a', '1523240715630-31d8031d10a2', '1490374722026-686121e90950'],
            'health' => ['1505751172107-5739a007f35e', '1532938911079-1b06ac7ceec7', '1584483766114-2070f275f199'],
            'education' => ['1524178232363-1fb2b075b655', '1497633762264-91ad05d01cdb', '1503676260728-fdc00e1fad50'],
        ];

        foreach ($categories as $catData) {
            $category = Category::create($catData);


            $dataList = $newsData[$catData['slug']] ?? [
                [
                    'title_kk' => $catData['name_kk'] . ' саласындағы жаңалық 1',
                    'title_ru' => $catData['name_ru'] . ' в фокусе: важное событие',
                    'title_en' => $catData['name_en'] . ' in focus: major event',
                    'content_kk' => $catData['description_kk'] . '. Бүгінгі таңда бұл сала қарқынды дамып келеді. Мамандар алдағы уақытта үлкен өзгерістер болатынын болжап отыр. Халықтың әл-ауқатын арттыруға бағытталған жаңа жобалар іске асырылуда.',
                    'excerpt_kk' => $catData['name_kk'] . ' саласындағы маңызды жаңалықтар мен өзгерістер.',
                    'is_featured' => rand(0, 1),
                ],
                [
                    'title_kk' => $catData['name_kk'] . ' саласындағы жаңалық 2',
                    'title_ru' => $catData['name_ru'] . ' новости: актуальное',
                    'title_en' => $catData['name_en'] . ' news: latest updates',
                    'content_kk' => 'Салалық конференция барысында жаңа стратегиялық жоспар таныстырылды. Бұл құжат алдағы бес жылдағы даму бағытын айқындайды. Инновациялық шешімдер мен цифрландыру мәселелеріне басымдық берілген.',
                    'excerpt_kk' => 'Конференция барысында жаңа даму стратегиясы таныстырылды.',
                    'is_featured' => false,
                ]
            ];

            foreach ($dataList as $index => $news) {
                $keywords = [
                    'politics' => 'astana',
                    'economy' => 'almaty',
                    'sport' => 'kazakhstan',
                    'technology' => 'astana',
                    'culture' => 'kazakhstan',
                    'society' => 'almaty',
                    'health' => 'kazakhstan',
                    'education' => 'almaty',
                ];
                $keyword = $keywords[$catData['slug']] ?? 'kazakhstan';
                $randomImageUrl = "https://loremflickr.com/800/600/{$keyword}/all?lock=" . rand(1, 1000);

                News::create([
                    'category_id' => $category->id,
                    'author_id' => $authors[array_rand($authors)]->id,
                    'slug' => $catData['slug'] . "-news-" . Str::random(8),
                    'title_kk' => $news['title_kk'],
                    'title_ru' => $news['title_ru'],
                    'title_en' => $news['title_en'],
                    'content_kk' => $news['content_kk'],
                    'content_ru' => $news['title_ru'] . '. ' . $news['content_kk'],
                    'content_en' => $news['title_en'] . '. ' . $news['content_kk'],
                    'excerpt_kk' => $news['excerpt_kk'] ?? null,
                    'excerpt_ru' => $news['title_ru'] ?? null,
                    'excerpt_en' => $news['title_en'] ?? null,
                    'image' => $randomImageUrl,
                    'is_published' => true,
                    'is_featured' => $news['is_featured'] ?? false,
                    'published_at' => now()->subDays(rand(0, 10)),
                    'views' => rand(100, 10000),
                    'likes' => rand(10, 1000),
                ]);
            }
        }

    }
}
