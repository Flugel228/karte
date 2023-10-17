<?php declare(strict_types=1);

namespace App\Strategy\Repositories\Proxy;

use App\Strategy\Repositories\Proxy\Interfaces\CacheStrategyInterface;
use Illuminate\Database\Eloquent\Model;

class CacheManager
{
    /**
     * @var CacheStrategyInterface Strategy class that will be used for caching
     */
    private CacheStrategyInterface $cacheStrategy;

    /**
     * @var string Type of the object to be worked with.
     * The strategy type is the name of the strategy without the word Strategy.
     */
    private string $type;

    /**
     * @var int ID of the model we are working with.
     */
    private int $id;

    /**
     * @var mixed Some additional data for greater flexibility when using strategy.
     */
    private mixed $additional;

    public function __construct(string $type, int $id, mixed $additional = null)
    {
        $this->type = $type;
        $this->id = $id;
        $this->additional = $additional;
    }

    public function handle(): void
    {
        $this->cacheUpdatedData();
    }

    private function cacheUpdatedData(): void
    {
        $id = $this->getId();
        $additional = $this->getAdditional();
        $strategy = $this->getStrategyByType();
        $this->setCacheStrategy($strategy)
            ->cache($id, $additional);
    }

    private function getStrategyByType(): CacheStrategyInterface
    {
        $strategyName = $this->getType() . 'Strategy';
        $strategyClass = __NAMESPACE__ . '\\Strategies\\' . $strategyName;

        throw_if(!class_exists($strategyClass), \Exception::class,
            "Class [{$strategyClass}] does not exist");

        return new $strategyClass;
    }

    private function cache(int $id, mixed $additional): void
    {
        $this->getCacheStrategy()->cache($id, $additional);
    }

    public function setCacheStrategy(CacheStrategyInterface $strategy): static
    {
        $this->cacheStrategy = $strategy;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getCacheStrategy(): CacheStrategyInterface
    {
        return $this->cacheStrategy;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getAdditional(): mixed
    {
        return $this->additional;
    }
}
