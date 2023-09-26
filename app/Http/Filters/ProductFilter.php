<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter
{
    public const CATEGORIES = 'categories';
    public const COLORS = 'colors';
    public const TAGS = 'tags';
    public const PRICES = 'prices';
    public const TITLE = 'title';

    /**
     * @return array[]
     */
    protected function getCallbacks(): array
    {
        return [
            self::CATEGORIES => [$this, self::CATEGORIES],
            self::COLORS => [$this, self::COLORS],
            self::TAGS => [$this, self::TAGS],
            self::PRICES => [$this, self::PRICES],
            self::TITLE => [$this, self::TITLE],
        ];
    }

    /**
     * @param Builder $builder
     * @param array $value
     * @return void
     */
    public function categories(Builder $builder, array $value): void
    {
        if ($value !== []) {
            $builder->whereIn('category_id', $value);
        }
    }

    /**
     * @param Builder $builder
     * @param array $value
     * @return void
     */
    public function colors(Builder $builder, array $value): void
    {
        if ($value !== []) {
            $builder->whereHas('colors', function ($query) use ($value) {
                $query->whereIn('colors.id', $value);
            });
        }
    }

    /**
     * @param Builder $builder
     * @param array $value
     * @return void
     */
    public function tags(Builder $builder, array $value): void
    {
        if ($value !== []) {
            $builder->whereHas('tags', function ($query) use ($value) {
                $query->whereIn('tags.id', $value);
            });
        }
    }

    /**
     * @param Builder $builder
     * @param array $value
     * @return void
     */
    public function prices(Builder $builder, array $value): void
    {
        if ($value !== []) {
            $builder->whereBetween('price', $value);
        }
    }

    public function title(Builder $builder, ?string $value): void
    {
        if ($value !== null)
        {
            $builder->where('title', 'like', "%$value%");
        }
    }
}
