<?php


namespace Iliah\Core;


//use Iliah\Core\Components\Router\Router;
use Iliah\Core\Components\Logger\Logger;
use Iliah\Core\Contracts\BootstrapInterface;
use Iliah\Core\Contracts\ContainerInterface;
use Iliah\Core\Contracts\RunnableInterface;
use Psr\Log\LoggerInterface;

/**
 * Class Application
 * Класс прилоежния - контейнер, который содержит различные сервисы.
 * Приложение можно конфигурировать - добавлять и удалять различные севрисы
 *
 * @package Iliah\Core
 */
class Application implements BootstrapInterface, ContainerInterface, RunnableInterface
{
    /**
     * @var Application Экземпляр приложения
     * Паттерн Singleton
     */
    protected static $instance;

    /**
     * @var array Массив конфигураций
     */
    protected $config;

    /**
     * @var array Массив привязок названий сервисов и фабрик, которые умеют создавать экземпляры этих сервисов
     */
    protected $components = [];

    /**
     * @var array Массив экземпляров сервисов.
     * При создании нового сервиса, экземпляр попадает в этот массив с ключом, который указан в конфиге
     */
    protected $instances = [];

    protected $logger;

    protected $path = '/var/log/log.log';

    /**
     * Метод для получения экземпляра приложения.
     * Паттерн Singleton
     *
     * @param array $config
     * @param LoggerInterface|null $logger
     * @return Application
     */
    public static function getInstance($config = [])//, LoggerInterface $logger = null)
    {
        if (self::$instance === null) {
            self::$instance = new self($config);//, $logger);
        }

        return self::$instance;
    }

    /**
     * Application constructor.
     *
     * @param array $config Массив конфигураций
     * @param LoggerInterface|null $logger
     */
    protected function __construct($config = [])//, LoggerInterface $logger = null)
    {
        $this->config = $config;
        //$this->logger = $logger;
        $this->logger = Logger::getInstance();

        $this->logger->info("class Application. construct");

        $this->bootstrap();
    }

    /**
     * Метод начальной загрузки приложения.
     * В настоящий момент здесь происходит привязка имени сервиса с фабрикой, которая умеет создавать экземпляр севриса
     */
    public function bootstrap()
    {
        if (!empty($this->config['components'])) {
            $this->logger->info("class Application. bootstrap");
            // Перебираем массив сервисов из конфига и разбиаем каждый сервис - проверяем есть ли у него фабрика
            foreach ($this->config['components'] as $key => $item) {
                if (isset($item['logger']) && class_exists('logger'))
                {

                }
                if (isset($item['factory']) && class_exists($item['factory'])) {
                    // Здесь мы не создаем обьекты, а лишь добавляем привязку имени сервиса и фабрики
                    $this->components[$key] = $item['factory'];
                }
            }
        }
    }

    /**
     * Метод контейнера, который умеет по имени сервиса создавать и/или возвращать уже готовый экземпляр сервиса
     *
     * @param $name
     * @return mixed|null
     */
    public function get($name)
    {
        $this->logger->info("class Application. get");
        // Если экземпляр севриса уже был ранее создан, просто достаем его из контейнера и возвращаем
        if (isset($this->instances[$name])) {
            return $this->instances[$name];
        }

        // Если это первое обращение к сервису, проверяем есть ли для указанного имени привязка с фабрикой
        // Если такая привязка есть в массиве components, создаем фабрику и запускаем ее метод создания экземпляра
        if (array_key_exists($name, $this->components)) {
            // Здесь испоьзуется паттерн Фабричный метод
            // Все классы фабрик наследуют абстрактный класс, у которого есть метод createInstance
            $factory = new $this->components[$name];
            $instance = $factory->createInstance();

            // Вновь созданный экземпляр сервиса добавляем в массив instances
            // Из этого массива будет доставаться уже готовый экземпляр при следующих обращениях к севрису
            $this->instances[$name] = $instance;

            return $instance;
        }

        return null;
    }

    /**
     * Метод проверяет есть ли зарегистрированный или уже созданный сервис в контейнере
     *
     * @param $name
     * @return bool
     */
    public function has($name)
    {
        $this->logger->info("class Application. has");
        // Сначала проверяем есть ли уже готовый экземпляр севриса по его имени, если есть возвращаем true
        if (isset($this->instances[$name])) {
            return true;
        }

        // Проверяем есть ли зарегистрированная привязка по имени, если есть возвращаем true
        if (isset($this->components[$name])) {
            return true;
        }

        // В случае если дошли до этого момента, значит ни экземпляра нет ни привязки нет
        $this->logger->warning("class Application. has no object");
        return false;
    }

    /**
     * Метод ля запуска приложения
     */
    public function run()
    {
        $this->logger->info("run");
        // Получаем с контейнера севрис router, запускаем роутинг и вызываем функцию, которую вернет роутер
        $router = $this->get('router');
        if ($action = $router->route()) {
            $action();
        }
    }
}