<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InstallationResource\Pages;
use App\Filament\Resources\InstallationResource\RelationManagers;
use App\Models\Installation;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InstallationResource extends Resource
{
    protected static ?string $model = Installation::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static ?string $slug = 'instalaciones';
    protected static ?string $navigationLabel = 'Instalaciones';
    protected static ?string $navigationGroup = 'Servicios';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // TextInput::make('installation_date')
                // ->required()
                // ->maxLength(255)
                // ->label('Fecha de instalación'),

                DatePicker::make('installation_date')
                ->prefixIcon('heroicon-m-play')
                ->timezone('America/Bogota')
                ->required()
                ->label('Fecha de instalación'),

                TextInput::make('speed')
                ->required()
                ->maxLength(255)
                ->label('Velocidad'),

                Select::make('plan_plans_id')
                ->Relationship('plans','name')
                ->required()
                ->label('Plan')
                ->placeholder('Escoge una opción'),

                TextInput::make('address')
                ->required()
                ->maxLength(255)
                ->label('Dirección'),

                TextInput::make('neighborhood')
                ->required()
                ->maxLength(255)
                ->label('Barrio'),

                Select::make('client_id')
                ->Relationship('clients','name')
                ->required()
                ->placeholder('Escoge una opción')
                ->label('Cliente'),

                TextInput::make('wifi')
                ->required()
                ->maxLength(255)
                ->label('Wifi'),

                TextInput::make('wifi_password')
                ->required()
                ->maxLength(255)
                ->label('Contraseña Wifi'),

                TextInput::make('ppoe')
                ->required()
                ->maxLength(255)
                ->label('PPOE'),

                TextInput::make('ppoe_password')
                ->required()
                ->maxLength(255)
                ->label('Contraseña PPOE'),
                
                TextInput::make('ip')
                ->required()
                ->maxLength(255)
                ->label('IP'),

                Select::make('device_id')
                ->Relationship('devices','brand')
                ->required()
                ->placeholder('Escoge una opción')
                ->label('Equipo'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading("Aún no hay publicaciones.")
            ->emptyStateDescription('Crea una instalación para empezar.')
            ->columns([
                TextColumn::make('installation_date')
                ->wrap()
                ->sortable()
                ->label('Fecha instalación'),

                TextColumn::make('speed')
                ->wrap()
                ->sortable()
                ->label('Velocidad'),

                TextColumn::make('plans.name')
                ->wrap()
                ->sortable()
                ->label('Plan'),

                TextColumn::make('address')
                ->wrap()
                ->sortable()
                ->label('Dirección'),

                TextColumn::make('neighborhood')
                ->wrap()
                ->sortable()
                ->label('Barrio'),

                TextColumn::make('clients.name')
                ->wrap()
                ->sortable()
                ->label('Cliente'),

                TextColumn::make('wifi')
                ->sortable()
                ->label('Wifi'),

                TextColumn::make('wifi_password')
                ->sortable()
                ->label('Contraseña Wifi'),

                textColumn::make('ppoe')
                ->sortable()
                ->label('PPOE'),

                TextColumn::make('ppoe_password')
                ->sortable()
                ->label('Contraseña PPOE'),

                TextColumn::make('ip')
                ->sortable()
                ->label('IP'),

                TextColumn::make('devices.brand')
                ->wrap()
                ->sortable()
                ->label('Equipo'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
              ->label('Editar'),

              Action::make('delete')
              ->label('Eliminar')
              ->requiresConfirmation()
              ->action(fn (Installation $record) => $record->delete())
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListInstallations::route('/'),
            'create' => Pages\CreateInstallation::route('/create'),
            'edit' => Pages\EditInstallation::route('/{record}/edit'),
        ];
    }    
}
