<?php

namespace App\Container;

use App\Core\Container;
use App\Filter\AgeFilter;
use App\Filter\CapitalizeFilter;
use App\Filter\DayFilter;
use App\Filter\LastConnectionFilter;
use App\Filter\MonthFilter;
use App\Filter\YearFilter;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Twig_SimpleFilter;

class TwigContainer extends Container
{
    const VIEW_DIRECTORY = __DIR__.'/../../view';

    /**
     * @var array
     */
    private $twigOptions = [
        'debug' => true,
        'cache' => false,
    ];

    /**
     * @var array
     */
    private $filters = [
        'age' => AgeFilter::class,
        'ucwords' => CapitalizeFilter::class,
        'day' => DayFilter::class,
        'lastConnection' => LastConnectionFilter::class,
        'month' => MonthFilter::class,
        'year' => YearFilter::class,
    ];

    /**
     * @return Twig
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    public function __invoke(): Twig
    {
        $twig = new Twig(self::VIEW_DIRECTORY, $this->twigOptions);

        $twig->addExtension($this->getRouterExtension());

        $twigFilters = $this->getTwigFilters();
        foreach ($twigFilters as $filter) {
            $twig->getEnvironment()->addFilter($filter);
        }

        return $twig;
    }

    /**
     * @return TwigExtension
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    private function getRouterExtension(): TwigExtension
    {
        return new TwigExtension(
            $this->container->get('router'),
            $this->getBasePath()
        );
    }

    /**
     * @return string
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function getBasePath(): string
    {
        $plain = $this->container->get('request')->getUri()->getBasePath();
        $replaced = str_ireplace('index.php', '', $plain);
        $trimmed = rtrim($replaced);

        return $trimmed;
    }

    /**
     * @return array
     */
    private function getTwigFilters(): array
    {
        $twigFilters = [];

        foreach ($this->filters as $name => $filter) {
            $twigFilters[] = new Twig_SimpleFilter($name, $filter);
        }

        return $twigFilters;
    }
}