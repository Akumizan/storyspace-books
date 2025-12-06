<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'judul' => 'Atomic Habits - James Clear',
                'penulis' => 'James Clear',
                'harga' => 51000,
                'gambar' => 'books/buku1.jpg',
                'deskripsi' => 'Buku tentang membangun kebiasaan baik dan menghilangkan kebiasaan buruk.'
            ],
            [
                'judul' => 'Deep Work - Cal Newport',
                'penulis' => 'Cal Newport',
                'harga' => 52000,
                'gambar' => 'books/buku2.jpg',
                'deskripsi' => 'Rules for Focused Success in a Distracted World.'
            ],
            [
                'judul' => 'Making Learning Whole - David Perkins',
                'penulis' => 'David Perkins',
                'harga' => 53000,
                'gambar' => 'books/buku3.jpg',
                'deskripsi' => 'Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum.'
            ],
            [
                'judul' => 'Range - David Epstein',
                'penulis' => 'David Epstein',
                'harga' => 50000,
                'gambar' => 'books/buku4.jpg',
                'deskripsi' => 'Praesent mauris. Fusce nec tellus sed augue semper porta.'
            ],
            [
                'judul' => 'AI and Machine Learning for Coders',
                'penulis' => 'Various',
                'harga' => 50000,
                'gambar' => 'books/buku5.jpg',
                'deskripsi' => 'Mauris massa. Vestibulum lacinia arcu eget nulla.'
            ],
            [
                'judul' => 'Web Scalability for Startup Engineers',
                'penulis' => 'Artur Ejsmont',
                'harga' => 50000,
                'gambar' => 'books/buku6.jpg',
                'deskripsi' => 'Class aptent taciti sociosqu ad litora torquent per conubia nostra.'
            ],
            [
                'judul' => 'Hello - Tere Liye',
                'penulis' => 'Tere Liye',
                'harga' => 55000,
                'gambar' => 'books/buku7.jpg',
                'deskripsi' => 'Per inceptos himenaeos. Curabitur sodales ligula in libero.'
            ],
            [
                'judul' => 'Bulan - Tere Liye',
                'penulis' => 'Tere Liye',
                'harga' => 60000,
                'gambar' => 'books/buku8.jpg',
                'deskripsi' => 'Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh.'
            ],
            [
                'judul' => 'Hujan - Tere Liye',
                'penulis' => 'Tere Liye',
                'harga' => 65000,
                'gambar' => 'books/buku9.jpg',
                'deskripsi' => 'Aenean quam. In scelerisque sem at dolor. Maecenas mattis.'
            ],
            [
                'judul' => 'Negeri Para Bedebah - Tere Liye',
                'penulis' => 'Tere Liye',
                'harga' => 70000,
                'gambar' => 'books/buku10.jpg',
                'deskripsi' => 'Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor.'
            ],
            [
                'judul' => 'Yang Telah Lama Pergi - Tere Liye',
                'penulis' => 'Tere Liye',
                'harga' => 75000,
                'gambar' => 'books/buku11.jpg',
                'deskripsi' => 'Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa.'
            ],
            [
                'judul' => 'Sebelas - Tere Liye',
                'penulis' => 'Tere Liye',
                'harga' => 80000,
                'gambar' => 'books/buku12.jpg',
                'deskripsi' => 'Fusce ac turpis quis ligula lacinia aliquet. Mauris ipsum.'
            ],
        ];
        
        foreach ($books as $book) {
            Book::create($book);
        }
        
        echo "12 books seeded successfully!\n";
    }
}