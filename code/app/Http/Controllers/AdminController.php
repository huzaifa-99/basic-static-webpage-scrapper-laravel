<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Newspaper;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\MessageBag;
use Weidner\Goutte\GoutteFacade;
use App\Article;
use App\Employee;
use App\Polarity;
use Sentiment\Analyzer;
use PHPInsight\Sentiment;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Actor;
use App\Noun;
use App\NodeSetting;

class AdminController extends Controller
{
    public function index()
    {
    	return view('admin.home');
    }

    public function articlesBroken()
    {   
        $articles = Article::where('title','title')->orWhere('excerpt','excerpt')->orWhere('body','body')->orWhere('thumbnail','thumbnail')->orWhere('publisher','publisher')->orWhere('published_on','published_on')->get();
        $newsline = Newspaper::all();

        return view('admin.brokenArticle',['articles' => $articles,'newsline' => $newsline]); //  the view to make now
    }

    // public function index()
    // {
    //     return view('admin.home');
    // }

    public function newspapersIndex()
    {
        $newspapers = Newspaper::get();

    	return view('admin.newspaper',['newspapers'=>$newspapers]);
    }

    public function newspapersCreate(Request $request)
    {
    	// Validation -------------------- 

        $validator = Validator::make($request->all(), [
            'name' => [ 'required','string' ],
            'link' => [ 'required','url','unique:newspapers' ],
            'article' => [ 'required','string'],//'unique:nodesSettings' // sometimes
            'linknode' => [ 'required','string' ],
            'title' => [ 'required','string'],//'unique:nodesSettings'
            'body' => [ 'required','string' ],
            'thumbnail' => [ 'required','string' ], // Image means Jpg,Jpeg,Png,Svg,Bmp
            'publisher' => [ 'required','string' ], 
            'published_on' => [ 'required','string' ], 
            // 'domain' => [ 'required','string',Rule::in(array('all','political','bussiness','sports','technology')) ],
            // 'thumbnail' => [ 'required','image' ], // Image means Jpg,Jpeg,Png,Svg,Bmp
        ]);

        // // Validate image format to be Jpeg,Jpg,Png

        // if($request->hasFile('thumbnail')){

        //     // hasFile() for file fields and has() for other fileds
        
        //     $extension = $request->file('thumbnail')->getClientOriginalExtension();
        //     $array = array('jpeg','jpg','png','svg');
        //     if (!in_array($extension, $array)){
        //         return response()->json([
        //             'error'=>
        //             ['thumbnail' =>
        //                 ['The Image must be of Jpeg,Jpg or Png formats.']
        //             ]
        //         ],200);
        //     }

        // } 

        // If the validation fails

        if (!$validator->passes()) {

            return response()->json(['error'=>$validator->errors()],200);
        
        }

    	// Persist Data -------------------

  //       // Upload thumbnail to server
  //   	$uploads_dir = 'E:/xampp/htdocs/Projects/project8/p1/public/images/newspapers';
		// $tmp_name = $request->thumbnail->getPathname();
		// $filename = rand().$request->thumbnail->getClientOriginalName();
		// $ifuploaded=move_uploaded_file($tmp_name, "$uploads_dir/$filename");
		// if(!$ifuploaded){
		// 	return response()->json([
  //                   'error'=>
  //                   ['thumbnail' =>
  //                       ["Sorry We Could'nt upload your thumbnail to our server.Please try again later."]
  //                   ]
  //               ],200);
		// }
         // work from here

        // Save all data to database
    	$newspaper = Newspaper::create([
    		'name' => $request->name,
    		'link' => $request->link,
    		'infoDomain' => 'abc',//$request->domain,
            'thumbnail' => 'abc',//$filename,
            'added_by' => auth()->id()
    	]);
        $temp = Newspaper::where('name',$request->name)->first();
        $Nodes = NodeSetting::create([
                'newspaper_id' => $temp->id,
                'article' => $request->article,
                'link' => $request->linknode, 
                'title' => $request->title, 
                'body' => $request->body, 
                'thumbnail' => $request->thumbnail, 
                'publisher' => $request->publisher, 
                'published_on' => $request->published_on,
        ]);
    	// Return successfully ------------

        exit();
    	return redirect('/newspaper');

    }

    public function newspaperDelete($id)
    {
        $newspaper = Newspaper::where('id',$id)->delete();

        return redirect()->back();
    }
    
    public function newspaperToggleStatus($id)
    {
        $newspaper = Newspaper::find($id);

        if($newspaper->is_active==0){
            $newspaper->is_active=1;
        }
        elseif($newspaper->is_active==1){
            $newspaper->is_active=0;
        }

        $newspaper->save();

        return redirect()->back();
    }

    public function newspaperEdit(Request $request)
    {
        // Validation -------------------- 

        $validator = Validator::make($request->all(), [
            'name' => [ 'required','string' ],
            'link' => [ 'required','url','unique:newspapers' ],
            // 'domain' => [ 'required','string',Rule::in(array('all','political','bussiness','sports','technology')) ],
            // 'thumbnail' => [ 'required','image' ], // Image means Jpg,Jpeg,Png,Svg,Bmp
        ]);


        // Validate image format to be Jpeg,Jpg,Png

        if($request->hasFile('thumbnail')){

            // hasFile() for file fields and has() for other fileds
        
            $extension = $request->file('thumbnail')->getClientOriginalExtension();
            $array = array('jpeg','jpg','png','svg');
            if (!in_array($extension, $array)){
                return response()->json([
                    'error'=>
                    ['thumbnail' =>
                        ['The Image must be of Jpeg,Jpg or Png formats.']
                    ]
                ],200);
            }

        } 

        // If the validation fails

        if (!$validator->passes()) {

            return response()->json(['error'=>$validator->errors()],200);
        
        }

        // Persist Data -------------------

        // Upload thumbnail to server
        // $uploads_dir = 'E:/xampp/htdocs/Projects/project8/p1/public/images/newspapers';
        // $tmp_name = $request->thumbnail->getPathname();
        // $filename = rand().$request->thumbnail->getClientOriginalName();
        // $ifuploaded=move_uploaded_file($tmp_name, "$uploads_dir/$filename");
        // if(!$ifuploaded){
        //     return response()->json([
        //             'error'=>
        //             ['thumbnail' =>
        //                 ["Sorry We Could'nt upload your thumbnail to our server.Please try again later."]
        //             ]
        //         ],200);
        // }

        // Save all data to database

        $updateCount = Newspaper::where('id',$request->idofnewspaper)->first();

        $updateCount = $updateCount->updateCount;
        $updateCount++;

        $newspaper = Newspaper::where('id',$request->idofnewspaper)->
        limit(1)->
        update([
            'name' => $request->name,
            'link' => $request->link,
            // 'infoDomain' => $request->domain,
            // 'thumbnail' => $filename,
            'updateCount' => $updateCount,
            'updated_at' => now()
        ]);

        // Return successfully ------------
        return redirect()->back();
    }

    public function articlesIndex()
    {
        $articles = Article::where('title','!=','title')->where('excerpt','!=','excerpt')->where('body','!=','body')->where('thumbnail','!=','thumbnail')->where('publisher','!=','publisher')->where('published_on','!=','published_on')->orderBy('id', 'DESC')->get();

        return view('admin.articles',['articles'=>$articles]);
    }
    
    public function articlesCreate()
    {
        
        return view('admin.newArticle');

    }

