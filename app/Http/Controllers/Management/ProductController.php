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
use phpQuery;
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
        $client = new Client();
        $dom = new DOMDocument();

        $item = [];
        $website = $client->request('GET', 'https://ieeexplore.ieee.org/document/9636915');
        $title = $website->evaluate('/html/head/meta[5]')->attr('content');
        $abstract = $website->evaluate('/html/head/meta[7]')->attr('content');
        $path = $website->filterXPath('//*[@id="LayoutWrapper"]/div/div/div/script[6]')->extract(['_text']);
        $client = new Client();
        // $bodyTag = '<div _ngcontent-oxk-c179="" class="cmap-map-list"><div _ngcontent-oxk-c179="" class="cmap-map-item"><div _ngcontent-oxk-c179="" class="row"><div _ngcontent-oxk-c179="" class="text-sm-md"> 1. <span _ngcontent-oxk-c179="" xplmathjax="">Energy Policies of IEA Countries: Denmark 2011 Review</span></div></div></div><div _ngcontent-oxk-c179="" class="cmap-map-item"><div _ngcontent-oxk-c179="" class="row"><div _ngcontent-oxk-c179="" class="text-sm-md"> 2. <span _ngcontent-oxk-c179="" xplmathjax="">Climate Vulnerable Forum, Geneva, Rotterdam, Dhaka</span></div></div></div><div _ngcontent-oxk-c179="" class="cmap-map-item"><div _ngcontent-oxk-c179="" class="row"><div _ngcontent-oxk-c179="" class="text-sm-md"> 3. <span _ngcontent-oxk-c179="" xplmathjax="">Renewables 2020 Global Status Report</span></div></div></div><div _ngcontent-oxk-c179="" class="cmap-map-item"><div _ngcontent-oxk-c179="" class="row"><div _ngcontent-oxk-c179="" class="text-sm-md"> 4. <span _ngcontent-oxk-c179="" xplmathjax="">Global Warming of 1.5°C</span></div></div></div><div _ngcontent-oxk-c179="" class="cmap-map-item"><div _ngcontent-oxk-c179="" class="row"><div _ngcontent-oxk-c179="" class="text-sm-md"> 5. <span _ngcontent-oxk-c179="" xplmathjax="">Towards 100% Renewable Energy: Status, Trends and Lessons Learned</span></div></div></div><div _ngcontent-oxk-c179="" class="cmap-map-item"><div _ngcontent-oxk-c179="" class="row"><div _ngcontent-oxk-c179="" class="text-sm-md"> 6. <span _ngcontent-oxk-c179="" xplmathjax="">Towards 100% Renewable Energy: Utilities in Transition</span></div></div></div><div _ngcontent-oxk-c179="" class="cmap-map-item"><div _ngcontent-oxk-c179="" class="row"><div _ngcontent-oxk-c179="" class="text-sm-md"> 7. <span _ngcontent-oxk-c179="" xplmathjax="">Antigua &amp; Barbuda Renwable Energy Roadmap</span></div></div></div><div _ngcontent-oxk-c179="" class="cmap-map-item"><div _ngcontent-oxk-c179="" class="row"><div _ngcontent-oxk-c179="" class="text-sm-md"> 8. <span _ngcontent-oxk-c179="" xplmathjax="">World Energy Transitions Outlook 1.5°C Pathway</span></div></div></div><div _ngcontent-oxk-c179="" class="cmap-map-item"><div _ngcontent-oxk-c179="" class="row"><div _ngcontent-oxk-c179="" class="text-sm-md"> 9. <span _ngcontent-oxk-c179="" xplmathjax="">Net Zero by 2050: A Roadmap for the Global Energy Sector</span></div></div></div><div _ngcontent-oxk-c179="" class="cmap-map-item"><div _ngcontent-oxk-c179="" class="row"><div _ngcontent-oxk-c179="" class="text-sm-md"> 10. <span _ngcontent-oxk-c179="" xplmathjax="">Conditions and Requirements for the Technical Feasibility of a Power System with a High Share of Renewabl...</span></div></div></div><!----><!----></div>';
        // $pattern = '/keywords:\s*\{(.*?)\}/i';
        // preg_match($pattern, $bodyTag, $matches);
        // $i = [];
        // $i[] = $matches;
        // $keywords = $i;

        // dd($keywords);

        $html = '<body data-new-gr-c-s-check-loaded="14.1097.0" data-gr-ext-installed="">N. M. Haegel and S. R. Kurtz, "Global Progress Toward Renewable Electricity: Tracking the Role of Solar," in <em>IEEE Journal of Photovoltaics</em>, vol. 11, no. 6, pp. 1335-1342, Nov. 2021.<br>doi: 10.1109/JPHOTOV.2021.3104149<br> keywords: {Solar energy;Solar power generation;Renewable energy sources;Net expansions;renewable energy sources;solar energy;solar power generation},<br>URL:&nbsp;<a href="http://ieeexplore.ieee.org/stamp/stamp.jsp?tp=&amp;arnumber=9541211&amp;isnumber=9581323">http://ieeexplore.ieee.org/stamp/stamp.jsp?tp=&amp;arnumber=9541211&amp;isnumber=9581323</a><br><br>H. Holttinen <em>et al</em>., "System Impact Studies for Near 100% Renewable Energy Systems Dominated by Inverter Based Variable Generation," in <em>IEEE Transactions on Power Systems</em>, vol. 37, no. 4, pp. 3249-3258, July 2022.<br>doi: 10.1109/TPWRS.2020.3034924<br> keywords: {Power system stability;Planning;Biological system modeling;Renewable energy sources;Investment;Stability analysis;Analytical models;Power system operation;variable inverter based renewables;power electronics;energy systems integration},<br>URL:&nbsp;<a href="http://ieeexplore.ieee.org/stamp/stamp.jsp?tp=&amp;arnumber=9246271&amp;isnumber=9799574">http://ieeexplore.ieee.org/stamp/stamp.jsp?tp=&amp;arnumber=9246271&amp;isnumber=9799574</a><br><br>S. Khalili and C. Breyer, "Review on 100% Renewable Energy System Analyses—A Bibliometric Perspective," in <em>IEEE Access</em>, vol. 10, pp. 125792-125834, 2022.<br>doi: 10.1109/ACCESS.2022.3221155<br> keywords: {Bibliometrics;Renewable energy sources;System analysis and design;Databases;Organizations;Market research;Energy efficiency;Social networking (online);Climate change;100% renewable energy;energy transition;bibliometric analysis;data processing machine;social networks;collaborative maps;topic model},<br>URL:&nbsp;<a href="http://ieeexplore.ieee.org/stamp/stamp.jsp?tp=&amp;arnumber=9944656&amp;isnumber=9668973">http://ieeexplore.ieee.org/stamp/stamp.jsp?tp=&amp;arnumber=9944656&amp;isnumber=9668973</a><br><br>M. Carbajales-Dale, M. Raugei, V. Fthenakis and C. Barnhart, "Energy Return on Investment (EROI) of Solar PV: An Attempt at Reconciliation [Point of View]," in <em>Proceedings of the IEEE</em>, vol. 103, no. 7, pp. 995-999, July 2015.<br>doi: 10.1109/JPROC.2015.2438471<br> keywords: {Energy management;Solar power generation;Investments;Economics;Market research;Energy generation;Wind power generation;Industries;Power system economics;Electricity supply industry;Power generation;Power markets},<br>URL:&nbsp;<a href="http://ieeexplore.ieee.org/stamp/stamp.jsp?tp=&amp;arnumber=7128485&amp;isnumber=7128427">http://ieeexplore.ieee.org/stamp/stamp.jsp?tp=&amp;arnumber=7128485&amp;isnumber=7128427</a><br><br>H. Holttinen <em>et al</em>., "Variable Renewable Energy Integration: Status Around the World," in <em>IEEE Power and Energy Magazine</em>, vol. 19, no. 6, pp. 86-96, Nov.-Dec. 2021.<br>doi: 10.1109/MPE.2021.3104156<br> keywords: {Photovoltaic systems;Renewable energy sources;Wind power generation;Government;Hydroelectric power generation;Europe;Carbon dioxide},<br>URL:&nbsp;<a href="http://ieeexplore.ieee.org/stamp/stamp.jsp?tp=&amp;arnumber=9579026&amp;isnumber=9579023">http://ieeexplore.ieee.org/stamp/stamp.jsp?tp=&amp;arnumber=9579026&amp;isnumber=9579023</a><br><br>B. Kroposki <em>et al</em>., "Achieving a 100% Renewable Grid: Operating Electric Power Systems with Extremely High Levels of Variable Renewable Energy," in <em>IEEE Power and Energy Magazine</em>, vol. 15, no. 2, pp. 61-73, March-April 2017.<br>doi: 10.1109/MPE.2016.2637122<br> keywords: {Power system planning;Renewable energy sources;Hydroelectric power generation;Coal;Synchronous generators;Wind power;Power grids;Electricity supply industry},<br>URL:&nbsp;<a href="http://ieeexplore.ieee.org/stamp/stamp.jsp?tp=&amp;arnumber=7866938&amp;isnumber=7866913">http://ieeexplore.ieee.org/stamp/stamp.jsp?tp=&amp;arnumber=7866938&amp;isnumber=7866913</a><br><br>N. B. Manjong, A. S. Oyewo and C. Breyer, "Setting the Pace for a Sustainable Energy Transition in Central Africa: The Case of Cameroon," in <em>IEEE Access</em>, vol. 9, pp. 145435-145458, 2021.<br>doi: 10.1109/ACCESS.2021.3121000<br> keywords: {Africa;Renewable energy sources;Hydroelectric power generation;Electric potential;Costs;Sustainable development;Climate change;Energy system modelling;Cameroon;Central Africa;100% renewable energy;sustainable energy transition},<br>URL:&nbsp;<a href="http://ieeexplore.ieee.org/stamp/stamp.jsp?tp=&amp;arnumber=9579016&amp;isnumber=9312710">http://ieeexplore.ieee.org/stamp/stamp.jsp?tp=&amp;arnumber=9579016&amp;isnumber=9312710</a><br><br>A. Gulagi, S. Pathak, D. Bogdanov and C. Breyer, "Renewable Energy Transition for the Himalayan Countries Nepal and Bhutan: Pathways Towards Reliable, Affordable and Sustainable Energy for All," in <em>IEEE Access</em>, vol. 9, pp. 84520-84544, 2021.<br>doi: 10.1109/ACCESS.2021.3087204<br> keywords: {Hydroelectric power generation;Biomass;Energy consumption;Statistics;Sociology;Petroleum;Electric potential;Climate change;100% renewable energy;Nepal;Bhutan;energy transition;Himalayan countries;hydropower;solar photovoltaics},<br>URL:&nbsp;<a href="http://ieeexplore.ieee.org/stamp/stamp.jsp?tp=&amp;arnumber=9448098&amp;isnumber=9312710">http://ieeexplore.ieee.org/stamp/stamp.jsp?tp=&amp;arnumber=9448098&amp;isnumber=9312710</a><br><br>
