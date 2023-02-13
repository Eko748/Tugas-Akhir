<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Constants\GlobalConstants;
use App\Http\Controllers\Scraping\XPLORE;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UserStore;
use App\Spiders\Job;
use DOMDocument;
use DOMXPath;
use Exception;
use Illuminate\Http\Request;
use RoachPHP\Roach;

use Goutte\Client;
use Sunra\PhpSimple\HtmlDomParser;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\DomCrawler\Crawler;

class ProductController extends Controller
{
    public function member()
    {
        return view('home');
    }
    // public function index(Request $request)
    // {
    //     $users = User::orderBy('created_at', 'desc')->paginate(6);
    //     if ($request->ajax()) {
    //         $sort_by = $request->get('sortby');
    //         $sort_type = $request->get('sorttype');
    //         $query = $request->get('query');
    //         $query = str_replace(" ", "%", $query);
    //         $users = User::where('id', 'like', '%' . $query . '%')
    //             ->orWhere('name', 'like', '%' . $query . '%')
    //             ->orWhere('email', 'like', '%' . $query . '%')
    //             ->orderBy($sort_by, $sort_type)
    //             ->orderBy('created_at', 'desc')->paginate(6);
    //         // $users = User::where(function ($query) use ($request) {
    //         //     if (!empty($request->search)) {
    //         //         $query->Where('name', 'LIKE', '%' . $request->search . '%');
    //         //     }

    //         //     if (!empty($request->email)) {
    //         //         $query->Where('email', 'LIKE', '%' . $request->email . '%');
    //         //     }
    //         // })->orderBy('created_at', 'desc')->paginate(6);

