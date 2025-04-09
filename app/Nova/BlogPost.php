<?php

namespace App\Nova;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\ActionRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Marshmallow\Tiptap\Tiptap;
use Spatie\TagsField\Tags;

class BlogPost extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\BlogPost>
     */
    public static $model = \App\Models\BlogPost::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * Indicates if the resource should be displayed in the sidebar.
     *
     * @var bool
     */
    public static $displayInNavigation = false;

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'title', 'slug', 'description', 'content',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array<int, \Laravel\Nova\Fields\Field>
     */
    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),

            Text::make('Title')
                ->required()
                ->rules('required', 'max:255')
                ->sortable(),

            Slug::make('Slug')
                ->from('Title')
                ->rules('required', 'max:255')
                ->creationRules('unique:blog_posts')
                ->updateRules('unique:blog_posts,{{resourceId}}')
                ->sortable(),

            Textarea::make('Description')
                ->alwaysShow(),

            Tiptap::make('Content')
                ->buttons([
                    'heading',
                    'italic',
                    'bold',
                    'link',
                    'code',
                    'strike',
                    'underline',
                    'highlight',
                    'bulletList',
                    'orderedList',
                    'br',
                    'codeBlock',
                    'blockquote',
                    'horizontalRule',
                    'hardBreak',
                    'table',
                    'image',
                    'textAlign',
                    'history',
                ])
                ->linkSettings([
                    'withFileUpload' => false,
                ])
                ->syntaxHighlighting()
                ->showOnDetail(),

            Image::make('Image')
                ->hideFromIndex()
                ->nullable()
                ->prunable(),

            Tags::make('Tags'),

            BelongsTo::make('User')
                ->onlyOnDetail()
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            BelongsTo::make('Author')
                ->rules('required'),

            BelongsTo::make('Blog')
                ->rules('required'),

            DateTime::make('Published at')
                ->hideFromIndex()
                ->readonly(),
        ];
    }

    /**
     * Get the cards available for the resource.
     *
     * @return array<int, \Laravel\Nova\Card>
     */
    public function cards(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array<int, \Laravel\Nova\Filters\Filter>
     */
    public function filters(NovaRequest $request): array
    {
        return [
            new Filters\Visibility,
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @return array<int, \Laravel\Nova\Lenses\Lens>
     */
    public function lenses(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array<int, \Laravel\Nova\Actions\Action>
     */
    public function actions(NovaRequest $request): array
    {
        return [
            (new Actions\Publish)
                ->onlyOnDetail()
                ->canSee(function ($request) {
                    // See issue https://github.com/laravel/nova-issues/issues/2221
                    return $request instanceof ActionRequest || !$this->resource->isPublished();
                })
                ->confirmText('Are you sure you want to publish this article(s)?')
                ->confirmButtonText('Publish')
                ->size('md'),

            (new Actions\Unpublish)
                ->onlyOnDetail()
                ->canSee(function ($request) {
                    return $request instanceof ActionRequest || $this->resource->isPublished();
                })
                ->confirmText('Are you sure you want to publish this article(s)?')
                ->confirmButtonText('Unpublish')
                ->size('md'),
        ];
    }
}
