<?php declare(strict_types=1);

namespace App\Repositories\Proxy;

use App\Repositories\CoreRepository;

abstract class CoreRepositoryProxy
{

    private CoreRepository $repository;

    public function __construct()
    {
        $this->repository = app($this->getRepositoryClass());
    }

    /**
     * @return CoreRepository
     */
    protected function startConditions(): CoreRepository
    {
        return clone $this->repository;
    }

    /**
     * @return string Return repository class.
     */
    abstract protected function getRepositoryClass(): string;
}