    public function newNodes(Request $request)
    {   
        // $request = collect(['newswire' => 'dawn','article' => $Article_S,'link' => $Link_S,'title' => $Title_S,'body' => $Body_S,'thumbnail' => $Thumbnail_S,'publisher' => $Publisher_S,'published_on' => $PublishedOn_S]);

        // $request = collect(['newswire' => 'dawn','article' => 'div > span > p > aa ']);
        
        // Step 1 : Validate the nodes sent to me.....

        // Validation -------------------- 
        $validator = Validator::make($request->all(), [
            'newswire' => [ 'required','string','exists:newspapers,name'],//,Rule::in(array('all','political','bussiness','sports','technology')) 
            'article' => [ 'nullable','string'],//'unique:nodesSettings' // sometimes
            'link' => [ 'nullable','string' ],
            'title' => [ 'nullable','string'],//'unique:nodesSettings'
            'body' => [ 'nullable','string' ],
            'thumbnail' => [ 'nullable','string' ], // Image means Jpg,Jpeg,Png,Svg,Bmp
            'publisher' => [ 'nullable','string' ], 
            'published_on' => [ 'nullable','string' ], 
        ]);

        // If the validation fails
        if (!$validator->passes()) {

            return response()->json(['error'=>$validator->errors()],200);
        
        } 
        // Step 2 : Check for their existance in db and concatenate them with relevent one's in Db..
        $name = Newspaper::where('name',$request['newswire'])->first();
        $verify = NodeSetting::where('newspaper_id',$name->id)->first();//dd($verify);
        if($verify)
        {   
            // Concatenate with already present data in database

            $MessageBag = new MessageBag; // create a messagebag object to handle errors

            // Article
            if($request->has('article'))
            {   
                $DB = explode(',',$verify->article);
                // verify if the record exists already
                if(is_array($DB))
                {     
                    // If the request->article contains a , 
                    if(strpos($request['article'],','))
                    {
                        $var = explode(',', $request['article']);
                        $char = explode(',',$verify->article);
                        foreach ($var as $value) 
                        {
                            if(!in_array($value,$DB))
                            {
                                array_push($DB,$value);
                            }
                            else{
                                // Must be an array pictureperfect
                                $MessageBag->add('article','The article "'.$value.'" already exists in database.Please add a new one');
                                return;
                            }
                        }
                        $request['article'] = implode(',',$DB);
                    }
                    // If the request->article has no ,
                    else
                    {
                        if(!in_array($request['article'], $DB))
                        {
                            $temp = array_push($DB, $request['article']);
                            $request['article'] = implode(',',$DB);
                        }
                        else
                        {
                            $MessageBag->add('article','The article "'.$request['article'].'" already exists in database.Please add a new one');
                        }
                    }
                }
                else
                {
                    if($DB===$request['article'])
                    {
                        $MessageBag->add('article','The article "'.$request['article'].'" already exists in database.Please add a new one');
                    }
                    else
                    {
                        $request['article'] = $DB.','.$request['article'];
                    }
                }
                $DB=null;$temp=null;
            }
            elseif(!$request->has('article'))
            {   
                $request['article'] = $verify->article;  
            }

            // Link
            if($request->has('link'))
            {   
                $DB = explode(',',$verify->link);
                // verify if the record exists already
                if(is_array($DB))
                {     
                    // If the request->link contains a , 
                    if(strpos($request['link'],','))
                    {
                        $var = explode(',', $request['link']);
                        $char = explode(',',$verify->link);
                        foreach ($var as $value) 
                        {
                            if(!in_array($value,$DB))
                            {
                                array_push($DB,$value);
                            }
                            else{
                                $MessageBag->add('link','The link "'.$request['link'].'" already exists in database.Please add a new one');
                            }
                        }
                        $request['link'] = implode(',',$DB);
                    }
                    // If the request->link has no ,
                    else
                    {
                        if(!in_array($request['link'], $DB))
                        {
                            $temp = array_push($DB, $request['link']);
                            $request['link'] = implode(',',$DB);
                        }
                        else
                        {
                            $MessageBag->add('link','The link "'.$request['link'].'" already exists in database.Please add a new one');
                        }
                    }
                }
                else
                {
                    if($DB===$request['link'])
                    {
                        $MessageBag->add('link','The link "'.$request['link'].'" already exists in database.Please add a new one');
                    }
                    else
                    {
                        $request['link'] = $DB.','.$request['link'];
                    }
                }
                $DB=null;$temp=null;
            }
            elseif(!$request->has('link'))
            {   
                $request['link']= $verify->link;  
            }

            // Title
            if($request->has('title'))
            {   
                $DB = explode(',',$verify->title);
                // verify if the record exists already
                if(is_array($DB))
                {     
                    // If the request->title contains a , 
                    if(strpos($request['title'],','))
                    {
                        $var = explode(',', $request['title']);
                        $char = explode(',',$verify->title);
                        foreach ($var as $value) 
                        {
                            if(!in_array($value,$DB))
                            {
                                array_push($DB,$value);
                            }
                            else{
                                $MessageBag->add('title','The title "'.$request['title'].'" already exists in database.Please add a new one');
                            }
                        }
                        $request['title'] = implode(',',$DB);
                    }
                    // If the request->title has no ,
                    else
                    {
                        if(!in_array($request['title'], $DB))
                        {
                            $temp = array_push($DB, $request['title']);
                            $request['title'] = implode(',',$DB);
                        }
                        else
                        {
                                $MessageBag->add('title','The title "'.$request['title'].'" already exists in database.Please add a new one');
                        }
                    }
                }
                else
                {
                    if($DB===$request['title'])
                    {
                        $MessageBag->add('title','The title "'.$request['title'].'" already exists in database.Please add a new one');
                    }
                    else
                    {
                        $request['title'] = $DB.','.$request['title'];
                    }
                }
                $DB=null;$temp=null;
            }
            elseif(!$request->has('title'))
            {   
                $request['title'] = $verify->title;  
            }

            // Body
            if($request->has('body'))
            {   
                $DB = explode(',',$verify->body);
                // verify if the record exists already
                if(is_array($DB))
                {     
                    // If the request->body contains a , 
                    if(strpos($request['body'],','))
                    {
                        $var = explode(',', $request['body']);
                        $char = explode(',',$verify->body);
                        foreach ($var as $value) 
                        {
                            if(!in_array($value,$DB))
                            {
                                array_push($DB,$value);
                            }
                            else{
                                $MessageBag->add('body','The body "'.$request['body'].'" already exists in database.Please add a new one');
                            }
                        }
                        $request['body'] = implode(',',$DB);
                    }
                    // If the request->body has no ,
                    else
                    {
                        if(!in_array($request['body'], $DB))
                        {
                            $temp = array_push($DB, $request['body']);
                            $request['body'] = implode(',',$DB);
                        }
                        else
                        {
                            $MessageBag->add('body','The body "'.$request['body'].'" already exists in database.Please add a new one');
                        }
                    }
                }
                else
                {
                    if($DB===$request['body'])
                    {
                        $MessageBag->add('body','The body "'.$request['body'].'" already exists in database.Please add a new one');
                    }
                    else
                    {
                        $request['body'] = $DB.','.$request['body'];
                    }
                }
                $DB=null;$temp=null;
            }
            elseif(!$request->has('body'))
            {   
                $request['body'] = $verify->body;  
            }

            // Thumbnail
            if($request->has('thumbnail'))
            {   
                $DB = explode(',',$verify->thumbnail);
                // verify if the record exists already
                if(is_array($DB))
                {     
                    // If the request->thumbnail contains a , 
                    if(strpos($request['thumbnail'],','))
                    {
                        $var = explode(',', $request['thumbnail']);
                        $char = explode(',',$verify->thumbnail);
                        foreach ($var as $value) 
                        {
                            if(!in_array($value,$DB))
                            {
                                array_push($DB,$value);
                            }
                            else{
                                $MessageBag->add('thumbnail','The thumbnail "'.$value.'" already exists in database.Please add a new one');
                            }
                        }
                        $request['thumbnail'] = implode(',',$DB);
                    }
                    // If the request->thumbnail has no ,
                    else
                    {
                        if(!in_array($request['thumbnail'], $DB))
                        {
                            $temp = array_push($DB, $request['thumbnail']);
                            $request['thumbnail'] = implode(',',$DB);
                        }
                        else
                        {
                            $MessageBag->add('thumbnail','The thumbnail "'.$request['thumbnail'].'" already exists in database.Please add a new one');
                        }
                    }
                }
                else
                {
                    if($DB===$request['thumbnail'])
                    {
                        $MessageBag->add('thumbnail','The thumbnail "'.$request['thumbnail'].'" already exists in database.Please add a new one');
                    }
                    else
                    {
                        $request['thumbnail'] = $DB.','.$request['thumbnail'];
                    }
                }
                $DB=null;$temp=null;
            }
            elseif(!$request->has('thumbnail'))
            {   
                $request['thumbnail'] = $verify->thumbnail;  
            }

            // Publisher
            if($request->has('publisher'))
            {   
                $DB = explode(',',$verify->publisher);
                // verify if the record exists already
                if(is_array($DB))
                {     
                    // If the request->publisher contains a , 
                    if(strpos($request['publisher'],','))
                    {
                        $var = explode(',', $request['publisher']);
                        $char = explode(',',$verify->publisher);
                        foreach ($var as $value) 
                        {
                            if(!in_array($value,$DB))
                            {
                                array_push($DB,$value);
                            }
                            else{
                                $MessageBag->add('publisher','The publisher "'.$request['publisher'].'" already exists in database.Please add a new one');
                            }
                        }
                        $request['publisher'] = implode(',',$DB);
                    }
                    // If the request->publisher has no ,
                    else
                    {
                        if(!in_array($request['publisher'], $DB))
                        {
                            $temp = array_push($DB, $request['publisher']);
                            $request['publisher'] = implode(',',$DB);
                        }
                        else
                        {
                            $MessageBag->add('publisher','The publisher "'.$request['publisher'].'" already exists in database.Please add a new one');
                        }
                    }
                }
                else
                {
                    if($DB===$request['publisher'])
                    {
                        $MessageBag->add('publisher','The publisher "'.$request['publisher'].'" already exists in database.Please add a new one');
                    }
                    else
                    {
                        $request['publisher'] = $DB.','.$request['publisher'];
                    }
                }
                $DB=null;$temp=null;
            }
            elseif(!$request->has('publisher'))
            {   
                $request['publisher'] = $verify->publisher;  
            }

            // Published_on
            if($request->has('published_on'))
            {   
                $DB = explode(',',$verify->published_on);
                // verify if the record exists already
                if(is_array($DB))
                {     
                    // If the request->published_on contains a , 
                    if(strpos($request['published_on'],','))
                    {
                        $var = explode(',', $request['published_on']);
                        $char = explode(',',$verify->published_on);
                        foreach ($var as $value) 
                        {
                            if(!in_array($value,$DB))
                            {
                                array_push($DB,$value);
                            }
                            else{
                                $MessageBag->add('published_on','The published_on "'.$request['published_on'].'" already exists in database.Please add a new one');
                            }
                        }
                        $request['published_on'] = implode(',',$DB);
                    }
                    // If the request->published_on has no ,
                    else
                    {
                        if(!in_array($request['published_on'], $DB))
                        {
                            $temp = array_push($DB, $request['published_on']);
                            $request['published_on'] = implode(',',$DB);
                        }
                        else
                        {
                            $MessageBag->add('published_on','The published_on "'.$request['published_on'].'" already exists in database.Please add a new one');
                        }
                    }
                }
                else
                {
                    if($DB===$request['published_on'])
                    {
                        $MessageBag->add('published_on','The published_on "'.$request['published_on'].'" already exists in database.Please add a new one');
                    }
                    else
                    {
                        $request['published_on'] = $DB.','.$request['published_on'];
                    }
                }
                $DB=null;$temp=null;
            }
            elseif(!$request->has('published_on'))
            {   
                $request['published_on'] = $verify->published_on;  
            }

        // Step 3 : Return Errors for duplicate data : If not then proceed.

            if(!empty($MessageBag->messages()))
            {
                return response()->json(['errors'=>$MessageBag->messages()],200);
            }
            // proceed


        // Step 4 : Update Data or Obevrt Data.

            $Nodes = NodeSetting::where('newspaper_id',$name->id)->update([
                'article' => $request['article'],
                'link' => $request['link'], 
                'title' => $request['title'], 
                'body' => $request['body'], 
                'thumbnail' => $request['thumbnail'], 
                'publisher' => $request['publisher'], 
                'published_on' => $request['published_on'],
            ]);

        }
        elseif(!$verify)
        {    
            $Nodes = NodeSetting::create([
                'newspaper_id' => $name->id,
                'article' => $request['article'],
                'link' => $request['link'], 
                'title' => $request['title'], 
                'body' => $request['body'], 
                'thumbnail' => $request['thumbnail'], 
                'publisher' => $request['publisher'], 
                'published_on' => $request['published_on'],
            ]);
        }


        // Step 5 : Redirect the nigga's back to where they came from... 
        
        return redirect()->back();

    }

