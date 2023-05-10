<?php

namespace App\Imports;

use App\Models\Post;
use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class UsersImport implements ToModel, WithProgressBar
{
    use Importable;

    public function model(array $row)
    {
        return new User([
            'title' => $row[0],
            'content' => $row[1],
            'image' => ($row[2]),
            'likes' => ($row[3]),
            'is_published' => ($row[4]),
            'category' => ($row[5]),

        ]);
    }
}
