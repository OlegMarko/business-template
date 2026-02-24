<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->helperText('URL-friendly version. Leave empty when creating to auto-generate from title.'),
                RichEditor::make('content')
                    ->required()
                    ->json(false)
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'strike',
                        'link',
                        'h2',
                        'h3',
                        'bulletList',
                        'orderedList',
                        'blockquote',
                    ]),
                DateTimePicker::make('published_at')
                    ->label('Published at')
                    ->nullable()
                    ->helperText('Leave empty to keep as draft. Set a date to publish.'),
                Section::make('SEO')
                    ->schema([
                        TextInput::make('meta_title')
                            ->label('Meta title')
                            ->maxLength(70)
                            ->helperText('Optional. Defaults to post title. 50–70 characters recommended.'),
                        Textarea::make('meta_description')
                            ->label('Meta description')
                            ->rows(2)
                            ->maxLength(320)
                            ->helperText('Optional. For search results and social sharing. 150–320 characters recommended.'),
                        FileUpload::make('og_image')
                            ->label('Social sharing image (Open Graph)')
                            ->image()
                            ->disk('public')
                            ->directory('og/posts')
                            ->visibility('public')
                            ->imagePreviewHeight('120')
                            ->maxSize(2048)
                            ->helperText('Optional. Recommended: 1200×630 px.')
                            ->saveUploadedFileUsing(function (FileUpload $component, TemporaryUploadedFile $file): ?string {
                                Storage::disk('public')->makeDirectory('og/posts');
                                $filename = Str::ulid() . '.' . ($file->getClientOriginalExtension() ?: 'jpg');
                                $path = $file->storeAs('og/posts', $filename, ['disk' => 'public']);
                                return $path ?: null;
                            }),
                    ])
                    ->collapsed(),
            ]);
    }
}
