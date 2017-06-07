<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Dropbox\Client;
use Dropbox\WriteMode;

class FileController extends Controller{

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function __construct()

    {

        //$this->middleware('auth');

    }
	public function getDropbox(){
		return view('dropbox');
	}
	public function saveDropbox(Request $request){
		//print "<pre>";print_r($request);
		//print_r($request->drop_file);
		//echo "here";exit;
		
		$file_name= $request->file_name;
		$files = $request->file('drop_file');
		
		//echo $files->getClientOriginalName();
		//echo $files->getClientSize();
		//echo $files->getRealPath();
		//print "<pre>";print_r($files);exit;
		if ($request->hasFile('drop_file')) {
			//echo env('DROPBOX_TOKEN'),env('DROPBOX_KEY'), env('DROPBOX_SECRET');exit;
			$Client = new Client(env('DROPBOX_TOKEN'),env('DROPBOX_KEY'), env('DROPBOX_SECRET'));
			//$Client = new Client(config('filesystems.dropbox.access_token'),config('filesystems.dropbox.key'), config('filesystems.dropbox.secret'));
			
			/*$file = fopen(public_path('img/angularjs-links.txt'), 'rb');
			$size = filesize(public_path('img/angularjs-links.txt'));
			$dropboxFileName = '/angularjs-links.txt';*/
			
			$file = fopen($files->getRealPath(),'rb');
			//$file = $files->getClientOriginalName();
			$size = $files->getClientSize();
			
			$dropboxFileName = '/'.$file_name.time().'.'.$files->getClientOriginalExtension();
	
	
			$Client->uploadFile($dropboxFileName,WriteMode::add(),$file, $size);
	
			$links['share'] = $Client->createShareableLink($dropboxFileName);
	
			$links['view'] = $Client->createTemporaryDirectLink($dropboxFileName);
	
			/*print "<pre>";
			print_r($links);*/
			return view('dropbox')->with('sts','1');
		}

    }

    public function dropboxFileUpload(){
		//echo "here";exit;
		//echo env('DROPBOX_TOKEN'),env('DROPBOX_KEY'), env('DROPBOX_SECRET');exit;
        $Client = new Client(env('DROPBOX_TOKEN'),env('DROPBOX_KEY'), env('DROPBOX_SECRET'));
		//$Client = new Client(config('filesystems.dropbox.access_token'),config('filesystems.dropbox.key'), config('filesystems.dropbox.secret'));


        $file = fopen(public_path('img/angularjs-links.txt'), 'rb');

        $size = filesize(public_path('img/angularjs-links.txt'));

        $dropboxFileName = '/angularjs-links.txt';


        $Client->uploadFile($dropboxFileName,WriteMode::add(),$file, $size);

        $links['share'] = $Client->createShareableLink($dropboxFileName);

        $links['view'] = $Client->createTemporaryDirectLink($dropboxFileName);

		print "<pre>";
        print_r($links);

    }

}