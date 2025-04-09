<?php

namespace App\Nova\Filters;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Http\Requests\NovaRequest;

class Visibility extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    /**
     * The displayable name of the filter.
     *
     * @var \Stringable|string
     */
    public $name = 'Visibility';

    /**
     * Apply the filter to the given query.
     */
    public function apply(NovaRequest $request, Builder $query, mixed $value): Builder
    {
        if ($value === 'published') {
            return $query->whereNotNull('published_at');
        }

        if ($value === 'unpublished') {
            return $query->whereNull('published_at');
        }

        return $query;
    }

    /**
     * Get the filter's available options.
     *
     * @return array<string, string>
     */
    public function options(NovaRequest $request): array
    {
        return [
            'Published' => 'published',
            'Unpublished' => 'unpublished',
        ];
    }
}
