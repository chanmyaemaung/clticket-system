<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketResource\Pages;
use App\Filament\Resources\TicketResource\RelationManagers;
use App\Models\Ticket;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                TextInput::make('title')
                    ->label(__('Title'))
                    ->required()
                    ->autofocus(),
                Textarea::make('description')
                    ->label(__('Description'))
                    ->rows(3),
                Select::make('status')
                    ->label(__('Status'))
                    ->options(Ticket::STATUS)
                    ->required(),
                Select::make('priority')
                    ->label(__('Priority'))
                    ->options(Ticket::PRIORITY)
                    ->required(),
                Select::make('assigned_to')
                    ->relationship('assignedTo', 'name'),
                Textarea::make('comment')
                    ->label(__('Comment'))
                    ->rows(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('Title'))
                    ->description(fn (Ticket $record): string => $record->description)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->label(__('Status'))
                    ->badge(),
                TextColumn::make('priority')
                    ->label(__('Priority'))
                    ->badge(),
                TextColumn::make('assignedTo.name')
                    ->label(__('Assigned To'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('assignedBy.name')
                    ->label(__('Assigned By'))
                    ->searchable()
                    ->sortable(),
                TextInputColumn::make('comment')
                    ->label(__('Comment'))


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