    //         return view('admin.pages.management.product.components.pagination_data', compact('users'))->render();
    //     }
    //     $data = [
    //         "parent" => "Management",
    //         "child" => "Product",
    //         "users" => $users,
    //     ];
    //     return view('admin.pages.management.product.index', $data);
    // }
    public function index(Request $request)
    {
        // $url = 'https://ieeexplore.ieee.org/document/9837910';
        // $html = HtmlDomParser::file_get_html($url);
        // // $pilihan= parse_url($url, PHP_URL_HOST);
        // $judul = $html->find('img .ieee-logo', 0)->plaintext;
        // $a = 'a';
        // $data = Roach::collectSpider(Job::class);
        // dd($data);
        $users = User::getUsers('', '', GlobalConstants::ALL, GlobalConstants::ALL, GlobalConstants::ALL);
        $search = User::all();
        // $client = new Client();
        // $dom = new DOMDocument();

        // $item = [];
        // $website = $client->request('GET', 'https://ieeexplore.ieee.org/document/9636915');
        // $title = $website->evaluate('/html/head/meta[5]')->attr('content');
        // $abstract = $website->evaluate('/html/head/meta[7]')->attr('content');
        // $path = $website->filterXPath('//*[@id="LayoutWrapper"]/div/div/div/script[6]')->extract(['_text']);
        $client = new Client();
        
        // $dom = new DOMDocument;
        // $response = $client->request('GET', 'http://ieeexploreapi.ieee.org/api/v1/search/articles?apikey=6gt3qk5zbgegvb9zb7epynjy&format=xml&max_records=25&start_record=1&sort_order=asc&sort_field=article_number&querytext=Artificial');
        // $p = $response->filterXPath('/html/body/div[2]/span/text()');
        // dd($p);
        // $html = $response->html();
        // $crawler = new Crawler($html);
        // $xpath = new \DOMXPath(@\DOMDocument::loadHTML($html));
        // $nodes = $xpath->query('//*[@id="abstract"]');
        // $client = new Client();
        // $crawler = $client->request('GET', 'https://ieeexplore.ieee.org/document/9837910');

        // $p = $crawler->filterXPath('//*[@id="LayoutWrapper"]/div/div/div/script[6]/text()')->text();

        // $b = array('authors":', ':')[0];
        // $randomArray = explode($b, $p);
        // $i = explode("}],", $randomArray[1])[0];

        // // dd($randomArray)
        // $u = "],";
        // $array = array($i, $u);
        // $a = implode('}', $array);

        // $c = explode('name":', $a);

        // foreach ($c as $key => $value) {
        //     $value;
        // }
        // $c = $p;


        // $data = [];
        // foreach ($nodes as $node) {
        //     $data[] = $node->nodeValue;
        // }
        // evaluate('//*[@id="LayoutWrapper"]/div/div/div/script[6]/text()')->text();
        // $paths = array(['test', 'layout', 'tit']);
        // $json = json_encode($xPath);
        // $item = [];
        // $json2 = explode(':', $json, 2);

        // $path = $this->filterWords($paths, 'title');
        $query = new XPLORE('6gt3qk5zbgegvb9zb7epynjy');
        $query->articleTitle('Artificial');
        $results = $query->callAPI();
        // dd($results);
        $item = [];
        $item[] = $results;
        $cek = [];
        // dd($results['articles']);
        foreach ($results['articles'] as $article) {
            // $item[] = $article;
            $cek[] = $article;
            // dd($article);
            // foreach($article['authors'] as $author) {
            //     foreach($author as $a) {
            //         $cek[] = $a;
            //     }
            // }
            
        }
        // dd($cek);
        $data = [
            "parent" => "Management",
            "child" => "Product",
            "users" => $users,
            "search" => $search,
            // "title" => $title,
            // "abstract" => $abstract,
            "path" => $cek,
        ];
        return view('pages.management.product.index', $data);
        // $c = $companies->text();

        // $i = $c->json();
        // $response = $companies->send(); // Send created request to server
        // $data = $companies->json();
        // $html_string = file_get_contents('https://ieeexplore.ieee.org/document/9636915');
        // $dom = new DOMDocument();
        // libxml_use_internal_errors(true);
        // $dom->loadHTML($html_string);
        // libxml_clear_errors();
        // $xpath = new DOMXpath($dom);
        // $values = array();
        // $row = $xpath->query('//*[@id="LayoutWrapper"]/div/div/div/script[6]');

        // // $a = $values->text();
        // foreach($row as $value) {
        //     $values[] = trim($value->textContent);
        // }

        // $item = $c->html();
        // return $item[] = array(
        //     'nodeName' => $node->nodeName(),
        //     'attributes' => [
        //         'class' => $node->attr('class'),
        //         'id' => $node->attr('id'),
        //     ],
        //     'html' => $node->html(),
        //     'outerHTML' => $node->outerHtml()
        // );
        // $url = $request->get('url');

        // //Init Guzzle
        // $client = new Client();

        //Get request
        // $response = $client->request(
        //     'GET',

        // );

        //     $response_status_code = $response->getStatusCode();
        //     $html = $response->getBody()->getContents();

        //     if($response_status_code==200){
        //         $dom = HtmlDomParser::str_get_html( $html );

        //         $song_items = $dom->find('div[class="chart-list-item"]');

        //         $count = 1;
        //         foreach ($song_items as $song_item){
        //             if($count==1){
        //                 $song_title = trim($song_item->find('span[class="chart-list-item__title-text"]',0)->text());
        //                 $song_artist = trim($song_item->find('div[class="chart-list-item__artist"]',0)->text());

        //                 $song_lyrics_parent = $song_item->find('div[class="chart-list-item__lyrics"]',0)->find('a',0);
        //                 $song_lyrics_href = $song_lyrics_parent->attr['href'];

        //                 //Store in database
        //             }
        //             $count++;
        //         }
        //     }
        // dd($companies);

    }

