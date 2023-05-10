<?php

namespace App\Imports;

use App\Models\Post;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow as WithHeadingRowAlias;

class PostsImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $item) {
            if (isset($item['title']) && $item['title'] != null) {
                Post::firtsOrCreate([
                    'title' => $item['title'],
                ],
                    [
                    'title' => $item['title'],
                    'content' => $item['content'],
                    'image' => $item['image'],
                    'likes' => $item['likes'],
                    'is_published' => $item['pub_status'],
                    'category_id' => $item['category'],
                ]);
            }
        }
    }
}
