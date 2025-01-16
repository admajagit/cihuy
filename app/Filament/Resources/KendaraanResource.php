<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Kendaraan;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextInputColumn;
use App\Filament\Resources\KendaraanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KendaraanResource\RelationManagers;

class KendaraanResource extends Resource
{
    protected static ?string $model = Kendaraan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('jenis_mobil'),
                TextInput::make('nomor_plat'),
                TextInput::make('tahun_pembuatan'),
                TextInput::make('status_ketersediaan'),
                FileUpload::make('gambar') // Menambahkan input gambar
                ->image() // Hanya menerima file gambar
                ->disk('public') // Menyimpan file di disk 'public' // Menyimpan file dalam direktori 'kendaraans'
                ->nullable(), // Kolom gambar bersifat opsional
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('jenis_mobil'),
                TextColumn::make('nomor_plat'),
                TextColumn::make('tahun_pembuatan'),
                TextColumn::make('status_ketersediaan'),
                ImageColumn::make('gambar') // Menampilkan gambar
    ->disk('public') // Lokasi disk tempat gambar disimpan
    ->label('Gambar') // Label kolom
    ->width(50) // Lebar gambar dalam tampilan
    ->height(50),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListKendaraans::route('/'),
            'create' => Pages\CreateKendaraan::route('/create'),
            'edit' => Pages\EditKendaraan::route('/{record}/edit'),
        ];
    }
}