    public function filterWords($words, $filter)
    {
        return array_filter($words, function ($word) use ($filter) {
            return strpos(strtolower($word), strtolower($filter)) !== false;
        });
    }
    public function getMoreUsers(Request $request)
    {
        $query = $request->search_query;
        $select = $request->select;
        $country = $request->country;
        $sort_by = $request->sort_by;
        $range = $request->range;
        if ($request->ajax()) {
            $users = User::getUsers($query, $select, $country, $sort_by, $range);
            return view('pages.management.product.components.pagination_data', compact('users'))->render();
        }
    }

    public function selectSearch(Request $request)
    {
        $users = [];
        if ($request->has('q')) {
            $search = $request->q;
            $users = User::select("id", "name")
                ->where('name', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($users);
    }

    public function search(Request $request)
    {
        $users = User::where(function ($query) use ($request) {
            if (!empty($request->name)) {
                $query->Where('name', 'LIKE', '%' . $request->name . '%');
            }

            if (!empty($request->email)) {
                $query->Where('email', 'LIKE', '%' . $request->email . '%');
            }
        })->orderBy('created_at', 'desc')->paginate(6)->get();

        return view('pages.management.product.components.pagination_data', compact('users'));
    }


    // public function index(Request $request)
    // {
    //     $user = User::with('userStores')->whereHas('userStores', function ($q) {
    //         $q->where('user_id', Auth::user()->id);
    //     })->first()->paginate(5);

    //     if ($request->ajax()) {
    //         $user = User::with('userStores')->whereHas('userStores', function ($q) {
    //             $q->where('user_id', Auth::user()->id);
    //         })->first()->paginate(5);

    //         $data = [
    //             "product" =>  $user,
    //         ];

    //         return view('admin.pages.management.product.components.pagination_data', $data)->render();
    //     }

    //     $data = [
    //             "parent" => "Management",
    //             "child" => "Product",
    //             "product" =>  $user,
    //         ];

    //         // $data = [
    //         //     "product" =>  $user,
    //         // ];
    //     return view('admin.pages.management.product.index', $data);
    // }

    // public function fetch_data(Request $request)
    // {
    //     // if ($request->ajax()) {
    //         $user = User::with('userStores')->whereHas('userStores', function ($q) {
    //             $q->where('user_id', Auth::user()->id);
    //         })->first()->paginate(5);

    //         $data = [
    //             "product" =>  $user,
    //         ];
    //         return $data;
    //     // }
    // }

    // public function getTable(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data = User::where('created_by', Auth::user()->id)->orderBy("created_at", "DESC")->get();
    //         return DataTables::of($data)
    //             ->addIndexColumn()->addColumn('action', function ($data) {
    //                 $btn = '<div style="text-align: center; vertical-align: middle;">
    //                             <button title="Detail" class="btn btn-primary btn-sm btn-outline-dark hovering shadow-sm" onclick="readEmployee(' . $data->id . ')">
    //                                 <i class="fa fa-address-book"></i>
    //                             </button>
    //                             <button title="Edit" class="btn btn-success btn-sm btn-outline-dark hovering shadow-sm" onclick="editEmployee(' . $data->id . ')" type="button" data-bs-toggle="modal" data-bs-target="#updateEmployee">
    //                                 <i class="fa fa-pencil"></i>
    //                             </button>
    //                             <button title="Delete" class="btn btn-danger btn-s btn-outline-dark hovering shadow-sm" onclick="deleteEmployee(' . $data->id . ')">
    //                                 <i class="fa fa-trash"></i>
    //                             </button>
    //                         </div>';
    //                 return $btn;
    //                 // <button class="btn btn-danger" onclick="deleteEmployee({{$user->id}})"></button>
    //             })->addColumn('date', function ($data) {
    //                 $date = $data->last_seen;
    //                 $parse = Carbon::parse($date)->isoFormat('LLLL');
    //                 $danger = '<span class="badge btn-outline-primary hovering badge-light-primary">Belum ada riwayat Login</span>';
    //                 $info = '<span class="badge btn-outline-success hovering badge-light-success">' . $parse . '</span>';

    //                 if ($date == null) {
    //                     return $danger;
    //                 } else {
    //                     return $info;
    //                 }
    //                 return $date;
    //             })->addColumn('info', function ($data) {
    //                 $online = '<span class="text-success">Online</span>';
    //                 $offline = '<span class="text-secondary">Offline</span>';
    //                 $user_id = $data->id;
    //                 if (Cache::has('user-is-online-' . $user_id)) {
    //                     return $online;
    //                 } else {
    //                     return $offline;
    //                 }
    //                 return $user_id;
    //             })->rawColumns(['action', 'date', 'info'])->make(true);
    //     }
    // }

    // public function getUser(Request $req)
    // {
    // 	$users = [];

    //     if($req->has('q')){
    //         $search = $req->q;
    //         $users = User::select("id", "name", "email")
    //         		  ->where('name', 'LIKE', "%$search%")
    //         		  ->get();
    //     }
    //     return response()->json($users);
    // }

    // public function create(Request $request)
    // {
    //     $user = User::with('userStores')->whereHas('userStores', function ($q) {
    //         $q->where('user_id', Auth::user()->id);
    //     })->first();

    //     if ($user == null) {
    //         return redirect()->route('management.employee.index');
    //     } else {
    //         $store = $user->userStores->store_slug;
    //     }

    //     $array = array($store, $request->email);
    //     $string = implode('.', $array);

    //     $auth = Auth::user()->id;
    //     $token = Str::random(64);

    //     $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', Rules\Password::defaults()],
    //         'status' => ['required', 'integer'],
    //     ]);

    //     $employee = User::create(
    //         [
    //             'id_role' => 2,
    //             'name' => $request->name,
    //             'email' => $string,
    //             'password' => Hash::make($request->password),
    //             'status' => $request->status,
    //             'created_by' => $auth,
    //             'remember_token' => $token
    //         ]
    //     );

    //     return response()->json($employee);
    // }

    // public function edit(Request $request)
    // {
    //     $edit = User::where("id", $request->id)->first();
    //     $email = $edit->email;
    //     $string = explode('.', $email, 2);
    //     $data = [
    //         "edit" => $edit,
    //         "string" => $string,
    //     ];

    //     return view("admin.pages.management.employee.components.edit", $data);
    // }

    // public function update(Request $request)
    // {

    //     $user = User::with('userStores')->whereHas('userStores', function ($q) {
    //         $q->where('user_id', Auth::user()->id);
    //     })->first();

    //     if ($user == null) {
    //         return redirect()->route('management.employee.index');
    //     } else {
    //         $store = $user->userStores->store_slug;
    //     }

    //     $array = array($store, $request->email);
    //     $string = implode('.', $array);

    //     if ($request->name) {
    //         $request->validate([
    //             'name' => ['required', 'string', 'max:255'],
    //         ]);
    //     } else {
    //         $request->validate([
    //             'name' => ['required', 'string', 'max:255'],
    //             'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         ]);
    //     }

    //     $employee = User::where("id", $request->id)->update([
    //         "name" => $request->name,
    //         "email" => $string
    //     ]);

    //     return response()->json($employee);
    // }

    // public function delete($id)
    // {
    //     $delete = User::where('id', $id)->delete();

    //     // check data deleted or not
    //     if ($delete == 1) {
    //         $success = true;
    //         $message = "Employee Berhasil dihapus";
    //     } else {
    //         $success = true;
    //         $message = "Employee tidak ditemukan!";
    //     }

    //     //  Return response
    //     return response()->json([
    //         'success' => $success,
    //         'message' => $message,
    //     ]);
    // }

    // public function storeToko(Request $request)
    // {
    //     $request->validate([
    //         "store_name" => "required"
    //     ]);

    //     UserStore::create([
    //         "user_id" => Auth::user()->id,
    //         "store_name" => $request->store_name,
    //         "store_slug" => Str::of($request->store_name)->slug("")
    //     ]);

    //     return response()->json(["success" => "true"]);
    // }
}