    public function articlesStore(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => [ 'required','string','max:80' ],
            'body' => [ 'required' ],
            'thumbnail' => [ 'image' ], // Image means Jpg,Jpeg,Png,Svg,Bmp
            'published_on' => [ 'date' ],
        ]);



        // Validate image format to be Jpeg,Jpg,Png
        if($request->hasFile('thumbnail'))
        {
            // hasFile() for file fields and has() for other fileds
            $extension = $request->file('thumbnail')->getClientOriginalExtension();

            $array = array('jpeg','jpg','png','svg');
            if (!in_array($extension, $array))
            {
                return response()->json([
                    'error'=>
                    ['thumbnail' =>
                        ['The Image must be of Jpeg,Jpg or Png formats.']
                    ]
                ],200);
            }

        }

        elseif(!$request->hasFile('thumbnail')){
            $request->thumbnail='thumbnail';
        }

        // If the validation fails

        if (!$validator->passes()) {
            return response()->json(['error'=>$validator->errors()],200);
        }
                echo "here";exit();

        // Persist Data -------------------

        // Upload thumbnail to server
        if($request->hasFile('thumbnail'))
        {
            $uploads_dir = 'E:/xampp/htdocs/Projects/project8/p1/public/images/articles';
            $tmp_name = $request->thumbnail->getPathname();
            $filename = rand().$request->thumbnail->getClientOriginalName();
            $ifuploaded=move_uploaded_file($tmp_name, "$uploads_dir/$filename");
            if(!$ifuploaded){
                return response()->json([
                        'error'=>
                        ['thumbnail' =>
                            ["Sorry We Could'nt upload your thumbnail to our server.Please try again later."]
                        ]
                    ],200);
            }
        }


        // Creating excerpt from body
        if($request->has('body')){
            $explode = explode("p>", $request->body);
            $excerpt = substr($explode[1], 0,100).'...';
        }

        // Use of ternary operator
        if($request->has('published_on')) {
            $published_on = $request->published_on;
        }
        elseif(!$request->has('published_on'))
        {
            $published_on = now();
        }

        // create the link for custom article
        $explode = explode(' ', $request->title);

        $link = null;

        foreach ($explode as $value) {
            $link.=$value.'-';
        }

        $link = rtrim($link,'-'); //  remove the last - 
        // link created

        echo($request->title);
        echo($request->excerpt);
        echo($request->body);
        echo($request->thumbnail);
        echo($request->link);
        echo($request->published_on);
        exit();
        $article = Article::create([
                'newspaper_id' => '4', // for system news id = 1
                'title' => $request->title,
                'excerpt' => $excerpt,
                'body' => $request->body,
                'thumbnail' => $request->thumbnail,
                'link' => $link,
                'publisher' => auth()->name,
                'published_on' => $published_on
        ]);

        return redirect('/articles');
    }

    public function getArticles()
    {   
        ini_set('max_execution_time', 300); //  run the script until it terminates itself

        // Note : these are all nodes

        // for dawn
            // $dawn = 'https://www.dawn.com/latest-news';
            // $S_article = array('article','nigga');
            // $S_link = array('h2 > a');
            // $S_publisher = array('.story__byline__link','.story__authors__name > a');
            // // $S_publisherlink = array();
            // $S_thumbnail = array('figure > .media__item > picture > img','picture > img');
            // $S_body = array('.story__content') ;
            // $S_title = array('.template__header > .story__title','.template__header > .flex > .flex__item > h2 > a','.story__title > .story__link');
            // // $S_excerpt = array();
            // $S_published_on = array('.story__time');
        // // for dawn

        // for the news international
            // $thenewsinternational = 'https://www.thenews.com.pk/latest/category/pakistan';
            // $S_article = array('.writter-list-item > ul > li > .writter-list-item-story');
            // $S_link = array('.latest-right > h2 > a');
            // $S_publisher = array('.detail-left-tittle > .category-source');
            // // $S_publisherlink = =;
            // $S_thumbnail =array('.detail-center > .story-detail > .medium-insert-images > figure > img');
            // $S_body = array('.detail-center > .story-detail') ;
            // $S_title = '.latest-right > h2 > a';
            // $S_excerpt = '.latest-right > p';
            // $S_published_on = array('.latest-right > .latestDate');
        // for the news international

        // pictureperfect taskleft : have to make the system fetch nodes for each newspaper stores in database and store articles accordingly.

        // Note ::::: I will use foreach loop for the above settings that way if i dont get the lets say $body from the nodes defined in array index 1 i will use the next array index to find the $body and if i still dont get the $body i will write 'body' in the db body coloumn and that will not be shown to the users.The Admin will then find new nodes and insert them into the $S_body array which will then be used with foreach loop.



        // Step : 1 ***************** Find newspapers and their configure nodes
        $websites = Newspaper::all();

        foreach ($websites as $website) 
        {
            $nodeSetting = NodeSetting::where('newspaper_id',$website->id)->first();//dump($nodeSetting);
            $S_article = explode(',', $nodeSetting->article);//dump($S_article);
            $S_link = explode(',', $nodeSetting->link);//dump($S_link);
            $S_publisher = explode(',', $nodeSetting->publisher);//dump($S_publisher);
            // $S_publisherlink = explode(',', $nodeSetting->article);//dump($S_article);
            $S_thumbnail = explode(',', $nodeSetting->thumbnail);//dump($S_thumbnail);
            $S_body = explode(',', $nodeSetting->body);//dump($S_body);
            $S_title = explode(',', $nodeSetting->title);//dump($S_title);
            // $S_excerpt = explode(',', $nodeSetting->article);//dump($S_article);
            $S_published_on = explode(',', $nodeSetting->published_on);//dump($S_published_on);



            // Step : 2 ***************** Crawl To The Said News Website

            $crawler = GoutteFacade::request('GET', $website->link);


            // Step : 3 ***************** Loop throught each article node.

            foreach ($S_article as $S_article) 
            {
                // Step : 3.1 ***************** Find the link of each article form one node and go on that link.
                $crawler->filter($S_article)->each(function ($node) use($website,$S_link,$S_publisher,$S_thumbnail,$S_body,$S_published_on,$S_title) 
                {
                    // Step : 4 ***************** Loop throught the nodes defined in settings of link.
                    foreach ($S_link as $S_link) 
                    {

                        // Step : 4.1 ***************** Find Article Link and Request for it

                        $link = $node->filter($S_link)->attr('href'); //  find the link
                        
                        $verifyLink = Article::where('link',$link)->first(); // verify the link existance from DB

                        if($verifyLink!==null){  goto nextArticle;  } // goto nextarticle if link exists in DB

                        dump('link => '.$link);
          
                        $crawlerLink = GoutteFacade::request('GET', $node->filter($S_link)->attr('href')); // request for link

                            // Next Page..........

                            // Step : 4.2 ***************** Find Publisher Details : loop through the the nodes defined in settings of publisher.

                            $publisher=null; 
                            $publisherlink=null;

                            foreach ($S_publisher as $S_publisher) 
                            {
                                if($publisher==null)
                                {
                                    // Try to find publisher name for 3 times.break on find.
                                    for ($i=0; $i < 3; $i++) 
                                    {
                                        $publisher = $crawlerLink->filter($S_publisher)->text();
                                        
                                        if(!$publisher==null || !empty($publisher) || !$publisher==''){ break; }
                                    }
                                }

                                if($publisherlink==null)
                                {
                                    // Try to find publisher link for 3 times.break on find.
                                    for ($i=0; $i < 3; $i++) 
                                    {
                                        $publisherlink = $crawlerLink->filter($S_publisher)->attr('href');

                                        if(!$publisherlink==null || !empty($publisherlink) || !$publisherlink==''){ break;  }
                                    }
                                }
                                
                                // if both link and name are found then break foreach Loop.
                                if((!$publisher==null || !empty($publisher) || !$publisher=='') && (!$publisherlink==null || !empty($publisherlink) || !$publisherlink==''))
                                {
                                    dump('publisher => '.$publisher);dump('publisherlink => '.$publisherlink);
                                    break;
                                }
                            }


                            // Step : 4.3 ***************** Find thumbanil : loop through the the nodes defined in settings of thumbnails.
                            foreach ($S_thumbnail as $S_thumbnail) 
                            {
                                // Try to find thumbnail for a max of 3 times.break on (find+save).
                                for ($i=0; $i < 3 ; $i++) 
                                {
                                    $thumbnail = $crawlerLink->filter($S_thumbnail)->attr('src');
                                    
                                    // if found
                                    if(!$thumbnail==null || !empty($thumbnail) || !$thumbnail=='')
                                    {
                                        dump($thumbnail);

                                        // Make the link correct for https:
                                        $image = $thumbnail;
                                        if(strpos($thumbnail, 'https:'))    {   $image = 'https:'.$thumbnail;   }


                                        // calculate image name and path and save it to directory.then break if saved.
                                        $thumbnail = '/images/newspapers/thumbnails/'.basename($image);
                                        $path = './images/newspapers/thumbnails/'.basename($image);
                                        $file = file_get_contents($image);
                                        $save = file_put_contents($path, $file);
                                        if($save){  break;  }
                                    }
                                    
                                    dump($i.' try for $thumbnail');
                                }

                                if(!$thumbnail==null || !empty($thumbnail) || !$thumbnail=='')  
                                {   
                                    dump('thumbnail => '.$thumbnail);   
                                    break;  
                                }

                            }
                         

                            // Step : 4.4 ***************** Find Body : loop through the the nodes defined in settings of body.
                            foreach ($S_body as $S_body) 
                            {   
                                // Try to find body for a max of 3 times.break on find.
                                for ($i=0; $i < 3; $i++) 
                                {
                                    $body=$crawlerLink->filter($S_body)->each(function ($nodeLink) 
                                    {
                                        // Find each <P> tag in the body content
                                        $body=$nodeLink->filter('p')->each(function ($nodeParagraph) 
                                        {
                                            $body = $nodeParagraph->text();
                                            return $body;
                                        });

                                        // Now convert the $body array into a string with <p> tags
                                        $arrayBulk = null;

                                        foreach ($body as $bodyvalue) { $arrayBulk .= '<p>'.$bodyvalue.'</p>';  }

                                        return $arrayBulk;
                                    });

                                    if(!$body==null || !empty($body) || !$body==''){    break;  }

                                    dump($i.' try for $body');
                                }

                                if(!$body==null || !empty($body) || !$body==''){    break;  }
                            }

                            // Return Back To Previous Page....... now we have body,thumbnail,publisher name and link


                            // Step : 4.4.1 ***************** Convert returned body array to string. 
                            $arrayBulk = null;

                            if(is_object($body) || is_array($body))
                            {
                                foreach ($body as $bodyvalue) { $arrayBulk .= $bodyvalue;   }
                            }

                            $body = $arrayBulk;

                            dump('body => '.$body);


                        // Step : 5 ***************** Find title
                        foreach ($S_title as $S_title) 
                        {
                            // Try to publisehd time for a max of 3 times.break on find.
                            for ($i=0; $i < 3; $i++) 
                            { 
                                $title = $crawlerLink->filter($S_title)->text(); // use $node in placeof $crawlerLink if you want to fetch from previous page

                                if(!$title==null || !empty($title) || !$title==''){    break;  }

                                dump($i.' try for $title');
                            }

                            if(!$title==null || !empty($title) || !$title=='')
                            {
                                dump('title => '.$title); break;
                            }
                        }
                        


                        // Step : 6 ***************** Find excerpt
                        $excerpt = $node->filter('.story__excerpt')->text();    dump('excerpt => '.$excerpt);
                    

                        // Step : 7 ***************** Find published-time : loop through the the nodes defined in settings of published-time.
                        foreach ($S_published_on as $S_published_on) 
                        {   
                            // Try to publisehd time for a max of 3 times.break on find.
                            for ($i=0; $i < 3; $i++) 
                            { 
                                $published_on = $crawlerLink->filter($S_published_on)->text();// use $node in placeof $crawlerLink if you want to fetch from previous page

                                if(!$published_on==null || !empty($published_on) || !$published_on==''){    break;  }

                                dump($i.' try for $published_on');
                            }

                            if(!$published_on==null || !empty($published_on) || !$published_on=='')
                            {
                                dump('published_on => '.$published_on); break;
                            }

                        }



                        // Step : 7 ***************** Verify,Validate and correct errors.

                        if($title==null)    {   $title='title'; }
                        if($excerpt==null){
                            if(!$body==null){
                                $explode = explode("p>", $body);
                                $excerpt = substr($explode[1], 0,100).'...';
                            }
                            else{
                                $excerpt='excerpt';
                            }
                        }
                        if($body==null){    $body='body';   dd('body is sill empty');   }
                        if($thumbnail==null){   $thumbnail='thumbnail'; }
                        if($link==null){    $link='link';   }
                        if($publisher==null){   $publisher='publisher'; }
                        if($published_on==null){    $published_on='published_on';   }




                        // Step : 8 ***************** Obvert the data to DB.

                        $article = Article::create([
                            'newspaper_id' => $website->id,
                            'title' => $title,
                            'excerpt' => $excerpt,
                            'body' => $body,
                            'thumbnail' => $thumbnail,
                            'link' => $link,
                            'publisher' => $publisher,
                            'published_on' => $published_on
                        ]);


                        // Step : 9 ***************** Go to next article.
                        nextArticle:

                        dump('------------------******************-----------------****************-------------------');

                    }   // end $S_link foreach loop

                });

            }


        }

        dd('All Articles Feteched From Various NewWire Sources.....');
        // return redirect('/getPolarities');
    }


    public function actorsIndex() // Reference Symfony Domcrawler.pdf
    {
        $actors = Actor::all();

        return view('admin.actors',['actors'=>$actors]);
    }


    // find articles and update last line of polarities and actors method

    // throw the noun calculation part in this method
    public function getPolarities()
    {   
        ini_set('max_execution_time', 300);


        // Step : 1 ************ Start Polarity Engines...
        $PHPSentimentAnalyzer = new Analyzer(); // PHP sentiment analyzer package
        $PHPInsight = new Sentiment(); // PHP Insight Package From Packagist.(now depricated)

        if($PHPSentimentAnalyzer){ dump('PHPSentimentAnalyzer Engine Running...'); }
        if($PHPInsight){ dump('PHPInsight Engine Running...'); }



        // Step : 2 ************ Find the articles which are not analyzed for polarities...
        $articles = Article::select('id','body')->where('polarity','0')->orWhere('ratedFor',0)->get();// returns a collection use isEmpty for collection
        
        if($articles->isEmpty()){ dd('All Calculations Performed For Polarities.'); } // if the articles object is null

        // Step : 3 ************ Loop through the articles object and analyze polarities
        foreach($articles as $article)
        {  
            // Step : 3.1 ************ break the article body and remove <p> tags.
            $explode1 = explode('</p>', $article->body);    $implode1 = implode("", $explode1);
            $explode2 = explode('<p>', $implode1);  $implode2 = implode("", $explode2);

            $textToAnalyze = $implode2; dump($textToAnalyze);
            


            // Step : 3.2 ************ Find polarities and persist it with engine 1 ...
            $analyzer = $PHPSentimentAnalyzer->getSentiment($textToAnalyze);    

                if(!$analyzer){
                    goto next;
                }
                dump($analyzer);

                // Persist The Data To Polarity Table
                    $polarity = Polarity::create([
                        'article_id' => $article->id,
                        'system' => 1, 
                        'positive' => $analyzer['pos']*100,
                        'negative' => $analyzer['neg']*100,
                        'neutral' => $analyzer['neu']*100,
                    ]);
                // Persist The Data To Polarity Table


            // Step : 3.3 ************ Find polarities and persist it with engine 2 ...
            $sentiment = $PHPInsight->score($textToAnalyze);    
            $dominant = $PHPInsight->categorise($textToAnalyze);    

                if(!$sentiment){
                    goto next;
                }
                dump($sentiment);
                dump($dominant);

                // Persist The Data To Polarity Table
                    $polarity = Polarity::create([
                        'article_id' => $article->id,
                        'system' => 2, 
                        'positive' => $sentiment['pos']*100,
                        'negative' => $sentiment['neg']*100,
                        'neutral' => $sentiment['neu']*100,
                    ]);
                // Persist The Data To Polarity Table


            // Step : 3.4 ************ Find dominant polarity here ...
                    #
                    #
                    #
                    #
                    #
            

            // Step : 3.5 ************ Persist dominant polarity to relevant Article ... 
            $dominant = Article::where('id',$article->id)->update([
                'polarity' => $dominant,
                'ratedFor' => 1,
            ]);

            dump('____________________________________________');
            next:
        }


        dd('All Calculations Performed For Polarities.');

        return redirect('/admin');
    }



    public function getActors()
    {   
        ini_set('max_execution_time',300);

        $articlesUnrated  = Article::select('id','body')->where('ratedFor',1)->get();

        if(!is_object($articlesUnrated))
        {   
            dd('No Articles To Analyze Actors For...');
        }

        foreach ($articlesUnrated as $singleUnrated) 
        {
            $temp_1 = explode('<p>',$singleUnrated->body);$temp_2 = implode('',$temp_1);
            $temp_3 = explode('</p>', $temp_2);$temp_4 = implode('',$temp_3);

            $paragraph = $temp_4; // the body of the article withour <p> tags

            // Step : 1 *************  analyze the body for nouns

            $Nouns = Array();
            $eachWord = explode(' ', $paragraph); // explode the paragraph into array

            for ($i = 0; $i < count($eachWord); $i++) 
            {
                // if the word is a noun
                if (preg_match('/^([A-Z])(?!.*?[?!@$%^*])(?!\.\s?[A-z][a-z]).*$/', $eachWord[$i]) > 0) 
                {
                    $proper_noun = $eachWord[$i]; // a variable to store this word
                    $index = 1;
                    while (true) 
                    {
                          if ($i + $index < count($eachWord)) 
                          {
                              if (preg_match('/[A-Z]/', $eachWord[$i + $index]) > 0) {
                                  $proper_noun = $proper_noun." ".$eachWord[$i + $index];
                                  $index++;
                              }
                              else {
                                  $i = $i + $index - 1;
                                  break;
                              }
                          }
                          else {
                              break;
                          }
                    }
                    array_push($Nouns, $proper_noun); // insert that noun to Nouns array
                }
            }

            $noun = array_unique($Nouns); // find the unique nouns

            dump($noun); // dump the unique nouns ...

            sleep(1); //  wait for 1 second ...



            // Step : 2 ************* loop through the nouns and find existance in tables

            foreach ($noun as $properNoun) 
            {
                // Nodes configuration
                $wikipedia = 'https://www.wikipedia.org';// $searchForm '.search-container > form > fieldset';// $searchItem = ' .search-input > #searchInput';// $searchTitle = '.pure-button';// $searchContent = '.pure-button';


                // Step : 3.1 ************** Find if the noun is in the noun table
                $verifyNoun = Noun::where('noun',$properNoun)->first();
                if(!$verifyNoun){
                    $insertNoun = Noun::create([
                      'article_id' => $singleUnrated->id,
                      'noun' => $properNoun,
                    ]);
                }


                // Step : 3.2 ************** Find if the noun is in the actor table
                $verifyActor = Actor::where('name',$properNoun)->first();
                // if the both noun and actor and are present then goto nextNoun;
                if($verifyActor && $verifyNoun){
                    goto next;
                }
               


                // Step : 3.3 ************** Search The Actor data(Noun) from wikipedia 

                $crawler_page1 = GoutteFacade::request('GET',$wikipedia);  // Goutte Crawler built on top of SymfonyDOMCrawler
                

                $form = $crawler_page1->filter('form[id=search-form]')->form(); // Find search form and call form() method from symfony\dom-crawler\crawler.php
                $form->setValues(array('search' => $properNoun)); // input name='search' and value='here'

                // check here for ul li pictureperfectase if not found goto next step 3.4



                $crawler_page1 = GoutteFacade::submit($form); // submit the form
                $response = redirect($form->getUri()); // get the response corresponding to search
                $theLink = $response->gettargetUrl(); // get the redirect link from response


                // Step : 3.5 ************** If The <ul> <li> appears then go to that link

                $crawler_page2 = GoutteFacade::request('GET',$theLink);
                $heading = $crawler_page2->filter('#firstHeading')->text(); // fetch the heading like Name
                if($heading == 'Search results'){
                    dump('Not a valid search coupon ,search result is => "'.$heading.'"...Going to next.........');
                    // if the heading is search results then goto next noun yani agr wikipeida py data nhi mila
                    goto next;
                }


                // Step : 3.6 ************** If the heading is not 'Search results' Check for avaliability in the Actor table 
                $actor = Actor::where('name',$heading)->first();
                if($actor){
                    dump('Noun found in Actor table,noun is => "'.$heading.'"...Going to next........');
                    // pictureperfect update code here for adding a view to appeared in
                    // if the actor is found then goto the next noun ...
                    goto next;
                }


                // Step : 3.7 ************** If all of the above conditions are met and we have a Full Fleged ProperNoun then fetch info body from wikipedia

                $content = $crawler_page2->filter('#content > #bodyContent > #mw-content-text > .mw-parser-output')->each(function ($node){

                    // Step : 3.8 ************** Fetch Thumbnail
                    $thumbnail = $node->filter('.infobox > tbody > tr > td > a > img')->extract(array('src'));//->attr('src');

                    if($thumbnail) //  save the image
                    {
                        $image = 'https:'.$thumbnail[0];

                        $path = '/images/actors/thumbnails/'.rand().basename($image);
                        $file = file_get_contents($image);
                        $save = file_put_contents($path, $file);

                        dump('Thumbnail Image Saved.');
                    }

                    
                    // Step : 3.9 ************** Fetch OtherPictures
                    $otherPics = Array();
                    $images = $node->filter('.thumb > .thumbinner > .image > .thumbimage')->each(function($node) use(&$otherPics)
                    {
                        $pictures = $node->extract(array('src'));//->attr('src');

                        if($pictures)
                        {
                            $picture = 'https:'.implode($pictures);//dd($image);

                            $path = '/images/actors/pictures/'.rand().basename($picture);
                            $file = file_get_contents($picture);
                            $save = file_put_contents($path, $file);

                            array_push($otherPics, $path);

                            dump('Picture Saved To Gallery.');
                        }

                        //dump('picture node empty => nodename is ↓ ');dump($node);// yahan py empty nhi hti validated

                    });


                    // Step : 3.10 ************** Fetch Body and sort it
                    dump('Body ( Finding,calculating and sorting headings/paragraphs ).');
                    $bodyArray = $node->children()->each(function($paragraph){

                        if($paragraph->matches('p') || $paragraph->matches('h1') || $paragraph->matches('h2') || $paragraph->matches('h3') || $paragraph->matches('h4') || $paragraph->matches('h5') || $paragraph->matches('h6'))
                        {   
                            $text = $paragraph->text();

                            if($text==null || $text==''){
                                goto nextparagraph;
                            }

                            if($text=='See also'){
                              // return on 'see also'
                              return;
                            }

                            // triming citation signs [] // will use regex. pictureperfectcase

                            $tag=$paragraph->nodeName().'>';

                            $paragraphs = '<'.$tag.$text.'</'.$tag;

                            return $paragraphs; //  add to $bodyArray array

                            nextparagraph:
                        }

                    }); // $body end

                    // dump($bodyArray); // all tags and their values in array in array

                    // Step : 3.11 ************** Sort and return the data calculated ...
                    $body=implode($bodyArray);

                    if($path==null || $path=='' || empty($path)){ $path='thumbnail'; }
                    if($otherPics==null || $otherPics=='' || empty($otherPics)){ $otherPics='otherPics'; }
                    if($body==null || $body=='' || empty($body)){ $body='body'; }

                    if(is_array($path)){ $path=$path[0]; } // if thumbnail is array then give index[0]

                    $toReturn  = array($path,$otherPics,$body);

                    return $toReturn;

                }); // $content end and data returned to $content


                // Step : 3.12 ************** Calculated the data returned ...
                //$Content = $content[0];//implode($content);//  'C.ontent[1]' is array of otherPics

                if(is_array($content[0][1]))
                {
                    $pics = $content[0][1];
                    $compoundPics = null;
                    foreach ($pics as $value) 
                    {
                        $compoundPics.='|'.$value; 
                    }
                }
                elseif(!is_array($content[0][1])){
                    $compoundPics = $content[0][1];
                }

                // giving the user some info
                dump('Name = > '.$heading);    //  heading
                dump('Profile Picture = > '.$content[0][0]); //  thumbnail
                dump('Gallery Pictures = > '.$compoundPics);// otherpics
                dump('Body => '.$content[0][2]); //  body with calculated tags


                // Step : 4 **************** Persist Data to table
                $actor = Actor::create([
                    'name' => $heading,
                    'info' => $content[0][2],
                    'pictures' => $compoundPics,
                    'thumbnail' => $content[0][0],
                    // 'cardInfo' => ,
                    'appearedIn' => 1,
                ]);

                dump('Actor Saved');
            
                next:


            } // end foreach of noun array

            $updateArticle = Article::where('id',$singleUnrated->id)->update([
                'ratedFor' => 2 ,
            ]);
            dump('Article Updated For An Actor_________________________________________.');
        }

        dd('All Calculations Performed For Actors');

        return redirect('/getPolarities');
    }

    public function test(Request $request)
    {
        // 677

        // $str = 'article,nigga';
        // $find = ',';
        // $start = strpos($str,$find);
        // dd($start);


        
        $broken = Article::where('title','title')->orWhere('excerpt','excerpt')->orWhere('body','body')->orWhere('thumbnail','thumbnail')->orWhere('publisher','publisher')->orWhere('published_on','published_on')->get();

        if(empty($broken))
        {   
            dd('Nothing To Fix');
            return;
        }

        foreach ($broken as $broken) 
        {  
            $crawler = GoutteFacade::request('GET', $broken->link);

            $nodes = NodeSetting::where('newspaper_id',$broken->newspaper_id)->first();
            
            $S_title = explode(',', $nodes->title);//dump($S_title);
            $S_body = explode(',', $nodes->body);//dump($S_body);
            $S_thumbnail = explode(',', $nodes->thumbnail);//dump($S_thumbnail);
            $S_publisher = explode(',', $nodes->publisher);//dump($S_publisher);
            $S_published_on = explode(',', $nodes->published_on);//dump($S_published_on);


            if($broken->title=='title')
            {   
                foreach ($S_title as $S_title) 
                {
                    $title = $crawler->filter($S_title)->text();

                    if($title!==null || !empty($title))
                    {
                        dump('Title => '.$title);
                        break;
                    }
                }
            }
            if($broken->body=='body')
            {
                foreach ($S_body as $S_body) 
                {
                    $body = $crawler->filter($S_body)->text();

                    if($body!==null || !empty($body))
                    {
                        dump('Body => '.$body);
                        break;
                    }
                }
            }
            if($broken->thumbnail=='thumbnail')
            {   
                foreach ($S_thumbnail as $S_thumbnail) 
                {
                    $thumbnail = $crawler->filter($S_thumbnail)->text();

                    if($thumbnail!==null || !empty($thumbnail))
                    {
                        dump('Thumbnail => '.$thumbnail);
                        break;
                    }
                }
            }
            if($broken->publisher=='publisher')
            {   
                foreach ($S_publisher as $S_publisher) 
                {
                    $publisher = $crawler->filter($S_publisher)->text();

                    if($publisher!==null || !empty($publisher))
                    {
                        dump('Publisher => '.$publisher);
                        break;
                    }
                }
            }
            if($broken->published_on=='published_on')
            {   
                foreach ($S_published_on as $S_published_on) 
                {
                    $published_on = $crawler->filter($S_published_on)->text();

                    if($published_on!==null || !empty($published_on))
                    {
                        dump('Published_On => '.$published_on);
                        break;
                    }
                }
            }

            // Check if variable are not set : true then set them.

            if(!isset($title)){$title = $broken->title;}
            if(!isset($body)){$body = $broken->body;}
            if(!isset($thumbnail)){$thumbnail = $broken->thumbnail;}
            if(!isset($publisher)){$publisher = $broken->publisher;}
            if(!isset($published_on)){$published_on = $broken->published_on;}
            // Update Db

            $articleUpdate = Article::where('link',$broken->link)->update([
                'title' => $title,
                'body' => $body,
                // 'thumbnail' => $thumbnail,
                'publisher' => $publisher,
                'published_on' => $published_on,
            ]);

        }




            dd('end');



























        // current logic

        $request = collect(['newswire' => 'scbjsbvcj','link' => 'xyzabcdefghijklmnopqrstuvwxyz']);

        // Validation -------------------- 
        $validator = Validator::make($request->all(), [
            'newswire' => [ 'required','string','exists:newspapers,name'],
            'link' => ['string','max:8'],
        ]);

        // If the validation fails
        if (!$validator->passes()) {
            // $x= new MessageBag;
            // $x->add('mykey','thi8s is my key');
            // $x->add('mykey2','thi8s is my key');
            // // $x->messages = array('x'=>'bfjsbc','y'=>'sjdsjcv');
            // // $x->format='message';
            // if(!empty($x->messages())){ //dump($x->getMessageBag());
            // }
            // else{dump('no message in message bag');}


            // dd($x->messages());
            // // dd($validator->getMessageBag()->add('mykey','thi8s is my key'));

            // // dump('last');
            // dd($validator->errors());
            // echo response()->json(['error'=>$validator->errors()],200);exit();
            // return response()->json(['error'=>$validator->errors()],200);


            // Step 1 : Make a message bag and the add to it accordingly
                $MessageBag = new MessageBag;
                $MessageBag->add('article','The article '.'$here'.' already exists in database.Please add a new one');
                $MessageBag->add('link','The link '.'$here'.' already exists in database.Please add a new one');
                $MessageBag->add('title','The title '.'$here'.' already exists in database.Please add a new one');
                $MessageBag->add('body','The body '.'$here'.' already exists in database.Please add a new one');
                $MessageBag->add('thumbnail','The thumbnail "'.'$here'.'" already exists in database.Please add a new one');
                $MessageBag->add('publisher','The publisher '.'$here'.' already exists in database.Please add a new one');
                $MessageBag->add('published_on','The published_on '.'$here'.' already exists in database.Please add a new one');
                // $MessageBag = add('','');

            // Step 2 : Verify for existance of messages in the bag : true then return : false then proceed
                // if the bag has something then return
                if(!empty($MessageBag->messages()))
                {
                    return response()->json(['errors'=>$MessageBag->messages()],200);
                }
                // proceed
                dd('I am here');

        }
        dd('Logic end');

        // current logic 



        $dawn = 'https://www.dawn.com/latest-news';
        $S_article = array('article','nigga');
        $S_link = array('h2 > a');
        $S_publisher = array('.story__byline__link','.story__authors__name > a');
        // $S_publisherlink = array();
        $S_thumbnail = array('figure > .media__item > picture > img','picture > img');
        $S_body = array('.story__content') ;
        $S_title = array('.template__header > .story__title','.template__header > .flex > .flex__item > h2 > a','.story__title > .story__link');
        // $S_excerpt = array();
        $S_published_on = array('.story__time');


// Insertion


        // Make a string of all nodes
        // $Title_S = explode(',',$S_title);
        $Article_S = implode(',',$S_article);//dump($Article_S);
        $Link_S = implode(',',$S_link);//dump($Link_S);
        $Title_S = implode(',',$S_title);//dump($Title_S);
        $Body_S = implode(',',$S_body);//dump($Body_S);
        $Thumbnail_S = implode(',',$S_thumbnail);//dump($Thumbnail_S);
        $Publisher_S = implode(',',$S_publisher);//dump($Publisher_S);
        $PublishedOn_S = implode(',',$S_published_on);//dump($PublishedOn_S);
        // if(is_array($Article_S)){dd('article is array');}
        // if(is_array($Link_S)){dd('link is array');}
        // if(is_array($Title_S)){dd('title is array');}
        // if(is_array($Body_S)){dd('body is array');}
        // if(is_array($Thumbnail_S)){dd('thumbnail is array');}
        // if(is_array($Publisher_S)){dd('publisher is array');}
        // if(is_array($PublishedOn_S)){dd('published_on is array');}
        //     $Nodes = NodeSetting::create([
        //             'newspaper_id' => 1,
        //             'article' => $Article_S,
        //             'link' => $Link_S, 
        //             'title' => $Title_S, 
        //             'body' => $Body_S, 
        //             'thumbnail' => $Thumbnail_S, 
        //             'publisher' => $Publisher_S, 
        //             'published_on' => $PublishedOn_S,
        //         ]);
        // dump('here');dd('end here');exit();echo "1";





        $request->news = 1;
        $request->link = 'newone';
        // Verfiy for existance in database
        $verify = NodeSetting::where('newspaper_id',$request->news)->first();//dd($verify);
        if($verify)
        {    
            // Concatenate with already present data in database
            if($request->article)
            {   
                $DB = explode(',',$verify->article);
                // verify if the record exists already
                if(is_array($DB))
                {     
                    // If the request->article contains a , 
                    if(strpos($request->article,','))
                    {
                        $var = explode(',', $request->article);
                        $char = explode(',',$verify->article);
                        foreach ($var as $value) 
                        {
                            if(!in_array($value,$DB))
                            {
                                array_push($DB,$value);
                            }
                        }
                        $request->article = implode(',',$DB);
                    }
                    // If the request->article has no ,
                    else
                    {
                        if(!in_array($request->article, $DB))
                        {
                            $temp = array_push($DB, $request->article);
                            $request->article = implode(',',$DB);
                        }
                        else
                        {
                            dd('Found in DB array');
                        }
                    }
                }
                else
                {
                    if($DB===$request->article)
                    {
                        dd('This Article node is already present');
                    }
                    else
                    {
                        $request->article = $DB.','.$request->article;
                    }
                }
                $DB=null;$temp=null;
            }
            elseif(!$request->article)
            {   
                $request->article = $verify->article;  
            }

            // Update database
            $Nodes = NodeSetting::where('newspaper_id',$request->news)->update([
                'article' => $request->article,
                'link' => $request->link, 
                'title' => $request->title, 
                'body' => $request->body, 
                'thumbnail' => $request->thumbnail, 
                'publisher' => $request->publisher, 
                'published_on' => $request->published_on,
            ]);
        }
        elseif(!$verify)
        {
            // Insert into database
            $Nodes = NodeSetting::create([
                'newspaper_id' => $request->news,
                'article' => $request->article,
                'link' => $request->link, 
                'title' => $request->title, 
                'body' => $request->body, 
                'thumbnail' => $request->thumbnail, 
                'publisher' => $request->publisher, 
                'published_on' => $request->published_on,
            ]);
        }

        dd('End of debugger');
        // Debugging : will give original results as in DB
        // dd('request => '.$request->article);
        // dump('request => '.$request->link);
        // dump('request => '.$request->title);
        // dump('request => '.$request->body);
        // dump('request => '.$request->thumbnail);
        // dump('request => '.$request->publisher);
        // dd('request => '.$request->published_on);

        

        if($Nodes){
            dd('inserted');
        }
        dd('could not insert');


//










        $array = 'new|old|abc|def';

        $explode = explode('|',$array);

        $new = array_push($explode,'var','rar','car');

        dump($explode);

        $implode = implode('|',$explode);

        dd($implode);









        $crawler_page1 = GoutteFacade::request('GET','https://www.wikipedia.org');  // Goutte Crawler built on top of SymfonyDOMCrawler
                

        $form = $crawler_page1->filter('form[id=search-form]')->form(); // Find search form and call form() method from symfony\dom-crawler\crawler.php
        $form->setValues(array('search' => 'Imran Khan')); // input name='search' and value='here'

        // check here for ul li pictureperfectase if not found goto next step 3.4
        sleep(1);
        $suggestions = $crawler_page1->filter('div[id=typeahead-suggestions]');
        

        if($suggestions){
            dump('if');
            dd($suggestions->text());
        }
        elseif(!$suggestions){
            dump('else');
            dd($suggestions->text());
        }

        $crawler_page1 = GoutteFacade::submit($form); // submit the form
        $response = redirect($form->getUri()); // get the response corresponding to search
        $theLink = $response->gettargetUrl(); // get the redirect link from response


        // Step : 3.5 ************** If The <ul> <li> appears then go to that link

        $crawler_page2 = GoutteFacade::request('GET',$theLink);



        dd('Logic-End');





















        $verify = Noun::where('noun','vxsvxh')->first();
        $verify2 = Actor::where('name','vxsvxh')->first();

        if($verify && $verify2){
            dd('found');
        }
        elseif(!$verify){
            dd('not found');
        }
        dd($verify);

      //  my current logic find proper nouns from a string

//         $text='<p>The United States is helping Pakistan in fight against novel coronavirus with initial funding worth one million dollars. </p><p>US Principal Deputy Assistant Secretary of State for South and Central Asian Affairs, Alice Wells Friday said the United States would provide one million dollars to Pakistan under USAID programme to bolster the monitoring and rapid response against Coronavirus.</p><p>Pakistan is grappling with spread of the pandemic of pneumonic disease with over 440 confirmed infections across the country.</p><p>In a tweet, she said that U.S. and Pakistan both are longstanding partners in tackling global health challenges. “The U.S. government is responding to #COVID-19 in #Pakistan with initial $1 million in USAID Pakistan funding to bolster monitoring & rapid response,”  said the US official. </p><p>She further said that there are over hundred Pakistani graduates engaged in the lab training of Centers for Disease Control  and Prevention, investigating Coronavirus cases in Punjab and Gilgit Baltistan.</p>';
//         // /^((?!i|j|k|l|m|n|o|p|q|r|s|t|v|u|w|x|y|z|9).)*$/
//         $temp_1 = explode('<p>',$text);
//         $temp_2 = implode('',$temp_1);

//         $temp_3 = explode('</p>', $temp_2);
//         $temp_4 = implode('',$temp_3);

//         $paragraph = $temp_4;
// // ^([A-Z])(?!^[a-z].).*$
//         $proper_nouns = Array();
//         $words = explode(' ', $paragraph);
//         for ($i = 0; $i < count($words); $i++) {

//             // dump($words[$i]);


//             $reject = array('. The','.In');
//             if(strpos($words[$i],'.In')){
//                 // dd('this was rejected => '.$words[$i]);
//             }
//             // $words[$i]=explode('.',$words[$i]);

//             // dd($words[$i]);

//             if (preg_match('/^([A-Z])(?!.*?[?!@$%^*])(?!\.\s?[A-z][a-z]).*$/', $words[$i]) > 0) {
//                 $proper_noun = $words[$i];
//                 $index = 1;
//                 while (true) {
//                     if ($i + $index < count($words)) {
//                         if (preg_match('/[A-Z]/', $words[$i + $index]) > 0) {
//                             $proper_noun = $proper_noun." ".$words[$i + $index];
//                             $index++;
//                         }
//                         else {
//                             $i = $i + $index - 1;
//                             break;
//                         }
//                     }
//                     else {
//                         break;
//                     }
//                 }
//                 array_push($proper_nouns, $proper_noun);
//             }

//         }


//         dump($proper_nouns);
//         dd('Logic Ends Here');
//         // my current logic


        // my current logic

        $crawler = GoutteFacade::request('GET', 'https://en.wikipedia.org/wiki/United_States');

        $filter = $crawler->filter('#content > #bodyContent > #mw-content-text > .mw-parser-output')->each(function($node){

            $thumbnail = $node->filter('.infobox > tbody > tr > td > a > img')->extract(array('src'));//->attr('src');

            if($thumbnail){
                dump($thumbnail);

                $image = 'https:'.$thumbnail[0]; // $image = 'https:'.implode($thumbnail);

                $path = 'E:/xampp/htdocs/Projects/project8/p1/public/images/actors/thumbnails/'.basename($image);
                $file = file_get_contents($image);
                $save = file_put_contents($path, $file);

                dump('Image Saved');
            }

            $images = $node->filter('.thumb > .thumbinner > .image > .thumbimage')->each(function($node){

                $pictures = $node->extract(array('src'));//->attr('src');

                $picture = 'https:'.implode($pictures);//dd($image);

                $path = 'E:/xampp/htdocs/Projects/project8/p1/public/images/actors/pictures/'.basename($picture);
                $file = file_get_contents($picture);
                $save = file_put_contents($path, $file);

            });

            dump('Filter Not Found');

            return $thumbnail;
        });

        dd('Logic-End');

        // my current logic


        // 261

        // my current logic
        // 
        // 
        // 
        // 

        // for the news international
        $S_article = '.writter-list-item > ul > li > .writter-list-item-story';
        $S_link = '.latest-right > h2 > a';
        $S_publisher ='.detail-left-tittle > .category-source';
        // $S_publisherlink = =;
        $S_thumbnail ='.detail-center > .story-detail > .medium-insert-images > figure > img';
        $S_body = '.detail-center > .story-detail' ;
        $S_title = '.latest-right > h2 > a';
        $S_excerpt = '.latest-right > p';
        $S_published_on = '.latest-right > .latestDate';
        // for the news international
        // Fetch articles **********************************************************************

        $crawler = GoutteFacade::request('GET', 'https://www.thenews.com.pk/latest-stories');

        // Find The Article Tag on $crawler link
        $crawler->filter($S_article)->each(function ($node) use($S_link,$S_publisher,$S_thumbnail,$S_body,$S_title,$S_excerpt,$S_published_on) {

            // Find the Article link on that article tag
            $link = $node->filter($S_link)->attr('href');

            // Check if link is already saved in db
            $verifyLink = Article::where('link',$link)->first();
                // if saved then
                if($verifyLink!==null){
                    // dd('Link Is already in Database');   
                    goto nextArticle;// go to next article and skip fetching data for this article
                }
            dump('link => '.$node->filter($S_link)->attr('href'));
  
            
            // Request For That Above Article Link if not already saved in db
            $crawlerLink = GoutteFacade::request('GET', $node->filter($S_link)->attr('href'));


            // Find the publisher name from that link
            for ($i=0; $i < 3; $i++) 
            { 

                $publisher = $crawlerLink->filter($S_publisher)->text();
                
                if(!$publisher==null || !empty($publisher) || !$publisher==''){
                    dump('publisher => '.$crawlerLink->filter($S_publisher)->text());
                    break;
                }
                
                dump($i.' try for $publisher');  

            }
            

            // Find the publisher profilelink from that link
            $publisherlink = $crawlerLink->filter($S_publisher)->attr('href');
            dump('publisherlink => '.$crawlerLink->filter($S_publisher)->attr('href'));       
            

            // Find the article thumbnail form that link
            for ($i=0; $i < 3 ; $i++) 
            { 

                $thumbnail = $crawlerLink->filter($S_thumbnail)->attr('src');
                
                if(!$thumbnail==null || !empty($thumbnail) || !$thumbnail==''){
                    dump('thumbnail => '.$crawlerLink->filter($S_thumbnail)->attr('src'));
                    break;
                }
                
                dump($i.' try for $thumbnail');

            }
             

            // Find the body content from that link
            for ($i=0; $i < 3; $i++) 
            { 

                $body=$crawlerLink->filter($S_body)->each(function ($nodeLink) {

                // Find Each <P> Tag In The Body Content
                $body=$nodeLink->filter('p')->each(function ($nodeParagraph) {
                    $body = $nodeParagraph->text();
                    // dump($nodeParagraph->text());
                    return $body;
                });

                $arrayBulk = null;

                foreach ($body as $bodyvalue) {

                    $arrayBulk .= '<p>'.$bodyvalue.'</p>';
                }

                return $arrayBulk;
                
                
                });

                if(!$body==null || !empty($body) || !$body==''){
                    break;
                }
                dump($i.' try for $body');

            }
            // Return Back To Previous Page



            // convert the returned body array to string
            $arrayBulk = null;

            foreach ($body as $bodyvalue) {
                $arrayBulk .= $bodyvalue;
            }

            $body = $arrayBulk;
            dump('body => '.$body);
            // body arry to string converted


            // Find the Article Title from the first link
            $title = $node->filter($S_title)->text();
            dump('title => '.$node->filter($S_title)->text());

            // Find the Article Excerpt from the first link
            $excerpt = $node->filter($S_excerpt)->text();
            dump('excerpt => '.$node->filter($S_excerpt)->text());
            
            // Find the Article Time from the first link
            for ($i=0; $i < 3; $i++) 
            { 
                $published_on = $node->filter($S_published_on)->text();
                if(!$published_on==null || !empty($published_on) || !$published_on==''){
                    dump('published_on => '.$node->filter($S_published_on)->text());
                    break;
                }
                dump($i.' try for $published_on');
            }
            

            // If any field is null
            if($title==null){$title='title';}
            if($excerpt==null){$excerpt='excerpt';}
            if($body==null){$body='body';
            // stop execution if body is empty
            dd('body is sill empty');
            }
            if($thumbnail==null){$thumbnail='thumbnail';}
            if($link==null){$link='link';}
            if($publisher==null){$publisher='publisher';}
            if($published_on==null){$published_on='published_on';}


            // Persist Data ******************************************************************

            // $article = Article::create([
            //     'newspaper_id' => 4,
            //     'title' => $title,
            //     'excerpt' => $excerpt,
            //     'body' => $body,
            //     'thumbnail' => $thumbnail,
            //     'link' => $link,
            //     'publisher' => $publisher,
            //     'published_on' => $published_on
            // ]);

            nextArticle:

            // Seperator
            dump('------------------******************-----------------****************-------------------');

            // exit();
            // Persist Data ******************************************************************

           // exit();

        });
        dd('Logic-end');
        // 
        // 
        // 
        // 
        // my current logic
        

        ini_set('max_execution_time', 300);

        $article = Article::select('link','id')->where('body','body')->get();

        foreach ($article as $link) {

            // //my current logic
            // $crawler_01 = GoutteFacade::request('GET', $link->link);

            // dump($link);

            // $body = $crawler_01->filter('.story__content')->each(function ($nodeLink) {
            //     dump($nodeLink->text());
            // });

                    
            // dd('----------------');
            // //my current logic

            // body = .article > .main-wrapper > .container > .content > main > .flex > .flex__item > article > .template__main > .story__content

            // body = .story__content

            $crawler_01 = GoutteFacade::request('GET',$link->link);

            $body=$crawler_01->filter('.story__content')->each(function ($nodeLink) {

                // Find Each <P> Tag In The Body Content
                $body=$nodeLink->filter('p')->each(function ($nodeParagraph) {
                    $body = $nodeParagraph->text();
                    return $body;
                });

                $arrayBulk = null;

                foreach ($body as $bodyvalue) {
                    $arrayBulk .= '<p>'.$bodyvalue.'</p>';
                }

                return $arrayBulk;
                
                
            });

            $arrayBulk = null;

            foreach ($body as $bodyvalue) {
                $arrayBulk .= $bodyvalue;
            }

            $body = $arrayBulk;

            if($body=='' || empty($body) || $body==null){
                $body='body';
            }

            dump('id => '.$link->id);
            dump('link => '.$link->link);
            dump('body => '.$body);
            // dd();

            $article = Article::where('id',$link->id)->update([
                'body' => $body
            ]);

            // exit();



      //    // Click On Links

      //    $crawler_01 = GoutteFacade::request('GET', 'https://www.dawn.com/latest-news');

      //    $link = $crawler_01->selectLink($x)->link(); // select the link

      //    $crawler_01 = GoutteFacade::click($link); // click on it
                
            // dump('----------------');


        // Fetch articles **********************************************************************


        // Logics--------------------------------
            // creating excerpt logic
        $string='<p>The highly contagious novel coronavirus that has exploded into a global pandemic can remain viable and infectious in droplets in the air for hours and on surfaces up to days, according to a new study that should offer guidance to help people avoid contracting the respiratory illness called COVID-19.</p><p>Scientists from the National Institute of Allergy and Infectious Diseases (NIAID), part of the US National Institutes of Health, attempted to mimic the virus deposited from an infected person onto everyday surfaces in a household or hospital setting, such as through coughing or touching objects.</p><p>They used a device to dispense an aerosol that duplicated the microscopic droplets created in a cough or a sneeze.</p><p>The scientists then investigated how long the virus remained infectious on these surfaces, according to the study that appeared online in the New England Journal of Medicine on Tuesday — a day in which US COVID-19 cases surged past 5,200 and deaths approached 100.</p><p>The tests show that when the virus is carried by the droplets released when someone coughs or sneezes, it remains viable, or able to still infect people, in aerosols for at least three hours.</p><p>On plastic and stainless steel, viable virus could be detected after three days. On cardboard, the virus was not viable after 24 hours. On copper, it took 4 hours for the virus to become inactivated.</p><p>In terms of half-life, the research team found that it takes about 66 minutes for half the virus particles to lose function if they are in an aerosol droplet.</p><p>That means that after another hour and six minutes, three-quarters of the virus particles will be essentially inactivated but 25 per cent will still be viable.</p><p>The amount of viable virus at the end of the third hour will be down to 12.5pc, according to the research led by Neeltje van Doremalen of the NIAID’s Montana facility at Rocky Mountain Laboratories.</p><p>On stainless steel, it takes 5 hours 38 minutes for half of the virus particles to become inactive. On plastic, the half-life is 6 hours 49 minutes, researchers found.</p><p>On cardboard, the half-life was about three-and-a half-hours, but the researchers said there was a lot of variability in those results “so we advise caution” interpreting that number.</p><p>The shortest survival time was on copper, where half the virus became inactivated within 46 minutes.</p>';

        $explode1 = explode("p>", $string);

        dump($explode1[1]);

        $ex = substr($explode1[1], 0,100).'...';

        dd($ex);

        // creating excerpt logic
        
        // breaking a foreach loop
        $crawler = GoutteFacade::request('GET', 'https://www.dawn.com/latest-news');

        $S_publisher = array('h2 > a','h');

        foreach ($S_publisher as $S_publisher) {
            
            for ($i=0; $i < 3; $i++) 
            {

                $publisher = $crawler->filter($S_publisher)->text();
            
                if(!$publisher==null || !empty($publisher) || !$publisher==''){
                    dump('break on '.$i);
                    break;
                }

                dump($i. ' try on '. $S_publisher);

            }

            if(!$publisher==null){
                dump('publisher found');
                break;
            }
              
        }
        dump($publisher);
        dd('logic-end');

        $array = array('1','2','3','4','5','6','7','8','9','10');

        for ($i=0; $i < 3; $i++) { 
           foreach($array as $a){
            if($a==0)
            {
                break;
            }
            dump($a); 
            }
        }
        
        dd('end-logic');

        function endcode($array){
            foreach ($array as $value) {
            if($value==8){

                dump('foreach end');
                return;

            }
            dump($value);
            //     try{
            //         if($value==7){
            //             return;
            //         }
            //     }
            //     catch(Exception $e){
            //        dd('$e');
            //     }
            // dump($value);
            }
        }
        endcode($array);


        
        dd('login-end');
        // breaking a foreach loop

        // using variables in anonymous functions logic
            // q - how to pass a value to an anonymous function and (ans:: use($variable) )
            // q - how to modify that value and be usable for the rest of the program (and:: add this & sign with $variable)

        $count = 10;

        $count2nd = '2nd'; 

        $crawler = GoutteFacade::request('GET', 'https://www.dawn.com/latest-news');

        $filter = $crawler->filter('h2')->each(function($nodelink) use(&$count,&$count2nd){
            dump($count--);
            dump($nodelink->text());

            $filter1 = $nodelink->filter('a')->each(function($nodelink) use(&$count2nd){
                dd($count2nd);
                dump($nodelink->text());
            });


        });

        dd('final count '.$count);

        dd('logic-end');
        // using variables in anonymous functions logic

        // the array for each logic
        $thumbnail = array('1-thumbnail','2-thumbnail');
        $body = array('1-body','2-body');

        $var = 1;
        foreach ($body as $_body) {
            if($var == 2){
                break;
            }
            dump($_body);
            $var++;
        }

        dd('logic end');
        // the array for each logic

        // the goto logic
        $x = 1;

        if($x==1){
            goto queryEscape;
        }

        dump('Query Running');

        queryEscape:

        dump('queryEscaped');


        exit();

        // the goto logic

        // the loop through logic
        for ($i=0; $i < 3; $i++) { 
            // dump($i);
            if($i==1){
                dump('break on '.$i);
                break;
            }
            dump('string');
        }
        dump('loop end');
        // the loop through logic
        // Logics--------------------------------



        }
        
    }

    public function lab(){



$crawler = GoutteFacade::request('GET','http://localhost/php_notes.php');

// find the parent table 
$table = $crawler->filter('table')->each(function($table){

    $tdText = $table->filter('td')->each(function ($node){


        $alike = $node->previousAll(); // calculate the elements of the same level above this element :Will return array containing the tags above this tag.

        $elementTag = $alike->eq(0); // find the tag above this <td> tag. 

        if($elementTag->nodeName()=='td'){

            if($elementTag->text()=='Title')
            {
                dump("Title Heading => ".$elementTag->text()); // Title
                dd("Title Value => ".$node->text()); // The Harsh Face of Mother Nature
            }
        }


    });
}); 
























        // 1-) select E_House as Address,Ename as Emp_Name from employees;

        // 2-) select top 30% * from employees; (this is valid for SQL server / MS access)
        
        // 3-) select Ename as Name from employees where E_House='house number 44, street no 25, Rwp';

        // 4-) select * from employees where ECity IN ('isb','lhr','rwp','khi');
        
        // 5-) select Ename as Name from employees where EAge Between 18 And 33;

        // 6-) select Ename from employees where Ename Like'S%' And Ename Not Like '%I%';

        // 7-) select DISTINCT ECity from employees;

        // 8-) select * from employees where ECity='isb' ORDER BY EAge ASC;

        // 9-) select Ename,( E_Basic_Salary + E_Bonus ) as Total_Salary from employees;

        // 10-) select Count(Eid) as Total_Employees From employees;

        // 11-) select Count(Eid) as Total_Employees,E_Department as Department From employees Group by E_Department;

        // 12-) select pName from projects where
        // 21-) alter table employees modify E_Bonus float;

        // 22-) alter table employees add constraint Eid PRIMARY KEY (Eid);

        // 23-) alter table employees drop primary key;

        // 24-) alter table employees add e_father_name varchar(255);

        // 25-) alter table employees drop coloum EAge;

        $Employee = Employee::create([
            'Ename' => 'Tom',
            'EAge' => '40',
            'ECity' => 'Texas',
            'E_Street' => '5',
            'E_House' => '50',
            'E_Basic_Salary' => '$50,000',
            'E_Bonus' => '$1000',
            'E_Rank' => 'Manager',
            'E_Department' => 'CS',
        ]);
        dd('lab');
    }

}
