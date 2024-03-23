<?php

namespace App\Filament\Staff\Resources\ProjectResource\RelationManagers;

use App\Models\ProjectFile;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class FilesRelationManager extends RelationManager
{
    protected static string $relationship = 'files';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('student.name')
                    ->label('Uploaded By'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Uploaded At'),
            ])
            ->actions([
                Tables\Actions\Action::make('downloadFileAction')
                    ->label('Download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(function (ProjectFile $record) {
                        return response()->streamDownload(function () use ($record) {
                            echo Storage::disk($record->storage_disk)->get($record->storage_path);
                        }, $record->name);
                    }),
            ])
            ->bulkActions([
            ]);
    }
}
