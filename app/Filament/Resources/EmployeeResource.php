<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'RH';
    protected static ?string $navigationLabel = 'Employés';
    protected static ?string $pluralModelLabel = 'Employés';
    protected static ?string $modelLabel = 'Employé';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('first_name')
                ->label('Prénom')
                ->placeholder('Saisir le prénom')
                ->required()
                ->maxLength(100),

            Forms\Components\TextInput::make('last_name')
                ->label('Nom')
                ->placeholder('Saisir le nom')
                ->required()
                ->maxLength(100),

            Forms\Components\TextInput::make('email')
                ->label('E-mail')
                ->placeholder('prenom.nom@entreprise.fr')
                ->email()
                ->required()
                ->unique(ignoreRecord: true),

            Forms\Components\DatePicker::make('hire_date')
                ->label("Date d'embauche")
                ->native(false),

            Forms\Components\Select::make('contract_type')
                ->label('Type de contrat')
                ->options([
                    'CDI' => 'CDI',
                    'CDD' => 'CDD',
                    'Freelance' => 'Freelance',
                    'Stage' => 'Stage',
                ])
                ->native(false),

            Forms\Components\TextInput::make('base_salary')
                ->label('Salaire de base (€)')
                ->numeric()
                ->prefix('€')
                ->rule('decimal:0,2'),

            Forms\Components\TextInput::make('weekly_hours')
                ->label('Heures / semaine')
                ->numeric()
                ->minValue(1)
                ->maxValue(48),

            Forms\Components\TextInput::make('matricule')
                ->label('Matricule')
                ->placeholder('EMP-00001')
                ->unique(ignoreRecord: true),

            Forms\Components\Textarea::make('meta.note')
                ->label('Notes')
                ->rows(3)
                ->columnSpanFull(),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('last_name')->label('Nom')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('first_name')->label('Prénom')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email')->label('E-mail')->searchable(),
                Tables\Columns\TextColumn::make('contract_type')->label('Contrat')->badge(),
                Tables\Columns\TextColumn::make('hire_date')->label("Date d'embauche")->date(),
                Tables\Columns\TextColumn::make('base_salary')->label('Salaire (€)')->money('EUR', true),
                Tables\Columns\TextColumn::make('weekly_hours')->label('Heures/sem.'),
                Tables\Columns\TextColumn::make('matricule')->label('Matricule')->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label('Créé')->since(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make()->label('Modifier'),
                Tables\Actions\DeleteAction::make()->label('Supprimer'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Supprimer la sélection'),
                ]),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/creer'),
            'edit'   => Pages\EditEmployee::route('/{record}/modifier'),
        ];
    }    
}
