<?php

namespace App\Console\Commands;

use App\Components\ImportDataClient;
use App\Http\Resources\Post\PostResource;
use App\Imports\PostsImport;
use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Mail\Mailables\Content;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Files\Filesystem;
use Maatwebsite\Excel\QueuedWriter;
use Maatwebsite\Excel\Reader;
use Maatwebsite\Excel\Writer;
use Nette\Utils\Image;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use ZipStream\File;

class ImportExcelCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:excel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get data from excel';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        ini_set('memory_limit', '-1');
        $this->output->title('Starting import');
        (new PostsImport)->WithOutput($this->output)->import('posts.xlsx');
        $this->output->success('Import successful');
    }
}
