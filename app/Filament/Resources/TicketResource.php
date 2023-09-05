<?php

namespace App\Filament\Resources;
use App\Filament\Resources\TicketResource\Pages;
use App\Models\Ticket;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;

use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Columns\IconColumn;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $slug = 'tickets';
    protected static ?string $navigationGroup = 'Servicios';
    protected static ?string $navigationLabel = 'Tickets';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                TextInput::make('title')
                ->required()
                ->label('Titulo'),

                Select::make('status')
                ->options(self::$model::STATUS)
                ->label('Estado')
                ->required()
                ->placeholder('Escoge una opción'),

                Select::make('priority')
                ->options(self::$model::PRIORITY)
                ->label('Prioridad')
                ->required()
                ->placeholder('Escoge una opción'),

                Select::make('assigned_to')
                ->relationship('assignedTo', 'name')
                ->required()
                ->label('Asignar a')
                ->placeholder('Escoge una opción'),

                Textarea::make('description')
                ->nullable()
                ->label('Descripción'),

                Textarea::make('comment')
                ->nullable()
                ->label('Comentarios'),

               
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
                ->emptyStateHeading("Aún no hay publicaciones.")
                ->emptyStateDescription('Crea un ticket para empezar.')
            ->columns([
                TextColumn::make('title')
                ->searchable()
                ->label('Titulo')
                ->limit(20),

                TextColumn::make('status')
                ->badge()
                ->colors([
                    'gray'  => fn ($state): bool => $state === 'Archivado',
                    'success'  => fn ($state): bool => $state === 'Cerrado',
                    'warning'  => fn ($state): bool => $state === 'Abierto',
                ])
                ->sortable()
                ->searchable()
                ->label('Estado'),


                TextColumn::make('priority')
                ->sortable()
                ->label('Prioridad'),

                TextColumn::make('assignedTo.name')
                ->sortable()
                ->label('Asignado a'),

                TextColumn::make('assignedBy.name')
                ->toggleable(isToggledHiddenByDefault: false)
                ->sortable()
                ->label('Asignado por'),

                TextInputColumn::make('comment')
                ->toggleable(isToggledHiddenByDefault: false)
                ->searchable()
                ->label('Comentario'),

                
            ])
            ->filters([
                //
            ])
            ->toggleColumnsTriggerAction(
                fn (Action $action) => $action
                    ->button()
                    ->label('Ocultar columnas'),
            )
            ->actions([
                Tables\Actions\EditAction::make()
              ->label('Editar'),

              Action::make('delete')
              ->label('Eliminar')
              ->requiresConfirmation()
              ->action(fn (Ticket $record) => $record->delete())
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
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }    
}
