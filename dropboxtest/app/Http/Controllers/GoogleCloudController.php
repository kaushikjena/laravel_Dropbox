<?php
namespace App\Http\Controllers;

use Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Flysystem\Filesystem;
use League\Flysystem\Config;
//use Superbalist\Flysystem\GoogleStorage\GoogleStorageAdapter;


/*use Google\Cloud\Storage\StorageClient;
use League\Flysystem\Filesystem;*/
use Superbalist\FlysystemGoogleStorage\GoogleStorageAdapter;
//use Superbalist\FlysystemGoogleCloudStorage\GoogleCloudStorageServiceProvider;
//flysystem-google-storage
class GoogleCloudController extends Controller{

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function __construct()

    {

        //$this->middleware('auth');

    }


    public function GoogleFileUpload()

    {
		//print_r($adapter);
		//echo "here";exit;
		$localfile = public_path('prakash.JPG');
		Storage::disk('gcs')->getDriver()->getAdapter()->write('prakash.jpg', $localfile);
		//$url = Storage::disk('gcs')->getDriver()->getAdapter()->getUrl('sukanta.JPG');
		//$url = Storage::disk('gcs')->getDriver()->getAdapter()->getUrl('Process_Report.xlsx');
		
		//$disk = Storage::disk('gcs');
		//$url = $disk->getUrl('sukanta.JPG');

        //print ($url);
		//echo '<img src="'.$url.'" alt="Photo"  width="400" height="300"/>' ;

    }

}