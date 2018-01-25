<?php namespace App\Http\Controllers\Admin;

use App\Contact;
use App\Helpers\CSVExporter;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class ContactController extends BaseController
{

    use CSVExporter;


    /**
     * Display list of submitted contacts
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $columns = [
            'id',
            'first_name',
            'last_name',
            'email',
            'nature_of_enquiry',
            'job_title',
            'company',
            'industry',
            'countries_operate',
            'country',
            'website',
            'comments',
        ];
        $values = Contact::all($columns);

        return view('admin.contact.index', ['values' => $values]);
    }


    /**
     * Export data as CSV
     *
     * @return bool|mixed
     */
    public function export()
    {
        $list = Contact::all()->toArray();

        return $this->exportCSV($list, 'contacts');
    }

}
