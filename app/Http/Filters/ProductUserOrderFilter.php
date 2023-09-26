<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProductUserOrderFilter extends AbstractFilter
{
    public const USER_ID = 'user_id';

    /**
     * @return array[]
     */
    protected function getCallbacks(): array
    {
        return [
            self::USER_ID => [$this, self::USER_ID],
        ];
    }

    /**
     * @param Builder $builder
     * @param int $value
     * @return void
     */
    public function user_id(Builder $builder, int $value): void
    {
        $builder->where('user_id', '=', $value);
    }
}
