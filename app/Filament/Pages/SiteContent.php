<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Concerns\CanUseDatabaseTransactions;
use Filament\Pages\Page;
use Filament\Panel;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Alignment;
use Filament\Support\Exceptions\Halt;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Throwable;
use UnitEnum;

class SiteContent extends Page
{
    use CanUseDatabaseTransactions;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string|UnitEnum|null $navigationGroup = 'Site content';

    protected static ?int $navigationSort = 0;

    /**
     * @var array<string, mixed>|null
     */
    public ?array $data = [];

    public static function getNavigationLabel(): string
    {
        return 'Site content';
    }

    public function getTitle(): string|Htmlable
    {
        return 'Site content';
    }

    public static function getSlug(?Panel $panel = null): string
    {
        return 'site-content';
    }

    public function mount(): void
    {
        $this->fillForm();
    }

    protected function fillForm(): void
    {
        $keys = [
            'site_name',
            'primary_color',
            'hero_image',
            'home_hero_title',
            'home_hero_description',
            'about_content',
            'services_intro',
            'privacy_content',
        ];
        $settings = SiteSetting::getMany($keys);
        $this->form->fill($settings);
    }

    public function defaultForm(Schema $schema): Schema
    {
        return $schema->statePath('data');
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Content')
                    ->tabs([
                        Tab::make('General')
                            ->schema([
                                Section::make('Site')
                                    ->schema([
                                        TextInput::make('site_name')
                                            ->label('Site name')
                                            ->required()
                                            ->maxLength(255),
                                        ColorPicker::make('primary_color')
                                            ->label('Primary color')
                                            ->default('#0d9488')
                                            ->helperText('Brand color used for buttons, links, and accents.'),
                                    ]),
                            ]),
                        Tab::make('Home page')
                            ->schema([
                                Section::make('Hero')
                                    ->schema([
                                        FileUpload::make('hero_image')
                                            ->label('Hero image')
                                            ->image()
                                            ->disk('public')
                                            ->directory('hero')
                                            ->visibility('public')
                                            ->imagePreviewHeight('200')
                                            ->maxSize(10240)
                                            ->helperText('Main full-width image on the home page. Recommended: wide landscape, min. 1200px width. Max 10MB.')
                                            ->saveUploadedFileUsing(function (FileUpload $component, TemporaryUploadedFile $file): ?string {
                                                Storage::disk('public')->makeDirectory('hero');
                                                $filename = Str::ulid() . '.' . ($file->getClientOriginalExtension() ?: 'jpg');
                                                $path = $file->storeAs('hero', $filename, ['disk' => 'public']);
                                                return $path ?: null;
                                            }),
                                        TextInput::make('home_hero_title')
                                            ->label('Hero headline')
                                            ->required()
                                            ->maxLength(255),
                                        RichEditor::make('home_hero_description')
                                            ->label('Hero description')
                                            ->required()
                                            ->json(false)
                                            ->toolbarButtons([
                                                'bold',
                                                'italic',
                                                'link',
                                                'bulletList',
                                                'orderedList',
                                            ]),
                                    ]),
                                Section::make('Why work with us')
                                    ->description('Edit blocks in the "Home blocks" resource (sidebar).'),
                            ]),
                        Tab::make('About')
                            ->schema([
                                Section::make('About us')
                                    ->schema([
                                        RichEditor::make('about_content')
                                            ->label('About page content')
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
                                    ]),
                            ]),
                        Tab::make('Services')
                            ->schema([
                                Section::make('Services page')
                                    ->schema([
                                        RichEditor::make('services_intro')
                                            ->label('Intro paragraph')
                                            ->json(false)
                                            ->toolbarButtons([
                                                'bold',
                                                'italic',
                                                'link',
                                                'bulletList',
                                                'orderedList',
                                            ]),
                                    ])
                                    ->description('Service items are managed in the "Services" resource (sidebar).'),
                            ]),
                        Tab::make('Privacy')
                            ->schema([
                                Section::make('Privacy Policy')
                                    ->schema([
                                        RichEditor::make('privacy_content')
                                            ->label('Privacy policy content')
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
                                    ]),
                            ]),
                    ]),
            ]);
    }

    public function save(): void
    {
        try {
            $this->beginDatabaseTransaction();

            $this->callHook('beforeValidate');
            $data = $this->form->getState();
            $this->callHook('afterValidate');

            foreach ($data as $key => $value) {
                if (is_array($value)) {
                    $value = $value[0] ?? '';
                }
                SiteSetting::set($key, (string) $value);
            }

            $this->callHook('afterSave');
        } catch (Halt $exception) {
            $this->rollBackDatabaseTransaction();
            return;
        } catch (Throwable $exception) {
            $this->rollBackDatabaseTransaction();
            throw $exception;
        }

        $this->commitDatabaseTransaction();

        Notification::make()
            ->success()
            ->title('Site content saved.')
            ->send();
    }

    /**
     * @return array<Action>
     */
    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save')
                ->submit('save')
                ->keyBindings(['mod+s']),
        ];
    }

    public function getFormActionsAlignment(): string | Alignment
    {
        return Alignment::Start;
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                Form::make([EmbeddedSchema::make('form')])
                    ->id('form')
                    ->livewireSubmitHandler('save')
                    ->footer([
                        Actions::make($this->getFormActions())
                            ->alignment($this->getFormActionsAlignment())
                            ->key('form-actions'),
                    ]),
            ]);
    }
}