</body>';

        $dom = new DOMDocument();
        $dom->loadHTML($html);

        $body = $dom->getElementsByTagName("body")->item(0);
        $publikasi = array();
        $data = array();
        foreach ($body->childNodes as $node) {
            if ($node->nodeName === 'br') {
                $publikasi[] = $data;
                $data = array();
            } else {
                $nodeValue = trim($node->nodeValue);
                if (strpos($nodeValue, 'URL') !== false && strpos($nodeValue, '&nbsp;') !== false) {
                    $data[] = explode("&nbsp;", $nodeValue)[1];
                } else {
                    $data[] = $nodeValue;
                }
            }
        }
        $publikasi[] = $data;
        $publikasi = array_values(array_filter($publikasi, function ($elem) {
            return count($elem) >= 3;
        }));
        dd($publikasi);




        // ambil semua elemen "a"
        $links = $dom->getElementsByTagName("a");

        foreach ($links as $link) {
            echo $link->getAttribute("href") . "<br>";
        }

        // ambil teks di dalam tag "em"
        $em = $dom->getElementsByTagName("em");
        foreach ($em as $tag) {
            echo $tag->nodeValue . "<br>";
        }

        $results = array();
        // ambil teks di dalam tag "body"
        $body = $dom->getElementsByTagName("body")->item(0);
        echo $body->nodeValue;

        // Print



        // $html = '
        // <div class="cmap-map-list">
        // <div class="cmap-map-item">
        //     <div class="row">
        //         <div class="text-sm-md">
        //             1.
        //             <span>Energy Policies of IEA Countries: Denmark 2011 Review</span>
        //         </div>
        //     </div>
        // </div>
        // <div class="cmap-map-item">
        //     <div class="row">
        //         <div class="text-sm-md">
        //             2.
        //             <span>Climate Vulnerable Forum, Geneva, Rotterdam, Dhaka</span>
        //         </div>
        //     </div>
        // </div>
        // </div>';
        // $doc = new DOMDocument();
        // $doc->loadHTML($html);

        // $xpath = new DOMXPath($doc);
        // $items = $xpath->query('//div[@class="cmap-map-item"]');

        // $results = array();
        // foreach ($items as $item) {
        //     $span = $xpath->query('.//span', $item)->item(0);
        //     $text = $span->textContent;
        //     $results[] = $text;
        // }

        // dd($results);
        // // tampilkan hasil
        // foreach ($results as $result) {
        // }



        // echo $keywords; // akan menampilkan "Solar energy;Solar power generation;Renewable energy sources;Net expansions;renewable energy sources;solar energy;solar power generation"


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
        // return view('pages.management.product.index', $data);
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
