<?php namespace App\Http\Controllers\Admin;

use App\Helpers\CSVExporter;
use App\Media;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class MediaController extends BaseController
{

    use CSVExporter;


    /**
     * Display list of submitted contacts
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $values = Media::with(['photo', 'article1', 'article2', 'article3'])->get()->toArray();

        $values = array_map(
            function ($item) {
                $item['articles'] = [
                    $item['article1'],
                    $item['article2'],
                    $item['article3'],
                ];
                $item['links'] = [
                    $item['link1'],
                    $item['link2'],
                    $item['link3'],
                ];
                $item['articles'] = array_filter($item['articles']);
                $item['links'] = array_filter($item['links']);
                unset($item['article1'], $item['article2'], $item['article3']);
                unset($item['link1'], $item['link2'], $item['link3']);

                return $item;
            },
            $values
        );

        return view('admin.media.index', ['values' => $values]);
    }


    /**
     * Export data as CSV
     *
     * @return bool|mixed
     */
    public function export()
    {
        $list = Media::all()->toArray();

        return $this->exportCSV($list, 'media');
    }

}
