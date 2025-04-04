<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['Books', 'A collection of printed and digital books.', 'assets/images/no_img.png', null],
            ['Scholar Books', 'Educational books for students and professionals.', 'assets/images/no_img.png', null],
            ['Stationery', 'All office and school supplies.', 'assets/images/no_img.png', null],
            ['Children’s Section', 'Books and materials for kids.', 'assets/images/no_img.png', null],
            ['Magazines & Newspapers', 'Latest publications and newspapers.', 'assets/images/no_img.png', null],
            ['E-Books & Digital Media', 'Digital content including PDFs and audiobooks.', 'assets/images/no_img.png', null],
        ];

        $categoryIds = [];

        foreach ($categories as $category) {
            $id = DB::table('categories')->insertGetId([
                'name' => $category[0],
                'description' => $category[1],
                'image' => $category[2],
                'parent_id' => $category[3],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $categoryIds[$category[0]] = $id;
        }

        $subcategories = [
            ['Fiction', 'Novels and literary works.', 'assets/images/no_img.png', $categoryIds['Books']],
            ['Non-Fiction', 'Biographies, history, and true stories.', 'assets/images/no_img.png', $categoryIds['Books']],
            ['Mystery & Thriller', 'Crime and suspense stories.', 'assets/images/no_img.png', $categoryIds['Books']],
            ['Science Fiction & Fantasy', 'Futuristic and imaginative stories.', 'assets/images/no_img.png', $categoryIds['Books']],
            ['Romance', 'Love and relationship-based stories.', 'assets/images/no_img.png', $categoryIds['Books']],
            ['Historical', 'Books based on historical events.', 'assets/images/no_img.png', $categoryIds['Books']],
            ['Self-Help', 'Motivational and personal growth books.', 'assets/images/no_img.png', $categoryIds['Books']],
            ['Biography & Memoir', 'Life stories of famous people.', 'assets/images/no_img.png', $categoryIds['Books']],
            ['Religion & Spirituality', 'Books on different faiths.', 'assets/images/no_img.png', $categoryIds['Books']],

            ['Mathematics', 'Algebra, calculus, and statistics.', 'assets/images/no_img.png', $categoryIds['Scholar Books']],
            ['Science', 'Physics, chemistry, and biology.', 'assets/images/no_img.png', $categoryIds['Scholar Books']],
            ['Engineering', 'Civil, mechanical, and electrical books.', 'assets/images/no_img.png', $categoryIds['Scholar Books']],
            ['Medicine & Health', 'Books on medical science and health.', 'assets/images/no_img.png', $categoryIds['Scholar Books']],
            ['Business & Economics', 'Finance and management books.', 'assets/images/no_img.png', $categoryIds['Scholar Books']],
            ['Humanities', 'History, philosophy, and sociology.', 'assets/images/no_img.png', $categoryIds['Scholar Books']],
            ['Law', 'Legal books and case studies.', 'assets/images/no_img.png', $categoryIds['Scholar Books']],
            ['Computer Science & IT', 'Programming and software development.', 'assets/images/no_img.png', $categoryIds['Scholar Books']],

            ['Notebooks & Diaries', 'Journals, planners, and diaries.', 'assets/images/no_img.png', $categoryIds['Stationery']],
            ['Pens & Pencils', 'Ballpoint, gel pens, and mechanical pencils.', 'assets/images/no_img.png', $categoryIds['Stationery']],
            ['Markers & Highlighters', 'Colored markers for notes.', 'assets/images/no_img.png', $categoryIds['Stationery']],
            ['Art Supplies', 'Paints, brushes, and canvases.', 'assets/images/no_img.png', $categoryIds['Stationery']],
            ['Sticky Notes & Memo Pads', 'Small notes for quick reminders.', 'assets/images/no_img.png', $categoryIds['Stationery']],
            ['Office Supplies', 'Staplers, paper clips, and files.', 'assets/images/no_img.png', $categoryIds['Stationery']],

            ['Storybooks', 'Fairy tales and adventure stories.', 'assets/images/no_img.png', $categoryIds['Children’s Section']],
            ['Activity & Coloring Books', 'Fun books for kids.', 'assets/images/no_img.png', $categoryIds['Children’s Section']],
            ['Educational Books', 'Learning material for children.', 'assets/images/no_img.png', $categoryIds['Children’s Section']],
            ['Comics & Graphic Novels', 'Illustrated books for kids.', 'assets/images/no_img.png', $categoryIds['Children’s Section']],
            ['Puzzle Books', 'Books with fun puzzles.', 'assets/images/no_img.png', $categoryIds['Children’s Section']],

            ['Fashion Magazines', 'Trendy fashion updates.', 'assets/images/no_img.png', $categoryIds['Magazines & Newspapers']],
            ['Business Magazines', 'Latest business news.', 'assets/images/no_img.png', $categoryIds['Magazines & Newspapers']],
            ['Technology Magazines', 'Updates on tech and gadgets.', 'assets/images/no_img.png', $categoryIds['Magazines & Newspapers']],
            ['Science & Research Journals', 'Academic publications.', 'assets/images/no_img.png', $categoryIds['Magazines & Newspapers']],
            ['Daily Newspapers', 'Current affairs and headlines.', 'assets/images/no_img.png', $categoryIds['Magazines & Newspapers']],
            ['Weekly Publications', 'Industry-specific weekly editions.', 'assets/images/no_img.png', $categoryIds['Magazines & Newspapers']],

            ['PDF Books', 'E-books in digital format.', 'assets/images/no_img.png', $categoryIds['E-Books & Digital Media']],
            ['Audiobooks', 'Spoken word versions of books.', 'assets/images/no_img.png', $categoryIds['E-Books & Digital Media']],
            ['Research Papers', 'Published academic work.', 'assets/images/no_img.png', $categoryIds['E-Books & Digital Media']],
            ['Online Courses', 'Learning materials and certifications.', 'assets/images/no_img.png', $categoryIds['E-Books & Digital Media']],
            ['Subscription Services', 'Premium e-book platforms.', 'assets/images/no_img.png', $categoryIds['E-Books & Digital Media']],
        ];

        foreach ($subcategories as $subcategory) {
            DB::table('categories')->insert([
                'name' => $subcategory[0],
                'description' => $subcategory[1],
                'image' => $subcategory[2],
                'parent_id' => $subcategory[3],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
